<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "error.php";
require_once '../asset/includePHP/dbh.inc.php';

$userId = $_SESSION["user_id"];
$catchErrorMessage = ""; // Variable to store error messages
$successful = false; // Variable to track successful operation

// Fetch the user's current email from the database
try {
    $queryUsers = 'SELECT email FROM USERS WHERE id = :UserID';
    $queryUsersStmt = $pdo->prepare($queryUsers);
    $queryUsersStmt->bindParam(':UserID', $userId);
    $queryUsersStmt->execute();
    $user = $queryUsersStmt->fetch(PDO::FETCH_ASSOC);
    $currentEmail = $user['email']; // Retrieve the current email
} catch (PDOException $e) {
    $catchErrorMessage = "Database Error: " . $e->getMessage();
    echo $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentEmailInput = $_POST['currentEmail'];
    $newEmail = $_POST['newEmail'];
    $confirmNewEmail = $_POST['confirmNewEmail'];
    $emailRegex = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+$/';
    
    if (!preg_match($emailRegex, $newEmail)) {
        $catchErrorMessage = "Error: Invalid email format for the new email address.";
    } else if (strtolower($currentEmailInput) !== strtolower($currentEmail)){
        $catchErrorMessage = "Error: The provided current email does not match your account.";
    } else if ($newEmail !== $confirmNewEmail) {
        $catchErrorMessage = "Error: New email and confirm email do not match.";
    } else {
        $checkExistingEmailQuery = 'SELECT COUNT(*) FROM USERS WHERE email = :newEmail';
        $checkExistingEmailStmt = $pdo->prepare($checkExistingEmailQuery);
        $checkExistingEmailStmt->bindParam(':newEmail', $newEmail);
        $checkExistingEmailStmt->execute();
        $emailCount = $checkExistingEmailStmt->fetchColumn();

        if ($emailCount > 0) {
            $catchErrorMessage = "Error: The new email is already associated with an existing account.";
        } else {
            try {
                $updateQuery = 'UPDATE USERS SET email = :newEmail WHERE id = :UserID';
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->bindParam(':newEmail', $newEmail);
                $updateStmt->bindParam(':UserID', $userId);
                $updateStmt->execute();
                $Successful =" Email updated successfully.";
                $successful = true; // Set the success flag
                
                header("Location: emailChange.php");
                exit(); // Ensure the script stops after redirection
            } catch (PDOException $e) {
                $catchErrorMessage = "Database Error: " . $e->getMessage();
            }



        }
    }
}
// Display the error message or success message in HTML
if (!empty($catchErrorMessage)) {
    echo "<p>Error occurred: $catchErrorMessage</p>";
} elseif ($successful) {
    echo "<p>Successful! Email updated successfully.</p>";
}
?>


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Change Email</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <!-- Header -->
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
    <div class="profile-container">
        <form method="POST" action="">
        <?php echo "<div>Current Email: " . $currentEmail . "</div>" ?>
            <label for="currentEmail">Current Email:</label><br>
            <input type="email" id="currentEmail" name="currentEmail" required><br><br>
            <!-- <span id="currentEmailError" class="error-message"></span> -->
            <label for="newEmail">New Email:</label><br>
            <input type="email" id="newEmail" name="newEmail" required><br><br>
            <!-- <span id="newEmailError" class="error-message"></span><br> -->
            <label for="confirmNewEmail">Confirm New Email:</label><br>
            <input type="email" id="confirmNewEmail" name="confirmNewEmail" required><br>
            <!-- <br><span id="confirmNewEmailError" class="error-message"></span><br> -->
            <br><input type="submit" value="Submit" name="Change Email">
            <br><?php echo $catchErrorMessage ?>
        </form>
    </div>
</body>
<script src="../asset/js/script.js"></script>
</html>
