<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/search3.css">
    <link rel="stylesheet" type="text/css" href="public/css/tile3.css">
    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>SEARCH</title>
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>

        <main>
            <div class="pink-container">

                <div class="search">
                    <p>Napisz nam, czego szukasz!</p>

                    <div class="search-bar-red">
                        <input type="text" placeholder="Znajdź przepis...">
                        <button type="submit" id="search-button"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class = "categories-bar">
                    <p>Filtruj kategoriami:</p>
                    <?php include('categories_list.php') ?>
                </div>

            </div>

            <div class="white-container">
                <h1>Oto, co dla Ciebie mamy:</h1>

                <div class="sort-recipes-container">
<!--                    <div class="sort">-->
<!--                        <form>-->
<!--                            <p>Sortuj według:</p>-->
<!--                            <div class="sort-options-container">-->
<!--                                <div class="sort-option"> -->
<!--                                    <input type="radio" id="date" name="sort" value="date" checked>-->
<!--                                    <label for="date">daty publikacji</label>-->
<!--                                </div>-->
<!--                                <div class="sort-option">-->
<!--                                    <input type="radio" id="popularity" name="sort" value="popularity">-->
<!--                                    <label for="popularity">popularności</label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->


                    <div class="recipes">

                        <?php foreach($recipes as $recipe): ?>

                        <?php $size = 'size3'; $order='';
                        include('recipe_tile.php'); ?>

                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
            <?php include('footer.php') ?>
        </main>

    </div>

</body>

<template id="recipe-template">
    <a href="" class="recipe-tile-container ">
        <div class="recipe-tile size3">
            <div class="recipe-tile-img">
                <img src="">
            </div>
            <div class="recipe-tile-text">
                <p></p>
            </div>
        </div>
    </a>
</template>