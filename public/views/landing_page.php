<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/landing_page.css">
    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/landing_page.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>LANDING PAGE</title>
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>

        <main>
            <div class="pink-container">
                <?php
                if(isset($messages)) {
                    foreach($messages as $message) {
                        echo "<p class='message'>".$message."</p>";
                    }
                }
                ?>
                <h1>Na co masz dzisiaj ochotę?</h1>

                <div class = "categories-bar">
                    <div class="category-to-select">
                        <a href="search_page?category=1"><i class="fas fa-bacon"></i> <p>Śniadania</p></a>
                    </div>
                    <p>|</p>
                    <div class="category-to-select">
                        <a href="search_page?category=3"><i class="fas fa-pizza-slice"></i> <p>Obiady</p></a>
                    </div>
                    <p>|</p>
                    <div class="category-to-select">
                        <a href="search_page?category=5"><i class="fas fa-ice-cream"></i> <p>Desery</p></a>
                    </div>
                    <p>|</p>
                    <div class="category-to-select">
                        <a href="search_page"><i class="fas fa-utensils"></i> <p>Wszystko</p></a>
                    </div>
                </div>

                <div class="search">
                    <p>A może szukasz czegoś konkretnego?</p>

                    <div class="search-bar-red">
                        <form action="searchOutsideOfSearchPage" method="POST">
                            <input type="text" name="searchInput" placeholder="Znajdź przepis...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <div class="adding-recipe">
                    <p>Albo chcesz dodać własny przepis?</p>

                    <div class="add-recipe-button">
                        <a href="upload_page">Dodaj przepis!</a>
                    </div>
                </div>

            </div>

            <div class="white-container">
                <h1>Najnowsze przepisy</h1>

                <div class="recipes">
                    <?php foreach($recipes as $recipe): ?>

                        <?php include('recipe_tile.php'); ?>

                    <?php endforeach; ?>
                </div>

            </div>
            <?php include('footer.php') ?>
        </main>

    </div>

</body>