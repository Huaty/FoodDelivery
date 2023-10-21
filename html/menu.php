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
            echo '<div>';
            echo '<img id= "menuGridclass" src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '"/>';
            echo '<div>';
            echo $row['foodname'] . "<br>";
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        ?>
        <div>checkout</div>
    </div>
</body>


<script src="../asset/js/script.js"></script>


</html>