<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// You can uncomment the session checking part once everything else is working
// if (!isset($_SESSION["user_id"])) {
//     header("Location: login.php");
//     exit();
// }

try {
    require_once "../asset/includePHP/dbh.inc.php";
    $sql = "SELECT * FROM menus";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}

require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";


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
                <!-- <li class="nav-content "><a href="index.php"><span>Home</span></a></li>
                <li class="nav-content"><a href="signup.php"><span>Menu</span></li>
                <li class="nav-content about-us"><a href="about.php"><span class="current-page">About us</span></a></li>
                <li class="nav-content login"><a href="login.php"><span>Login</span></a></li> -->
        </div>
    </header>
    <div id="menu-wrapper">
        <?php
        echo '<div class="image-grid">';
        foreach ($result as $row) {
            echo '<div id= "menuGridclass">';
            echo '<img  src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '"/>';
            echo '<div> ' . $row["foodname"] . '</div>';
            echo '<div> ' . $row["food_description"] . ' </div>';
            echo '<div class="quantity-control">
            <button id="decrement">-</button>
            <span id="quantity">1</span>
            <button id="increment">+</button>
        </div>';
            echo '</div>';
        }
        echo '</div>';
        ?>
        <div class="order-card">
            <h2>Order Details</h2>
            <div class="order-content">
                <p>Add some items to get started !</p>
                <div class="total">
                    <span>Total:</span>
                    <span>$100.00</span>
                </div>
                <button class="pay-button">PAY NOW</button>
            </div>
        </div>
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