<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "error.php";
require_once "../asset/includePHP/dbh.inc.php";
$id = $_SESSION["user_id"];

try {
    $orderQuery = "SELECT * FROM orders WHERE UserID=:id ORDER BY OrderID DESC LIMIT 1";
    $orderStmt = $pdo->prepare($orderQuery);
    $orderStmt->bindParam(":id", $id);
    $orderStmt->execute();
    $results = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $orderQuery. " . $e->getMessage());
}

var_dump($results);
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
        <div class="nav-container-menu">
            <!-- Logo -->
            <a href="menu.php" class="button-style">
                <div class="logo-placement">
                    <img src="../asset/image/Logo.png" class="logo">
                </div>
            </a>
            <div class="profile-dropdown">
                <button class="dropbtn">Welcome, <?php echo $_SESSION["user_firstname"] ?>
                    <img src="../asset/image/bingwei.jpeg" alt="Profile Picture" class="profile-pic">
                </button>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Log out</a>
                    <a href="orderDetails.php">Orders Details</a>
                </div>
            </div>
        </div>
    </header>

    <div>
        <div class="container">

            <h1>Your Order Have been Confirmed!!</h1>
            <div>
                <?php
                echo "<h2> Your Order Number:</h2> <div> " . $results[0]["OrderID"] . " </div>";
                ?>
            </div>

        </div>

    </div>
    <div>
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