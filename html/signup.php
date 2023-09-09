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
  <link rel="stylesheet" href="https://fonts.google.com/specimen/Just+Another+Hand">
  <title>Majulah Munchies</title>
</head>

<body>
  <header>
    <object data="../asset/image/Backarrow.svg" Alt="Back" class="back"></object>
  </header>

  <div class="main-container-login-register">
    <div class="wrapper-signup">
      <form method="GET" action="" class="signup-input">
        <label for="name">name</label>
        <input type="text" name="name" id="name" class="name" />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="email" />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="password" />
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="address" />
        <input type="submit" value="login" class="login" />
      </form>
      <div class="link-signup">
        <p>If you don't have an account, <a href="signup.php">Sign up</a> here!</p>
      </div>
      <div class="smallLogo">
        <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
        <p id="word">Munchies Together</p>
      </div>
    </div>
  </div>
</body>


</html>