<?php
session_start();

if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to the registration page or login page.
    header("signup.php"); // Replace 'register.php' with your registration page URL.
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



</body>

</html>