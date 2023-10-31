<?php

// is_pwd_wrong()
require_once '../asset/includePHP/config_session.inc.php';
require_once '../asset/includePHP/dbh.inc.php';
require_once 'error.php';
$userId = $_SESSION['user_id'];

$errorMsg = '';
$oldPwdIsCorrect = false;
try {
    $queryPwd = "SELECT pwd FROM users where id= :userId";
    $stmt = $pdo->prepare($queryPwd);
    $stmt->bindParam("userId", $userId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $hashPwd = $results[0]['pwd'];
} catch (PDOException $e) {
    die("ERROR: Could not execute $queyPwd. " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../asset/includePHP/hashpwd.inc.php";
    $oldPwd = $_POST["oldpwd"];
    $newPwd = pwdSignup($_POST["newpwd"]);
    if (pwdLogin($oldPwd, $hashPwd)) {
        try {
            $oldPwdIsCorrect = true;
            $insertNewPwd = "UPDATE users SET pwd = :newPwd WHERE id = :userId";
            $stmt = $pdo->prepare($insertNewPwd);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("newPwd", $newPwd);
            $stmt->execute();
            echo "Password changed successfully!";
        } catch (PDOException $e) {
            die("ERROR: Could not execute $insertNewPwd. " . $e->getMessage());
        }
    } else {
        $errorMsg = "You have typed the wrong password.";
    }
}

$pdo = null;
$stmt = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
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
        <h3>This is the Change password</h3>
        <form method="POST" action="">
            <label for="oldPwd">Old Password</label>
            <input type="password" name="oldpwd" id="oldpwd" required>
            <label for="newPwd">New Password</label>
            <input type="password" name="newpwd" id="newpwd" required>
            <input type="submit" value="submit" name="submit">
        </form>
        <?php echo $errorMsg ?>
    </div>
</body>

</html>