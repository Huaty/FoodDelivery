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
    <script src="scriptforscroll.js" defer></script>
    <title>Majulah Munchies</title>
</head>

<body>
    <header>
        <!-- Header -->
        <div class="nav-container">
            <a href="index.php" class="button-style">
                <div class="logo-placement">
                    <img src="../asset/image/Logo.png" class="logo">
                </div>
            </a>
            <!-- Navigation Bar -->
            <ul class="nav-flex-right nav-flex-grow">
                <li class="nav-content "><a href="index.php"><span>Home</span></a></li>
                <li class="nav-content"><a href="previewmenu.php"><span class="current-page">Menu</span></li>
                <li class="nav-content"><a href="about.php"><span>About us</span></a></li>
                <li class="nav-content login"><a href="login.php"><span>Login</span></a></li>
        </div>
    </header>
    <!-- End Navigation Bar -->
    <!-- End Header -->

    <!-- Main Body -->
    <div class="slider-main-container">
        <section class="slider-container">
            <button class="slider-btn slider-btn-left">&lt;</button>
            <div class="slider-wrapper">
                <div class="slider">
                    <img src="../asset/image/food1.jpg" alt="img-1" class="image-item">
                    <img src="../asset/image/food2.jpg" alt="img-2" class="image-item">
                    <img src="../asset/image/food3.jpg" alt="img-3" class="image-item">
                    <img src="../asset/image/food4.jpg" alt="img-3" class="image-item">
                    <img src="../asset/image/food5.jpg" alt="img-3" class="image-item">
                    <img src="../asset/image/food6.jpg" alt="img-3" class="image-item">
                </div>
            </div>
            <button class="slider-btn slider-btn-right">&gt;</button>


            <div class="slider-scrollbar">
                <div class="scroll-track">
                    <div class="scrollbar-thumb"></div>
                </div>
            </div>
        </section>
    </div>

    <!--Footer -->
    <footer>
        <!-- Footer Top -->
        <div class="top">
        <a href="index.php">
            <div class="smallLogo">
                <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
                <p id="word">Munchies Together</p>
            </div>
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
        <!-- End Footer Top -->
        <div class="bottom">
            <p>&copy 2023 Majulah Munchies. All rights reserved.</p>
    </footer>
</body>


<script src="../asset/js/script.js"></script>

</html>

</html>