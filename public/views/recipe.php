<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipe.css">
    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>RECIPE</title>
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>

        <main>
            <div class="pink-container">

                <h1><?= $recipe->getTitle(); ?></h1>
                <p><?= $recipe->getDescription(); ?></p>

            </div>

            <div class="white-container">
                <div class="recipe-img">
                    <img src="public/uploads/<?= $recipe->getImage(); ?>">
                </div>

                <div class="lists-recipe-container">
                    <div class="lists-container">
                        <div class="ingredients">
                            <p>Składniki:</p>
                            <ul>
                                <?php foreach($ingredients as $ingredient): ?>
                                    <li><?= $ingredient->getName(); ?> - <?= $ingredient->getAmount();?>g</li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="macro">
                            <p>Makroskładniki:</p>
                            <ul>
                                <li>Kalorie - <?= $macro['calories']?>kcal </li>
                                <li>Białko - <?= $macro['proteins']?>g</li>
                                <li>Węglowodany - <?= $macro['carbs']?>g</li>
                                <li>Tłuszcze - <?= $macro['fats']?>g</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="recipe">
                        <h2>Przepis</h2>
                        <p><?= $recipe->getContent(); ?></p>
                    </div>
                </div>

                <div class="extra-info">
                    <div class="stars">
<!--                        <i class="fas fa-star"></i>-->
<!--                        <i class="fas fa-star"></i>-->
<!--                        <i class="fas fa-star"></i>-->
<!--                        <i class="fas fa-star"></i>-->
<!--                        <i class="far fa-star"></i>-->
                    </div>

                    <div class="author-info">
                        <div class="name-skill-info">
                            <p><?= $author->getName(); ?> <?= $author->getLastName(); ?></p>
                            <p><?= $author->getSkillLevel(); ?></p>
                        </div>

                        <div class="author-profile-pic">
                            <img src="public/uploads/profile_pictures/<?= $author->getProfilePicture(); ?>">
                        </div>
                    </div>
                </div>


            </div>

<!--            <div class="pink-container">-->
<!--                <div class="comment-section">-->
<!---->
<!--                    <div class="add-comment">-->
<!--                        <form>-->
<!--                            <textarea name="content" id="content" placeholder="Napisz, co sądzisz o tym przepisie..."></textarea>-->
<!--                            <input type="submit" value="Dodaj komentarz">-->
<!--                        </form>-->
<!--                    </div>-->
<!---->
<!--                    <div class="comment">-->
<!--                        <div class="author-info">-->
<!--                            <div class="name-skill-info">-->
<!--                                <p>Jan Przykładowy</p>-->
<!--                                <p>Amator</p>-->
<!--                            </div>-->
<!--    -->
<!--                            <div class="author-profile-pic">-->
<!--                                <img src="public/img/sample_user_pic.jpg">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        -->
<!--                        <p>Nam ullamcorper tempus nisl, in rhoncus ex ornare eu. -->
<!--                            Pellentesque et lectus sed sapien fringilla bibendum -->
<!--                            ut et nulla.-->
<!--                        </p>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
            <?php include('footer.php') ?>
        </main>

    </div>

</body>