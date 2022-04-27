<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class SecurityController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/profile_pictures/';

    private $messages = [];
    private $userRepository;
    private $recipeRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->recipeRepository = new RecipeRepository();
    }

    public function login() {

        if (!$this->isPost()) {
            return $this->render('login_page');
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($username);
        if(!$user) {
            return $this->render('login_page', ['messages' => ['Nie ma w bazie użytkownika o podanej nazwie']]);
        }

        if ($user->getUsername() !== $username) {
            return $this->render('login_page', ['messages' => ['Nie ma w bazie użytkownika o podanej nazwie']]);
        }

        $salt = $user->getSalt();
        $hashedPassword = $this->hashPassword($password, $salt);

        if ($user->getPassword() !== $hashedPassword) {
            return $this->render('login_page', ['messages' => ['Błędne hasło!']]);
        }

        session_start();
        $_SESSION["id"] = $this->userRepository->getUsersId($user);
        setcookie("name", $user->getName()." ".$user->getLastname(), time() + 86400, "/");
        setcookie("profile_pic", $user->getProfilePicture(), time() + 84600, "/");
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/landing_page");

    }

    public function register() {

        if ($this->isPost()) {

            if(is_uploaded_file($_FILES['profilePic']['tmp_name']) && $this->validate($_FILES['profilePic'])) {
                move_uploaded_file(
                    $_FILES['profilePic']['tmp_name'],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['profilePic']['name']
                );
            }
            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordRepeat = $_POST['passwordRepeat'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $skillLevel = $_POST['skillLevel'];
            $profilePic = $_FILES['profilePic']['name'];

            if ($password !== $passwordRepeat) {
                return $this->render('register_page', ['messages' => ['Hasła nie są identyczne']]);
            }

            $salt = $this->createSalt();
            $hashedPassword = $this->hashPassword($password, $salt);
            $user = new User($username, $hashedPassword, $salt, $name, $lastname, $email, $skillLevel, $profilePic);


            $this->userRepository->addUser($user);

            return $this->render('login_page', ['messages' => ['Pomyślnie stworzono konto, możesz się zalogować:']]);
        } else
            return $this->render('register_page');

    }

    public function logout() {
        session_start();
        unset($_SESSION);
        session_destroy();

        setcookie("name", "", time() - 3600);
        setcookie("profile_pic", "", time() - 3600);

        $recipes = $this->recipeRepository->getRecipes();
        $firstThreeRecipes = [$recipes[0], $recipes[1], $recipes[2]];
        return $this->render('landing_page', ['messages' => ['Wylogowano pomyślnie'], 'recipes' => $firstThreeRecipes]);
    }

    private function validate(array $file): bool {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'Plik jest zbyt duży';
            return false;
        }

        if(isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'Próbowano wrzucić nieobsługiwany format obrazu';
            return false;
        }
        return true;
    }

    private function createSalt(): string
    {
        $salt = md5(uniqid(rand(), TRUE));
        return substr($salt, 0, 32);
    }

    private function hashPassword(string $pwd, string $salt): string
    {
        $hash = hash('sha256', $pwd);
        return hash('sha256', $salt.$hash);
    }
}