<?php

include("../asset/db_connection.php");
$conn = Opencon();
session_start();

$_SESSION['username'] = "test1";



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&family=Koulen&family=Lalezar&family=Mitr:wght@200&display=swap" rel="stylesheet">
  <title>Majulah Munchies</title>
</head>

<body>
  <header>
    <button id="back-button">
      <a href="index.php">
        <img src="../asset/image/Backarrow.svg" alt="back-arrow" id="back-arrow-img">
      </a>
    </button>
  </header>

  <div class="main-container-login-register">
    <div class="wrapper-signup">
      <form method="POST" action="process_signup.php" class="signup-input" onsubmit="return validateForm()">
        <label for="name">name</label>
        <input type="text" name="name" id="name" class="name" required />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="email" />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="password" required />
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="address" required />
        <input type="submit" value="submit" class="signup-button" />
      </form>
      <div id="error-message"></div>
      <div id="password-short"></div>
      <div class="link-login">
        <p>If you don't have an account, <a href="login.php">Login</a> here!</p>
      </div>
      <div class="smallLogo">
        <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
        <p id="word">Munchies Together</p>
      </div>
    </div>
  </div>
</body>
<script src="../asset/js/script.js"></script>

</html>