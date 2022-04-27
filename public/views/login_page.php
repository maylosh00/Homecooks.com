<?php
if(isset($_COOKIE['message'])) {
    $messages = [$_COOKIE['message']];
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/forms2.css">
    <link rel="stylesheet" type="text/css" href="public/css/footer_header.css">
    <script src="https://kit.fontawesome.com/06d1ef0ea0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400&display=swap" rel="stylesheet">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <?php include('header.php') ?>

        <main>
            <div class="login-form">
                <div class="login-form-icon"><i class="fas fa-user-circle"></i></div>

                <form class="login" action="login" method="POST">
                    <div class="messages">
                        <?php
                        if(isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input name="username" type="text" placeholder="Nazwa użytkownika">
                    </div>
                    <div class="input-with-icon">
                        <i class="fas fa-key"></i>
                        <input name="password" type="password" placeholder="Hasło">
                    </div>
                    <button type="submit">Zaloguj się</button>
                </form>
                <div class="register-text-wrap">
                    <p>Jeszcze nie jesteś użytkownikiem?</p>
                    <a href="register_page" class="button">Załóż konto!</a>
                </div>
            </div>
        </main>

        <?php include('footer.php') ?>
    </div>
</body>