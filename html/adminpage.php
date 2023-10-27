<?php
require_once "error.php";
require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";

var_dump($_SESSION);

if (($_SESSION["user_firstname"]) !== "admin") {
    header("Location: menu.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../asset/includePHP/dbh.inc.php";
    require_once "menu_model.inc.php";
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;
    switch ($formType) {
        case "create_menu":
            echo "Menu Table have intialize";
            create_menu($pdo);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Menu</title>
</head>


<body>
    <header>
        <!-- Header -->
        <div class="nav-container">
            <!-- Logo -->
            <div class="logo-placement">
                <a href="index.php"><object data="../asset/image/Logo.svg" Alt="Logo" class="logo"></object></a>
            </div>
            <!-- End Logo -->
            <!-- Navigation Bar -->
            <ul class="nav-flex-right nav-flex-grow">
                <!-- <li class="nav-content "><a href="index.php"><span></span></a></li>
                <li class="nav-content"><a href="signup.php"><span>Menu</span></li>
                <li class="nav-content about-us"><a href="about.php"><span class="current-page">About us</span></a></li>
                <li class="nav-content login"><a href="login.php"><span>Login</span></a></li> -->
        </div>
    </header>
    <div id="admin-container">
        <h1>Welcome to Admin Page </h1>
        <form action="adminpage.php" method="post">
            <div id="wrapper">Update Menu</div>
            <div id="wrapper">Intialize Menu
                <input type="hidden" name="form_type" value="create_menu" id="create_menu">
                <div><button type="submit" id="submit-button-create-menu">Click me</button></div>
            </div>
            <div id="wrapper">View Orders</div>
        </form>
    </div>
    <footer>
        <!-- Footer Top -->
        <div class="top">
            <div class="smallLogo">
                <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
                <p id="word">Munchies Together</p>
            </div>
            <div class="contact">
                <p>Contact Us </p>
                <div class="small-icon">
                    <img src="../asset/image/instagram.png" alt="instagram" class="img">
                    <img src="../asset/image/twitter.png" alt="twitter" class="img">
                </div>
            </div>
            <div class="statement">
                <p>Privacy Policy</p>
                <p>Terms & Conditions</p>
            </div>

        </div>
        <!-- End Footer Top -->
        <div class="bottom">
            <p>&copy 2023 Majulah Munchies. All rights reserved.</p>

        </div>
    </footer>
</body>


<script src="../asset/js/script.js"></script>


</html>