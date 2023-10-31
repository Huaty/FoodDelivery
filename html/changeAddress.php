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
    <title>Change Address</title>
</head>

<body>
    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <a class="button-style">
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
    <div class="profile-container">
        <form method="POST" action="">
            <?php echo "<div>Current Home Address: " . $homeAddress[0]["homeaddress"] . " </div>" ?>
            <label>Change Address</label>
            <input type="text" name="changeAddress" id="changeAddress" required>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

</body>

</html>