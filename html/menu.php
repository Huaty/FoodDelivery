<?php
require_once "error.php";
require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";

if (!isset($_SESSION['user_firstname']) || $_SESSION['user_firstname'] === null) {
    header("Location: ../html/login.php");
    exit();
}
var_dump($_SESSION);
try {
    require_once "../asset/includePHP/dbh.inc.php";
    $sql = "SELECT * FROM menus";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
//// Session_start(); is in config_session.inc.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if (isset($_POST["searchBar"])) {
    //     $searchCusines = $_POST["searchBar"];
    //     echo $searchCusines;
    // }


    $orders = [];
    $items = [];
    $index = 0;


    var_dump($_POST);
    foreach ($_POST as $key => $value) {

        if (strpos($key, "quantity_") === 0) {
            $index = str_replace("quantity_", "", $key);
            // echo ''. $key . ': ' . $value .' ' ;
            // echo '<br>';
            // echo $index;

            $items = [
                'item_id' => $index,
                'item_name' => $result[$index - 1]['foodname'],
                'quantity' => $_POST['quantity_' . $index],
                'price' => $_POST['price_' . $index],
            ];
        }
        $orders[$index] = $items;
    }
    // echo '<br>';
    // echo "Item Id " . (($items['item_id'])) . "";
    // echo '<br>';
    // echo "Item Name " . (($items['item_name'])) . "";
    // echo "<br>";
    // print_r($orders);
    // foreach ($orders as $order) {
    //     echo "Item ID" . $order['item_id'] . "<br>";
    //     echo "Item Name" . $order['item_name'] . "<br>";
    // }
    if (isset($orders)) {

        $_SESSION['orders'] = $orders;

        header("Location:payment.php");
    }
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

    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <div class="logo-placement">
            <a href="index.php"><object data="../asset/image/Logo.svg" Alt="Logo" class="logo"></object></a>
        </div>
        <div class="profile-dropdown">
            <button class="dropbtn">Welcome, <?php echo $_SESSION["user_firstname"] ?>
                <img src="bingwei.jpeg" alt="Profile Picture" class="profile-pic">
            </button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>


    </div>

    <form id="searchForm" action="" method="post">
        <div id="searchBar-container">Search Bar :<input type='text' name='searchBar' id="searchBar"></input></div>
    </form>
    <div id="menu-wrapper">
        <?php
        echo '<div class="image-grid">';
        foreach ($result as $row) {
            echo '<div id= "menuGridclass">';
            echo '<img  src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '"/>';
            echo '<div id="food-title-' . $row["item_id"] . '"> ' . $row["foodname"] . '</div>';
            echo '<div id="food-description-' . $row["item_id"] . '"> ' . $row["food_description"] . ' </div>';
            echo '<div id="price-' . $row["item_id"] . '"> $' . $row["price"] . ' </div>';
            echo '<div class="quantity-control">
            <button id="decrement-index-' . $row["item_id"] . '">-</button>
            <span id="quantity-menu-' . $row["item_id"] . '">0</span>
            <button id="increment-index-' . $row["item_id"] . '">+</button>
        </div>';
            echo '</div>';
        }
        echo '</div>';
        ?>
        <form action="" method="post" id="form-menu">
            <div class="order-card">
                <h2>Order Details</h2>
                <div class="order-content">
                    <div id="update-order">Add some items to get started !</div>
                    <div class="total">
                        <span>Total:</span>
                        <span>$<span id="total-amount">0</span></span>
                    </div>
                    <button type="submit" id="pay-button" disabled>PAY NOW</button>
                </div>
            </div>
        </form>
    </div>
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