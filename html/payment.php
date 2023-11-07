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
        date_default_timezone_set('Asia/Singapore');
        $orderDate = date("Y-m-d H:i:s");
        $orderStmt->bindParam(":OrderDate", $orderDate);
        $orderStmt->execute();

        $lastOrderId = $pdo->lastInsertId(); //// take OrderID from orders table

        $insertOrderDetailQuery = "INSERT INTO OrderDetails (OrderID, FoodName, Quantity, TotalPrice) VALUES (:OrderID, :FoodName, :Quantity, :TotalPrice)";
        $orderDetailStmt = $pdo->prepare($insertOrderDetailQuery);



        foreach ($orders['indexfood'] as $index => $foodId) {
            $query = "SELECT foodname FROM menus WHERE item_id=:foodId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":foodId", $foodId);
            $stmt->execute();
            $resultFoodName = $stmt->fetch(PDO::FETCH_ASSOC);
            $itemName = $resultFoodName['foodname']; // Assuming you might want to look up the actual name based on this ID.
            $quantity = isset($orders['quantity'][$index]) ? intval($orders['quantity'][$index]) : 0;
            $price = isset($orders['price'][$index]) ? floatval($orders['price'][$index]) : 0;
            $itemTotal = $price * $quantity;

            $orderDetailStmt->bindParam(":OrderID", $lastOrderId);
            $orderDetailStmt->bindParam(":FoodName", $itemName);
            $orderDetailStmt->bindParam(":Quantity", $quantity);
            $orderDetailStmt->bindParam(":TotalPrice", $itemTotal);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&family=Koulen&family=Lalezar&family=Mitr:wght@200&display=swap" rel="stylesheet">
    <title>Menu</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
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
    </div>

    <div class="payment-body card-content">
        <div class="container-payment">
            <div class="orderdetail">

                <!-- <div class="payment-logo">
                <p>p</p>
                </div> -->
            </div>
            <div id="table-order-details">
                <h2>ORDER DETAILS:</h2>
                <table>
                    <tr>
                        <th>FOOD</th>
                        <th>QUANTITY</th>
                        <th>PRICE OF EACH ITEM</th>
                    </tr>
                    <?php
                    $totalAmount = 0;


                    foreach ($orders['indexfood'] as $index => $foodId) {

                        $query = "SELECT foodname FROM menus WHERE item_id=:foodId";
                        $stmt = $pdo->prepare($query);

                        $stmt->bindParam(":foodId", $foodId);
                        $stmt->execute();
                        $resultFoodName = $stmt->fetch(PDO::FETCH_ASSOC);
                        $itemName = $resultFoodName['foodname']; // Assuming you might want to look up the actual name based on this ID.
                        $quantity = isset($orders['quantity'][$index]) ? intval($orders['quantity'][$index]) : 0;
                        $price = isset($orders['price'][$index]) ? floatval($orders['price'][$index]) : 0;
                        $itemTotal = $price * $quantity;

                        echo "<tr>";
                        echo "<td>" . $itemName . "</td>"; // As mentioned before, for safety
                        echo "<td>" . $quantity . "</td>";
                        echo "<td>" . number_format($itemTotal, 2) . "</td>";
                        echo "</tr>";

                        $totalAmount += $itemTotal;
                    }

                    // At the end, you can display the totalAmount if needed.

                    ?>
                    <tr>
                        <?php
                        echo "<td>TOTAL:</td>";
                        echo "<td></td>";
                        echo "<td>$totalAmount</td>";
                        ?>
                    </tr>
                </table>
                <div id="payment-address">
                    <h2>ADDRESS:</h2>
                    <p><?php
                        foreach ($results as $result) {
                            echo $result;
                        }
                        ?></p>
                </div>
            </div>



    <div class="payment-methods card-content">
        <h2>Payment Method:</h2>
        <div class="card space icon-relative">
            <label class="label"> Card Holder: </label>
            <input type="text" class="input-payment" name="card_holder" placeholder="Name">
            <i class="fas fa-user"></i>
        </div>
        <div class="class space icon-relative">
            <label class="label">Card Number:</label>
            <input type="tel" class="input-payment" data-mask="0000 0000 0000 0000" name="card_number" placeholder="Card Number" minlength="16">
            <i class="far fa-credit-card"></i>
        </div>
        <div class="card-grp">
            <div class="card-item icon-relative">
                <label class="label">Expiry Date:</label>
                <input type="number" class="input-payment" min="1000" name="expiry_date" placeholder="0000">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="card-item icon-relative">
                <label class="label">CVC:</label>
                <input type="number" class="input-payment" name="cvc" placeholder="000" minlength="3">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div id="payment-btn-container">
            <form method="post" action="" onsubmit="return validateFormpayment()">
                <button type="submit" name="submit" class="button-3d gradient-animate pulse-icon">PAY</button>
            </form>
        </div>
        <div class="smallLogo">
            <object data="../asset/image/smallLogo.svg" Alt="smallLogo" id="img"></object>
            <p id="word">Munchies Together</p>
            <p>&copy; 2023 Majulah Munchies. All rights reserved.</p>
        </div>

        <script>
            function validateFormpayment() {
                const cardHolder = document.querySelector('input[name="card_holder"]').value;
                const cardNumber = document.querySelector('input[name="card_number"]').value;
                const expiryDate = document.querySelector('input[name="expiry_date"]').value;
                const cvc = document.querySelector('input[name="cvc"]').value;

                if (
                    cardHolder.trim() === '' ||
                    cardNumber.trim().length < 16 ||
                    expiryDate.trim().length !== 4 ||
                    cvc.trim().length < 3
                ) {
                    let errorMessage = "Please fill in the payment details correctly: \n";
                    if (cardHolder.trim() === '') {
                        errorMessage += "- Card Holder name is required\n";
                    }
                    if (cardNumber.trim().length !== 16) {
                        errorMessage += "- Card Number should have 16 digits\n";
                    }
                    if (expiryDate.trim().length !== 4) {
                        errorMessage += "- Expiry Date should be 4 digits (MMYY format)\n";
                    }
                    if (cvc.trim().length !== 3) {
                        errorMessage += "- CVC should be 3 digits\n";
                    }
                    alert(errorMessage);
                    return false;
                }

                return true;
            }
        </script>

    </div>
    <div>
        <footer>
        </footer>
</body>


<script src="../asset/js/script.js"></script>


</html>