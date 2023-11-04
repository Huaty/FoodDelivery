<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "error.php";
require_once '../asset/includePHP/dbh.inc.php';
$userId = $_SESSION["user_id"];

try {
    $queryUsers = 'SELECT homeaddress FROM USERS WHERE id = :UserID';
    $queryUsersStmt = $pdo->prepare($queryUsers);
    $queryUsersStmt->bindParam(':UserID', $userId);
    $queryUsersStmt->execute();
    $homeAddress = $queryUsersStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $changeAddress = $_POST['changeAddress'];

    try {
        $updateUser = "UPDATE users SET homeaddress = :homeaddress WHERE id = :UserID";
        $stmt = $pdo->prepare($updateUser);
        $stmt->bindParam(':homeaddress', $changeAddress);
        $stmt->bindParam(':UserID', $userId);
        $stmt->execute();
        header("Location:changeAddress.php");
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }
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

    </div>



    <div class="profile-container">
        <nav>


            <div class="profile-menu">
                <a class="menu-item " href="profile.php">Profile</a>
                <a class="menu-item " href="changeEmail.php">Change Email</a>
                <a class="menu-item" href="changePassword.php">Change Password</a>
                <a class="menu-item active" href="changeAddress.php">Change Address</a>
            </div>

        </nav>
        <div class="profile-content-container">
            <header class='title'><span>Change Address</span></header>
            <div class="profile-info">
                <form class="profile-form" method="POST" action="">
                    <div class="input-group">
                        <?php echo "<div>Current Home Address: " . $homeAddress[0]["homeaddress"] . " </div>" ?>
                    </div>
                    <div class="input-group">
                        <label>Change Address</label>
                        <input type="text" name="changeAddress" id="changeAddress" required>
                    </div>
                    <div class="button-container">
                        <input class="button" type="submit" name="submit" value="submit">
                    </div>
                </form>

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