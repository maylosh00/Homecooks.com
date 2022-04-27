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

            <h1>Nazwa Przepisu</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Sed placerat ornare nisi, nec pellentesque mi imperdiet nec.
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                posuere cubilia curae</p>

        </div>

        <div class="white-container">
            <div class="recipe-img">
                <img src="public/img/sample_recipe_img.jpg">
            </div>

            <div class="lists-recipe-container">
                <div class="lists-container">
                    <div class="ingredients">
                        <p>Składniki:</p>
                        <ul>
                            <li>składnik 1</li>
                            <li>składnik 2</li>
                            <li>składnik 3</li>
                            <li>składnik 4</li>
                            <li>składnik 5</li>
                            <li>składnik 6</li>
                            <li>składnik 7</li>
                            <li>składnik 8</li>
                        </ul>
                    </div>

                    <div class="macro">
                        <p>Makroskładniki:</p>
                        <ul>
                            <li>Kalorie: 2kcal</x></li>
                            <li>Białko: 1g</li>
                            <li>Węglowodany: 3g</li>
                            <li>Tłuszcze: 7g</li>
                        </ul>
                    </div>
                </div>

                <div class="recipe">
                    <h2>Przepis</h2>
                    <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus malesuada ipsum at porttitor facilisis. Sed non dui
                        finibus lectus tincidunt blandit a in enim. Nunc sed nisi vel
                        urna mattis tristique id sit amet ligula. Fusce pellentesque
                        dignissim volutpat.
                        <br>
                        2. Aliquam sodales eros vitae ligula blandit rutrum. Curabitur
                        consequat nunc at erat blandit tempus. Vestibulum ullamcorper,
                        justo ut dapibus porttitor
                        <br>
                        3. Aliquam vitae porta ex. Nam at tempus neque, quis dictum elit.
                        Fusce faucibus neque vitae diam posuere, sit amet sagittis nibh
                        lacinia.
                        <br>
                        4. Maecenas efficitur, velit et commodo rhoncus, nulla elit fringilla
                        nulla, quis finibus nunc ipsum a justo. Nam sed leo ipsum. Nulla sit
                        amet nisi ex. In at dolor tempor, congue ligula quis, euismod ligula.
                    </p>
                </div>
            </div>

            <div class="suggest-changes">
                <a href="#">
                    <i class="fas fa-edit"></i><p>Zasugeruj zmiany</p>
                </a>
            </div>

            <div class="extra-info">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>

                <div class="author-info">
                    <div class="name-skill-info">
                        <p>Jan Przykładowy</p>
                        <p>Amator</p>
                    </div>

                    <div class="author-profile-pic">
                        <img src="public/img/sample_user_pic.jpg">
                    </div>
                </div>
            </div>


        </div>

        <div class="pink-container">
            <div class="comment-section">

                <div class="add-comment">
                    <form>
                        <textarea name="content" id="content" placeholder="Napisz, co sądzisz o tym przepisie..."></textarea>
                        <input type="submit" value="Dodaj komentarz">
                    </form>
                </div>

                <div class="comment">
                    <div class="author-info">
                        <div class="name-skill-info">
                            <p>Jan Przykładowy</p>
                            <p>Amator</p>
                        </div>

                        <div class="author-profile-pic">
                            <img src="public/img/sample_user_pic.jpg">
                        </div>
                    </div>

                    <p>Nam ullamcorper tempus nisl, in rhoncus ex ornare eu.
                        Pellentesque et lectus sed sapien fringilla bibendum
                        ut et nulla.
                    </p>
                </div>

                <div class="comment">
                    <div class="author-info">
                        <div class="name-skill-info">
                            <p>Jan Przykładowy</p>
                            <p>Amator</p>
                        </div>

                        <div class="author-profile-pic">
                            <img src="public/img/sample_user_pic.jpg">
                        </div>
                    </div>

                    <p>Nam ullamcorper tempus nisl, in rhoncus ex ornare eu.
                        Pellentesque et lectus sed sapien fringilla bibendum
                        ut et nulla.
                    </p>
                </div>

            </div>
        </div>
        <?php include('footer.php') ?>
    </main>

</div>

</body>