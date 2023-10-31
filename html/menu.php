<?php
require_once "error.php";
require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";


if (!isset($_SESSION['user_firstname']) || $_SESSION['user_firstname'] === null) {
    header("Location: ../html/login.php");
    exit();
}

try {
    require_once "../asset/includePHP/dbh.inc.php";
    $sql = "SELECT * FROM menus";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}

$orders = [];
$items = [];
$index = 0;
$searchFood = '';
$selectedCuisine = '';

//// Session_start(); is in config_session.inc.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;


    switch ($formType) {
        case 'searchForm':
            if (isset($_POST["searchBar"])) {
                $searchFood = $_POST["searchBar"];
                $searchFood = strtolower(trim($searchFood));
            }

            if (isset($_POST["cuisine"])) {
                $selectedCuisine = isset($_POST['cuisine']) ? $_POST['cuisine'] : '';
                echo $selectedCuisine;
            }
            break;

        case 'form-menu':
            foreach ($_POST as $key => $value) {
                if (strpos($key, "quantity_") === 0) {
                    $index = str_replace("quantity_", "", $key);
                    $quantity = isset($_POST['quantity_' . $index]) ? $_POST['quantity_' . $index] : null;
                    $price = isset($_POST['price_' . $index]) ? $_POST['price_' . $index] : null;
                    $item_name = isset($result[$index - 1]) ? $result[$index - 1]['foodname'] : null;
                    print_r($result[0]['item_id']);
                    $orders[$index] = [
                        'item_id' => $index,
                        'item_name' => $item_name,
                        'quantity' => $quantity,
                        'price' => $price
                    ];
                }
            }
            $_SESSION['orders'] = $orders;
            header("Location:payment.php");
            break;

        default:
            // Unknown form or no identifier found. Handle accordingly.
            break;
    }
    // echo '<br>';
    // echo "Item Id " . (($items['item_id'])) . "";
    // echo '<br>';
    // echo "Item Name " . (($items['item_name'])) . "";
    // echo "<br>";

}
$pdo = null;
$stmt = null;


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
                <a href="profile.php">Profile</a>
                <a href="logout.php">Log out</a>
                <a href="orderDetails.php">Orders Details</a>
            </div>
        </div>
    </div>


    </div>
    <div id="search-container">
        <form id="searchForm" action="" method="post">
            <input type="hidden" name="form_type" value="searchForm">
            <div id="searchBar-container">Search Bar :<input type='text' name='searchBar' id="searchBar" value=<?php echo isset($_POST['searchBar']) ? $_POST['searchBar'] : ""; ?>></div>
            <div id="dropDown-container">
                Cuisine:
                <select name="cuisine" id="dropBox-menu">
                    <?php
                    echo "<option value=''>All</option>";
                    foreach ($result as $row) {
                        $selected = ($row['cuisine'] == $selectedCuisine) ? 'selected' : '';
                        echo "<option value='" . $row['cuisine'] . "' $selected>" . $row['cuisine'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </form>

    </div>


    <div id="menu-wrapper">
        <?php
        echo '<div class="image-grid">';
        foreach ($result as $row) {
            $foodNameProcessed = strtolower($row['foodname']);
            $cuisineProcessed = strtolower($row['cuisine']);
            //// If food name does not contain search food, skip this food
            //// Example $foodNameProcessd = Strawberry 
            ///// $searchFood = berry
            ////There strpos will return 5, which is not false, so it will skip this food and go next interation
            if ($searchFood && strpos($foodNameProcessed, $searchFood) === false) {
                continue;
            }
            if ($selectedCuisine && $cuisineProcessed != $selectedCuisine) {
                continue;
            }
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
                    <input type="hidden" name="form_type" value="form-menu">
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