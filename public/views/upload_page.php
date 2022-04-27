<?php
if(!isset($_SESSION['id'])) {

    $url = "http://$_SERVER[HTTP_HOST]";
    setcookie("message", 'Aby dodać przepis, musisz się najpierw zalogować', time() + 10, "/");
    header("Location: {$url}/login_page");
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/forms2.css">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/upload2.css">
    <script type="text/javascript" src="./public/js/upload.js" defer></script>

    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>UPLOAD PAGE</title>
</head>

<body>
<div class="container">
    <?php include('header.php') ?>
    <main>
        <form class="upload-form" action="addRecipe" method="POST" ENCTYPE="multipart/form-data">
            <div class="upload-text"><p>Dodaj własny przepis!</p></div>
            <?php
            if(isset($messages)) {
                foreach($messages as $message) {
                    echo $message;
                }
            }
            ?>
            <div class="upload-data">
                <div class="title-content">
                    <div>
                        <input type="text" name="title" id="title" placeholder="Nazwa dania">
                        <textarea name="description" id="description" placeholder="Krótki opis dania"></textarea>
                        <textarea name="content" id="content" placeholder="Opis krok po kroku, jak zrobić Twoje danie"></textarea>
                    </div>
                </div>
                <div class="ingredients-list">
                    <p>Składniki twojego dania:</p>
                    <div class="ingredients-container">
                        <div class="ingredients">

                            <!-- uzywane przez upload.js do wyswietlania kolejnych skladnikow -->
                            <template class="add-ingredient-template">
                                <div class="add-ingredient">
                                    <div class="dot-icon">
                                        <i class="fas fa-dot-circle"></i>
                                    </div>
                                    <div class="add-ingredient-forms">
                                        <div class="add-ingredient-form-container">
                                            <div>
                                                <input type="radio" id="ingredient-from-list" name="ingredientType" value="ingredientFromList" checked="checked">
                                                <label for="ingredient-from-list">Nasz składnik</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="new-ingredient" name="ingredientType" value="newIngredient">
                                                <label for="new-ingredient">Nowy składnik</label>
                                            </div>
                                        </div>
                                            <div class="ingredient-from-list-form">
                                                <select name="ingredientFromList" id="ingredient-select">
                                                    <option value="" disabled="disabled" selected="selected">Wybierz produkt z listy</option>
                                                    <?php
                                                    usort($ingredients, function($a, $b) {return strcmp($a->getName(), $b->getName());});
                                                    foreach($ingredients as $ingredient): ?>
                                                        <option value="<?= $ingredient->getName(); ?>"><?= $ingredient->getName(); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="text" id="ingredient-from-list-amount" name="ingredientFromListAmount" placeholder="Ilość (g)">
                                            </div>
                                            <div class="new-ingredient-form not-visible">
                                                <input type="text" id="new-ingredient-input" name="newIngredientName" placeholder="Nazwa składnika">
                                                <div class="macro-grid">
                                                    <input type="text" id="new-ingredient-input" name="newIngredientProteins" placeholder="białka">
                                                    <input type="text" id="new-ingredient-input" name="newIngredientCarbs" placeholder="węgle">
                                                    <input type="text" id="new-ingredient-input" name="newIngredientFats" placeholder="tłuszcze">
                                                    <input type="text" id="new-ingredient-input" name="newIngredientCalories" placeholder="kalorie">
                                                    <input type="text" id="new-ingredient-input" name="newIngredientAmount" placeholder="Ilość (g)">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="trash-icon">
                                        <a href="#">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </template>



                        </div>
                        <div class="add-ingredient-button">
                            <a href="#">
                                <i class="fas fa-plus"></i><p>Dodaj składnik</p>
                            </a>
                        </div>

                    </div>

                </div>
                <div class = "categories-bar">
                    <p>Wybierz kategorie:</p>

                    <?php include('categories_list.php') ?>
                </div>

                <div class=add-image>
                    <label for="photo-file">Dodaj zdjęcie:</label><br>
                    <input type="file" id="photo-file" name="photoFile">
                </div>

                <div class="register-button">
                    <button type="submit">Dodaj przepis!</button>
                </div>
            </div>

        </form>
    </main>

    <?php include('footer.php') ?>
</div>
</body>