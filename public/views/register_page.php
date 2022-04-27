<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/forms2.css">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/register3.css">
    <script type="text/javascript" src="./public/js/register_validation.js" defer></script>

    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>REGISTER PAGE</title>
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>

        <main>
            <form class="register-form" action="register" method="POST" ENCTYPE="multipart/form-data">
                <div class="register-text"><p>Rejestracja</p></div>
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <div class="register-data">
                    <div class="personal-data">
                        <input type="text" name="username" placeholder="Nazwa użytkownika">
                        <input type="text" name="email" placeholder="Adres e-mail">
                        <input type="text" name="name" placeholder="Imię">
                        <input type="text" name="lastname" placeholder="Nazwisko">
                        <input type="password" name="password" placeholder="Hasło">
                        <input type="password" name="passwordRepeat" placeholder="Potwierdź hasło">
                    </div>
                    <div class="skill-level-image">
                        <p>Podaj, na jakim stopniu zaawansowania jesteś:</p>
                        <div class="skill-level">
                            <input type="radio" id="amateur" name="skillLevel" value="Amatorski kucharz">
                            <label for="amateur">Amator</label><br>
                            <input type="radio" id="semipro" name="skillLevel" value="Doświadczony kucharz">
                            <label for="semipro">Doświadczony</label><br>
                            <input type="radio" id="pro" name="skillLevel" value="Profesjonalista">
                            <label for="pro">Profesjonalista</label>
                        </div>
                        <div class=add-image>
                            <label for="photo-file">Wybierz zdjęcie profilowe:</label><br>
                            <input type="file" id="photo-file" name="profilePic">
                        </div>
                    </div>
                </div>
                <div class="register-button">
                    <button type="submit">Zarejestruj się!</button>
                </div>
            </form>
        </main>

        <?php include('footer.php') ?>
    </div>
</body>