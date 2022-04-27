<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Recipe.php';
require_once __DIR__ .'/../models/Ingredient.php';
require_once __DIR__ .'/../models/RecipeIngredientConnector.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../repository/RecipeRepository.php';
require_once __DIR__ .'/../repository/IngredientRepository.php';
require_once __DIR__ .'/../repository/RecipeIngredientConnectorRepository.php';
require_once __DIR__ .'/../repository/RecipeCategoryConnectorRepository.php';
require_once __DIR__ .'/../repository/UserRepository.php';

class RecipeController extends AppController{

    const MAX_FILE_SIZE = 1024*1024*500;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $recipeRepository;
    private $ingredientRepository;
    private $recipeIngredientConnectorRepository;
    private $recipeCategoryConnectorRepository;
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->recipeRepository = new RecipeRepository();
        $this->ingredientRepository = new IngredientRepository();
        $this->userRepository = new UserRepository();
        $this->recipeIngredientConnectorRepository = new RecipeIngredientConnectorRepository();
        $this->recipeCategoryConnectorRepository = new RecipeCategoryConnectorRepository();
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->recipeRepository->getRecipesBySubstring($decoded['search']));
        }
    }

    public function searchOutsideOfSearchPage() {
        $recipes = $this->recipeRepository->getRecipeObjectsBySubstring($_POST["searchInput"]);
        $this->render('search_page', ['recipes' => $recipes]);
    }

    //wyswietlanie stron, na ktorych pojawiaja sie przepisy:
    public function search_page() {
        if(isset($_GET['category'])) {
            $recipes = $this->recipeRepository->getRecipesFromCategory($_GET['category']);
            $this->render('search_page', ['recipes' => $recipes]);
        }
        else {
            $recipes = $this->recipeRepository->getRecipes();
            $this->render('search_page', ['recipes' => $recipes]);
        }
    }

    public function upload_page() {
        $ingredients = $this->ingredientRepository->getIngredients();
        $this->render('upload_page', ['ingredients' => $ingredients]);
    }

    public function landing_page() {
        $this->renderLandingPage();
    }

    public function index() {
        $this->renderLandingPage();
    }

    private function renderLandingPage() {
        $recipes = $this->recipeRepository->getRecipes();
        $firstThreeRecipes = [$recipes[count($recipes)-1], $recipes[count($recipes)-2], $recipes[count($recipes)-3]];
        $this->render('landing_page', ['recipes' => $firstThreeRecipes]);
    }

    public function recipe() {
        if (!$this->isGet()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/landing_page");
        }

        $recipe = $this->recipeRepository->getRecipe($_GET['title']);
        $ingredients = $this->ingredientRepository->getIngredientsForRecipe($recipe);
        $author = $this->userRepository->getUserById($recipe->getAuthorId());
        $macro = ['proteins' => 0, 'carbs' => 0, 'fats' => 0, 'calories' => 0];
        foreach ($ingredients as $ingredient) {
            $macro['proteins'] += ($ingredient->getAmount() / 100) * $ingredient->getProteins();
            $macro['carbs'] += ($ingredient->getAmount() / 100) * $ingredient->getCarbs();
            $macro['fats'] += ($ingredient->getAmount() / 100) * $ingredient->getFats();
            $macro['calories'] += $ingredient->getCalories();
        }

        $this->render('recipe', [
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'author' => $author,
            'macro' => $macro
        ]);
    }

    public function addRecipe() {

        if($this->isPost() && is_uploaded_file($_FILES['photoFile']['tmp_name']) && $this->validate($_FILES['photoFile'])) {

            move_uploaded_file(
                $_FILES['photoFile']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['photoFile']['name']
            );

            // dodaje entry do tabeli z przepisami
            $recipe = new Recipe($_POST['title'], $_POST['description'], $_POST['content'], $_FILES['photoFile']['name'], $_SESSION['id']);
            $this->recipeRepository->addRecipe($recipe);

            // aby dodac skladniki / polaczyc istniejace z przepisem (wiele do wielu) filtruje tablice $_POST
            // po pierwszym radio inpucie
            $filteredPost = array_filter(
                $_POST,
                function ($key) {
                    return strpos($key, 'ingredientType') === 0;
                },
                ARRAY_FILTER_USE_KEY
            );

            foreach ($filteredPost as $key => $value) {
                $num = substr($key, -1); // zwraca numer pól "name=..." z htmla
                if ($value == 'ingredientFromList') {
                    $connector = new RecipeIngredientConnector(
                        $recipe->getTitle(),
                        $_POST['ingredientFromList'.$num],
                        $_POST['ingredientFromListAmount'.$num]
                    );
                    $this->recipeIngredientConnectorRepository->addRecipeIngredientConnector($connector);
                }
                else if($value == 'newIngredient') {

                     $ingredient = new Ingredient(
                         $_POST['newIngredientName'.$num],
                         $_POST['newIngredientProteins'.$num],
                         $_POST['newIngredientCarbs'.$num],
                         $_POST['newIngredientFats'.$num],
                         $_POST['newIngredientCalories'.$num]
                     );
                    $this->ingredientRepository->addIngredient($ingredient);

                    $connector = new RecipeIngredientConnector(
                        $recipe->getTitle(),
                        $ingredient->getName(),
                        $_POST['newIngredientAmount'.$num]
                    );
                    $this->recipeIngredientConnectorRepository->addRecipeIngredientConnector($connector);
                }
            }

            $ingredients = $this->ingredientRepository->getIngredientsForRecipe($recipe);
            $author = $this->userRepository->getUserById($recipe->getAuthorId());
            $macro = ['proteins' => 0, 'carbs' => 0, 'fats' => 0, 'calories' => 0];
            foreach ($ingredients as $ingredient) {
                $macro['proteins'] += ($ingredient->getAmount() / 100) * $ingredient->getProteins();
                $macro['carbs'] += ($ingredient->getAmount() / 100) * $ingredient->getCarbs();
                $macro['fats'] += ($ingredient->getAmount() / 100) * $ingredient->getFats();
                $macro['calories'] += $ingredient->getCalories();
            }

            foreach($_POST["cat"] as $category) {
                $connector = new RecipeCategoryConnector($recipe->getTitle(), $category);
                $this->recipeCategoryConnectorRepository->addRecipeCategoryConnector($connector);
            }

            return $this->render('recipe', [
                'recipe' => $recipe,
                'ingredients' => $ingredients,
                'author' => $author,
                'macro' => $macro
            ]);
        }

        $this->render('upload_page', ['messages' => $this->messages]);

    }

    private function validate(array $photoFile): bool {
        if($photoFile['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'Plik jest zbyt duży';
            return false;
        }

        if(isset($photoFile['type']) && !in_array($photoFile['type'], self::SUPPORTED_TYPES)) {
            var_dump($photoFile['type']);
            $this->messages[] = 'Próbowano wrzucić nieobsługiwany format obrazu';
            return false;
        }
        return true;
    }


}