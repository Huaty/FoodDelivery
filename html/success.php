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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&family=Koulen&family=Lalezar&family=Mitr:wght@200&display=swap" rel="stylesheet">
    <title>Menu</title>
</head>


<body>
    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <div id="logo">
            <a href="menu.php" class="button-style">
                <div class="logo-placement">
                    <img src="../asset/image/Logo.png" class="logo">
                </div>
            </a>
        </div>
        <div class="profile-dropdown">
            <button class="dropbtn">
                <div id="welcome">Welcome, <strong><?php echo $_SESSION["user_firstname"] ?></div></strong>
                <img src="../asset/image/bingwei.jpeg" alt="Profile Picture" class="profile-pic">
            </button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Log out</a>
                <a href="orderDetails.php">Orders Details</a>
            </div>
        </div>
    </div>


    <div class="container-success">
        <div class="printer-top"></div>

        <div class="paper-container">
            <div class="printer-bottom"></div>

            <div class="paper">
                <div class="main-contents">
                    <div class="smallLogo">
                        <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
                        <p id="word">Munchies Together</p>
                    </div>
                    <div class="success-icon">&#10004;</div>
                    <div class="success-title">
                        Payment Complete
                    </div>
                    <div class="success-description">
                        <?php
                        echo " Your order have been completed";
                        echo " <div> " . $results[0]["OrderDate"] . " </div>";
                        ?></div>
                </div>
                <div class="order-details">
                    <div class="order-number-label">Order Number</div>
                    <div class="order-number"> <?php
                                                echo " <div> " . $results[0]["OrderID"] . " </div>";
                                                ?></div>
                </div>
                <div class="order-footer">Thank you!</div>
            </div>
            <div class="jagged-edge"></div>
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