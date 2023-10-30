<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "../asset/includePHP/dbh.inc.php";
require_once "error.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
if ($_SESSION['orders'] === null) {
    header("Location:menu.php");
}

$orders = $_SESSION['orders'];
$userName = $_SESSION["user_firstname"];
$id = $_SESSION["user_id"];


$query = "SELECT homeaddress FROM users WHERE firstname=:email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $userName);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['submit'])) {
    require_once "../asset/includePHP/dbh.inc.php";
    $pdo->beginTransaction();
    try {
        $insertOrderQuery = "INSERT INTO orders (UserID, homeaddress, OrderDate) VALUES (:id, :homeaddress, :OrderDate)";
        $orderStmt = $pdo->prepare($insertOrderQuery);
        $orderStmt->bindParam(":id", $id);
        $orderStmt->bindParam(":homeaddress", $results['homeaddress']);
        $orderDate = date("Y-m-d H:i:s");
        $orderStmt->bindParam(":OrderDate", $orderDate);
        $orderStmt->execute();

        $lastOrderId = $pdo->lastInsertId(); //// take OrderID from orders table

        $insertOrderDetailQuery = "INSERT INTO OrderDetails (OrderID, FoodName, Quantity, TotalPrice) VALUES (:OrderID, :FoodName, :Quantity, :TotalPrice)";
        $orderDetailStmt = $pdo->prepare($insertOrderDetailQuery);

        foreach ($orders as $order) {
            $totalPrice = $order['price'] * $order['quantity'];
            $orderDetailStmt->bindParam(":OrderID", $lastOrderId);
            $orderDetailStmt->bindParam(":FoodName", $order['item_name']);
            $orderDetailStmt->bindParam(":Quantity", $order['quantity']);
            $orderDetailStmt->bindParam(":TotalPrice", $totalPrice);
            $orderDetailStmt->execute();
        }

        // Commit the transaction
        $pdo->commit();
    } catch (Exception $e) {
        // Rollback the transaction if there's an error
        $pdo->rollback();
        throw $e;
    }

    // Your existing payment processing logic

    // After processing the payment, include the code to send an email
    // require_once 'send_email.php';  Include the email sending script

    // Check the $mailSent variable to confirm the email status
    // if ($mailSent) {

    //     echo "Payment successful and email sent!";
    // } else {

    //     echo "Payment successful but failed to send an email. Please contact support.";
    // }
    unset($_SESSION['orders']); // clear the order session
    header('Location: success.php');
}



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