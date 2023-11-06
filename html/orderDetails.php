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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&family=Koulen&family=Lalezar&family=Mitr:wght@200&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <div id="logo">
            <a href="menu.php" class="button-style">
                <div class="logo-placement">
                    <img src="../asset/image/Logo.png" class="logo">
                </div>
            </a>
        </div>
        <div class="profile-dropdown">
            <button class="dropbtn">
                <div id="welcome">Welcome, <strong><?php echo $_SESSION["user_firstname"] ?></div></strong>
                <img src="../asset/image/bingwei.jpeg" alt="Profile Picture" class="profile-pic">
            </button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Log out</a>
                <a href="orderDetails.php">Orders Details</a>
            </div>
        </div>
    </div>

    <div class="order-container">
        <div class="order-number-container">
            <div>
                <h2>Order Details</h2>
                <div class="order-details">
                    <?php
                    foreach ($orderResults as $orderResult) {
                        echo "<div id='wrapper'>";
                        echo "<div id= 'words'>";
                        echo "<div> Order ID: " . $orderResult['OrderID'] . "</div>";
                        echo "<div> Order Date: " . $orderResult['OrderDate'] . "</div>";
                        echo "<form action='orderDetails.php' method='post'>";
                        // Hidden input to store the order ID
                        echo "<input type='hidden' name='orderID' value='" . $orderResult['OrderID'] . "'>";
                        echo "</div>";
                        // Submit button
                        echo "<div id = 'details-submit-button'>";
                        echo "<input type='submit' value='View Order'>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }

                    ?>
                </div>
            </div>


        </div>
        <?php
        $totalPrice = 0;
        if ($orderDetailsResults) {
            echo " <div class='order-details-container'>";
            echo " <div class='product-description'>";

            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Description</th>";
            echo "<th>Quantity</th>";
            echo "<th>Amount</th>";
            echo " </tr>";
            echo "<tbody>"; // Open table body

            foreach ($orderDetailsResults as $orderDetailResult) {
                echo "<tr>";
                echo "<td>" . $orderDetailResult['FoodName'] . "</td>";
                echo "<td>" . $orderDetailResult['Quantity'] . "</td>";
                echo "<td>" . $orderDetailResult['TotalPrice'] . "</td>";
                echo "</tr>";
                $totalPrice +=  floatval($orderDetailResult['TotalPrice']);
            }
            echo "</tbody>"; // Close table body

            // Add the total price row
            echo "<tfoot>"; // Open table footer
            echo "<tr>";
            echo "<td colspan='2' style='text-align:right;'><strong>Total Price</strong></td>"; // Span two columns for total

            echo "<td class='amount'>" . number_format($totalPrice, 2) . "</td>";
            echo "</tr>";
            echo "</tfoot>"; // Close table footer

            echo "</table>";
            echo "</div>";
            echo "</div>";
        }

        ?>


    </div>






</body>
<script src="../asset/js/script.js"></script>

</html>