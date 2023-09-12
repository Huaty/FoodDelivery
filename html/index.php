<?php
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">s
  <title>Majulah Munchies</title>
</head>

<body>
  <header>
    <!-- Header -->
    <div class="nav-container">
      <!-- Logo -->
      <div class="logo-placement">
        <a href="index.php"><object data="../asset/image/Logo.svg" Alt="Logo" class="logo"></object></a>
      </div>
      <!-- End Logo -->
      <!-- Navigation Bar -->
      <ul class="nav-flex-right nav-flex-grow">
        <li class="nav-content "><a href="index.php"><span class="current-page">Home</span></a></li>
        <li class="nav-content"><a href="signup.php"><span>Menu</span></li>
        <li class="nav-content about-us"><a href="about.php"><span>About us</span></a></li>
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