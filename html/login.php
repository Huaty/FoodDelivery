<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
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
    <div class="wrapper-login">
      <form method="POST" action="" class="login-input">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="email" />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="password" />
        <input type="submit" value="login" class="login-button" />
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