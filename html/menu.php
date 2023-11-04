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



try {
    require_once "../asset/includePHP/dbh.inc.php";
    $userEmail = $_SESSION["user_email"];
    $sql = "SELECT homeaddress FROM users WHERE email = :userEmail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $homeAddress = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}

$orders = [];
$items = [];
$index = 0;
$searchFood = '';
$selectedCuisine = '';
$cnt = 0;
//// Session_start(); is in config_session.inc.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;


    switch ($formType) {

        case 'searchCuisine':
            if (isset($_POST["cuisine"])) {

                $selectedCuisine = isset($_POST['cuisine']) ? $_POST['cuisine'] : '';
            }
            break;

        case 'searchForm':
            if (isset($_POST["searchBar"])) {
                $searchFood = $_POST["searchBar"];
                $searchFood = strtolower(trim($searchFood));
            }
            break;


        case 'form-menu':

            $foodDetails = [];
            unset($_POST['form_type']);
            // var_dump($_POST);
            $organizedData = [
                'indexfood' => [],
                'quantity' => [],
                'price' => [],
                'totalPrice' => [],
            ];

            foreach ($_POST as $key => $value) {
                $keyParts = explode('_', $key);
                $type = $keyParts[0];
                $index = $keyParts[1];

                $organizedData[$type][$index] = $value;
            }

            $_SESSION['orders'] = $organizedData;
            header("Location:payment.php");
            break;

        default:

            break;
    }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&family=Koulen&family=Lalezar&family=Mitr:wght@200&display=swap" rel="stylesheet">
    <title>Menu</title>
</head>


<body>

    <!-- Header -->
    <div class="nav-container-menu">
        <!-- Logo -->
        <div id="logo">
            <div class="logo-placement">
                <a href="menu.php" class="button-style">
                    <img src="../asset/image/Logo.png" class="logo">
                </a>
            </div>

        </div>
        <div id="search-container">
            <form id="searchForm" action="" method="post">
                <input type="hidden" name="form_type" value="searchForm">
                <div id="searchBar">
                    <div><img src="../asset/image/search.png" id="searchIcon"></div>
                    <div id="searchBar-container"><input type='text' placeholder="Food Name" id="input" name='searchBar' value=<?php echo isset($_POST['searchBar']) ? $_POST['searchBar'] : ""; ?>></div>
                </div>

            </form>

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




    <div id="menu-wrapper">
        <div class="nav-menu">
            <div id="deliveryLocation">
                <div> <img src="../asset/image/bicycle.png" alt="Delivery" class="icon"><!-- Replace with your image path --></div>
                <div class="location">
                    <span class="now">Now</span>
                    <?php
                    echo $homeAddress[0]["homeaddress"]
                    ?>
                </div>
            </div>
            <div id="cuisine">
                <div class="text">Cuisine</div>
                <div class="collapsible">
                    <button class="toggleButton">▼</button>
                </div>
            </div>


            <div class="content" style="display:none">
                <form id="searchCuisine" action="" method="post">
                    <input type="hidden" name="form_type" value="searchCuisine">
                    <div id="dropDown-container">
                        <div id="cuisine-buttons">
                            <button data-cuisine="all" class="<?php echo ($selectedCuisine == 'all') ? 'selected' : ''; ?>">All</button>
                            <?php
                            // Create an array to store all cuisines
                            $allCuisines = [];

                            // Populate the array with cuisines from each row
                            foreach ($result as $row) {
                                $allCuisines[] = $row['cuisine'];
                            }

                            // Remove duplicates from the array
                            $uniqueCuisines = array_unique($allCuisines);


                            // Loop through each unique cuisine to generate the buttons
                            foreach ($uniqueCuisines as $cuisine) {
                                $selectedClass = ($cuisine == $selectedCuisine) ? 'selected' : '';
                                echo "<button type='submit' name ='cuisine' class='cuisine-button' value ='" . $cuisine . "'>" . $cuisine . "</button>";
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="menu-content"> <?php
                                echo '<div class="image-grid">';
                                foreach ($result as $row) {
                                    $foodNameProcessed = strtolower($row['foodname']);
                                    $cuisineProcessed = strtolower($row['cuisine']);


                                    //// If food name does not contain search food, skip this food
                                    //// Example $foodNameProcessd = Strawberry 
                                    ///// $searchFood = berry
                                    ////There strpos will return 5, which is not false, so it will skip this food and go next interation
                                    if (strtolower($selectedCuisine) && $cuisineProcessed != strtolower($selectedCuisine)) {
                                        continue;
                                    }
                                    if ($searchFood && strpos($foodNameProcessed, $searchFood) === false) {
                                        continue;
                                    }


                                    echo '<div id= "menuGridclass">';
                                    echo '<div type="hidden" class = "id-menu" id="' . $row["item_id"] . '"></div>';
                                    echo '<img  src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '"/>';
                                    echo '<div class="food-content">';
                                    echo '<div class="price-container"><div class="price" id="price-' . $row["item_id"] . '"> $' . $row["price"] . ' </div></div>';
                                    echo '<div class="menu-content">';
                                    echo '<div class="foodtitle-container"><div class="foodtitle" id="food-title-' . $row["item_id"] . '"> ' . $row["foodname"] . '</div></div>';
                                    echo '<div class="food-description-container"><div class="food-description" id="food-description-' . $row["item_id"] . '"> ' . $row["food_description"] . ' </div></div>';
                                    echo '<div class="quantity-control-container"><div class="quantity-control">
                <button id="decrement-index-' . $row["item_id"] . '">-</button>
                <span id="quantity-menu-' . $row["item_id"] . '">0</span>
                <button id="increment-index-' . $row["item_id"] . '">+</button>
            </div></div>';
                                    echo '</div>';
                                    echo '</div>';
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