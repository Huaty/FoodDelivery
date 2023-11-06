<?php
require_once '../asset/includePHP/config_session.inc.php';
require_once '../asset/includePHP/dbh.inc.php';
$userId = $_SESSION['user_id'];
try {
    $queryUser = "SELECT * FROM users WHERE id=:userID";
    $stmt = $pdo->prepare($queryUser);
    $stmt->bindParam(":userID", $userId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
try {
    $queryUser = "SELECT email FROM users WHERE id=:userID";
    $stmt = $pdo->prepare($queryUser);
    $stmt->bindParam(":userID", $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($user['email'] === 'admin@gmail.com') {
?>
<?php
    }
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
?>


$pdo = null;
$stmt = null;


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
                <a class="menu-item active" href="profile.php">Profile</a>
                <a class="menu-item " href="changeEmail.php">Change Email</a>
                <a class="menu-item" href="changePassword.php">Change Password</a>
                <a class="menu-item" href="changeAddress.php">Change Address</a>
                <?php
                if ($user['email'] === 'admin@gmail.com') {
                    echo '<a class="menu-item" href="adminpage.php">Admin Page</a>';
                }
                ?>
            </div>

        </nav>
        <div class="profile-content-container">
            <header class='title'><span>Profile</span></header>
            <div class="profile-info">
                <div>
                    <img id="profile-page-img" src="../asset/image/bingwei.jpeg" alt="Profile Picture">
                </div>
                <?php
                echo "<p><h3> " . $results[0]["firstname"] . "</h3></p>";
                echo "<p><span class='icon'>📧 </span>Email:  " . $results[0]["email"] . "</p>";
                echo "<p><span class='icon'>📍</span>Address:   " . $results[0]["homeaddress"] . "</p>";

                ?>
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