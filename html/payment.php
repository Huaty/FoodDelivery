<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "../asset/includePHP/dbh.inc.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_SESSION['orders']);
$orders = $_SESSION['orders'];

$userName = $_SESSION["user_firstname"];

$query = "SELECT homeaddress FROM users WHERE firstname=:email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $userName);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Menu</title>
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
                <!-- <li class="nav-content "><a href="index.php"><span>Home</span></a></li>
                <li class="nav-content"><a href="signup.php"><span>Menu</span></li>
                <li class="nav-content about-us"><a href="about.php"><span class="current-page">About us</span></a></li>
                <li class="nav-content login"><a href="login.php"><span>Login</span></a></li> -->
        </div>
    </header>

    <div>
        <div class="container-payment">
            <h2>ORDER DETAILS:</h2>
            <p>Create on Date at Time</p>

            <table>
                <tr>
                    <th>FOOD</th>
                    <th>QUANTITY</th>
                    <th>PRICE OF EACH ITEM</th>
                </tr>
                <?php
                $totalAmount = 0;
                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>" . $order['item_name'] . "</td>";
                    echo "<td>" . $order['quantity'] . "</td>";
                    echo "<td>" . $order['price'] * $order['quantity'] . "</td>";
                    echo "</tr>";
                    $totalAmount += $order['price'] * $order['quantity'];
                }
                ?>
                <tr>
                    <?php
                    echo "<td>TOTAL:</td>";
                    echo "<td></td>";
                    echo "<td>$totalAmount</td>";
                    ?>
                </tr>
            </table>

            <h2>ADDRESS:</h2>
            <p><?php
                foreach ($results as $result) {
                    echo $result;
                }
                ?></p>

            <h2>PAYMENT METHOD:</h2>
            <div class="payment-methods">
                <label> CARD</label>
            </div>

            <div>
                <label>NAME:</label><br>
                <input type="text" name="card_name"><br><br>

                <label>CARD DETAILS:</label><br>
                <input type="tel">
                <input type="tel">
                <input type="tel"><br><br>

                <form method="post" action="">

                <button type="submit" name="submit">PAY</button>
                </form>

                <?php
            if (isset($_POST['submit'])) {
                // Your existing payment processing logic

                // After processing the payment, include the code to send an email
                require_once 'send_email.php'; // Include the email sending script

                // Check the $mailSent variable to confirm the email status
                if ($mailSent) {
                    // Email sent successfully
                    // You can redirect the user or show a success message here
                    echo "Payment successful and email sent!";
                } else {
                    // Email sending failed
                    // You can redirect the user or show an error message here
                    echo "Payment successful but failed to send an email. Please contact support.";
                }
            }
            ?>

            </div>
        </div>

    </div>
    <div>
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