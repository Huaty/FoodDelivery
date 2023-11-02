<?php

unset($_SESSION['user_firstname']);

if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach ($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    setcookie($name, '', time() - 1000);
    setcookie($name, '', time() - 1000, '/');
  }
}


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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Majulah Munchies</title>
</head>

<body>
  <header>
    <!-- Header -->
    <div class="nav-container">
      <!-- Logo -->
      <a href="index.php" class="button-style">
        <div class="logo-placement">
          <img src="../asset/image/Logo.png" class="logo">
        </div>
      </a>
      <!-- End Logo -->
      <!-- Navigation Bar -->
      <ul class="nav-flex-right nav-flex-grow">
        <li class="nav-content "><a href="index.php"><span class="current-page">Home</span></a></li>
        <li class="nav-content"><a href="previewmenu.php"><span>Menu</span></li>
        <li class="nav-content"><a href="about.php"><span>About us</span></a></li>
        <li class="nav-content login"><a href="login.php"><span>Login</span></a></li>
    </div>
  </header>

  <!-- End Navigation Bar -->
  <!-- End Header -->

  <!-- Main Body -->
  <div class="main-container">
    <!-- Top Content-->
    <div class="top">
      <!-- Top Left Content -->
      <div class="left-content">
        <div>
          <h1 id="header">From Chef's Pan to your Plate, <br><span id="red-heading">Swift</span> and <span id="red-heading">Great!</span></h1>
        </div>
        <div>
          <p id="body">Deliciousness delivered, one bite at a time.</p>
        </div>
      </div>
      <!--- End Top Left Content -->
      <!-- Top Right Content -->
      <div class="right-content">
        <img src="../asset/image/manridingbicycle.jpg" alt="manridingbicycle" class="img">
      </div>
      <!-- End Top Right Content -->
    </div>
    <!-- End Top Content -->
    <!-- Bottom Content -->
    <div class="bottom">

      <div id="top"><a href="about.php">About us</a>
      </div>
      <div id="body"><a href="signup.php">
          Join Us Today! </a>
      </div>
      <div id="bottom">
        <div id="left">
          <span id="red-heading"> Majulah</span> Munchies
        </div>
        <div id="right">
          <span class="wrapper">

            <span>
              <img src="../asset/image/responsible.png" alt="Operational" class="img">
            </span>
            <span id="word">
              <span id="heading">Operational Excellence</span> <br> We believe that excellence in delivery is the cornerstone of operational sucess.
            </span>
          </span>

          <span class="wrapper">
            <span>
              <img src="../asset/image/responsible.png" alt="Operational" class="img">
            </span>
            <span id="word">
              <span id="heading">Operational Excellence</span> <br> We believe that excellence in delivery is the cornerstone of operational sucess.
            </span>
          </span>

          <span class="wrapper">
            <span>
              <img src="../asset/image/responsible.png" alt="Operational" class="img">
            </span>
            <span id="word">
              <span id="heading">Operational Excellence</span> <br> We believe that excellence in delivery is the cornerstone of operational sucess.
            </span>
          </span>

        </div>
      </div>
    </div>
    <!-- End Bottom Content -->
  </div>
  <!-- End Main Body -->
  <!--Footer -->
  <footer>
    <!-- Footer Top -->
    <div class="top">
      <a href="index.php">
        <div class="smallLogo">
          <object data="../asset/image/smallLogo.svg" alt="smallLogo" id="img"></object>
          <p id="word">Munchies Together</p>
        </div>
      </a>
      <div class="contact">
        <p>Contact Us </p>
        <div class="small-icon">
          <a href="https://www.instagram.com/" target="_blank">
            <img src="../asset/image/instagram.png" alt="instagram" class="img">
          </a>
          <a href="https://www.twitter.com/" target="_blank">
            <img src="../asset/image/twitter.png" alt="Twitter" class="img">
          </a>
        </div>
      </div>
      <div class="statement">
        <p><a href="privacy_policy.html">Privacy Policy</a></p>
        <p><a href="terms_conditions.html">Terms & Conditions</a></p>
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