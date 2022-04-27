<script type="text/javascript" src="./public/js/dropdown.js" defer></script>
<header>
    <?php if(isset($_SESSION['id'])) : ?>
    <div class="login-button">
<!--        <p>-->
            <div class="profile-pic">
                <img src="public/uploads/profile_pictures/<?=$_COOKIE['profile_pic'] ?>">
            </div>
            <p><?=$_COOKIE['name'] ?></p>
<!--        </p>-->
        <button class="dropdown-button"><i class="fas fa-angle-down"></i></button>
        <div id="dropdown" class="dropdown-content">
            <a href="/logout" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <?php else : ?>
    <div class="login-button">
        <a href="login_page" class="button">
            <div class="profile-pic">
                <img src="public/img/default_profile_pic.png">
            </div>
            <p>Zaloguj się</p>
        </a>
    </div>
    <?php endif ; ?>

    <div class="logo">
        <a href="landing_page"><img src="public/img/logo.svg"></a>
    </div>

    <div class="search-bar">
        <form action="searchOutsideOfSearchPage" method="POST">
            <input type="text" name="searchInput" placeholder="Szukaj przepisów...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</header>