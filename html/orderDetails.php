<?php

require_once "../asset/includePHP/config_session.inc.php";
require_once "error.php";
$userId = $_SESSION["user_id"];

if (!isset($_SESSION['user_firstname']) || $_SESSION['user_firstname'] === null) {
    header("Location: ../html/login.php");
    exit();
}

try {
    require_once "../asset/includePHP/dbh.inc.php";
    $orderQuery = "SELECT * FROM Orders WHERE UserID= :UserId";
    $orderStmt = $pdo->prepare($orderQuery);
    $orderStmt->bindParam(":UserId", $userId);
    $orderStmt->execute();
    $orderResults = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$orderDetailsResults = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $orderID = $_POST['orderID'];
        $orderDetailsQuery = "SELECT * FROM OrderDetails WHERE OrderID= :OrderID";
        $orderDetailsStmt = $pdo->prepare($orderDetailsQuery);
        $orderDetailsStmt->bindParam(":OrderID", $orderID);
        $orderDetailsStmt->execute();
        $orderDetailsResults = $orderDetailsStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <a class="button-style">
            <div class="logo-placement">
                <img src="../asset/image/Logo.png" class="logo">
            </div>
        </a>
        <div class="profile-dropdown">
            <button class="dropbtn">Welcome, <?php echo $_SESSION["user_firstname"] ?>
                <img src="../asset/image/bingwei.jpeg" alt="Profile Picture" class="profile-pic">
            </button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="logout.php">Log out</a>
                <a href="#">Orders Details</a>
            </div>
        </div>
    </div>

    <div class="order-container">
        <div>
            <h2>Order Details</h2>
            <div class="order-details">
                <?php
                foreach ($orderResults as $orderResult) {

                    echo "<div> Order ID: " . $orderResult['OrderID'] . "</div>";
                    echo "<div> Order Date: " . $orderResult['OrderDate'] . "</div>";
                    echo "<form action='orderDetails.php' method='post'>";
                    // Hidden input to store the order ID
                    echo "<input type='hidden' name='orderID' value='" . $orderResult['OrderID'] . "'>";
                    // Submit button
                    echo "<input type='submit' value='View Order'>";
                    echo "</form>";
                }

                ?>
            </div>
        </div>
        <div>
            <div>
                <?php
                if ($orderDetailsResults) {
                    foreach ($orderDetailsResults as $orderDetailResult) {
                        echo "<div> Item Name: " . $orderDetailResult['FoodName'] . "</div>";
                        echo "<div> Quantity: " . $orderDetailResult['Quantity'] . "</div>";
                        echo "<div> Price: " . $orderDetailResult['TotalPrice'] . "</div>";
                    }
                }

                ?>
            </div>
        </div>
    </div>

</body>
<script src="../asset/js/script.js"></script>

</html>