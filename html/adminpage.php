<?php
require_once "error.php";
require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";
require_once "../asset/includePHP/dbh.inc.php";



try {
    $sql = "SELECT * FROM menus";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}




var_dump($_SESSION);

if (($_SESSION["user_firstname"]) !== "admin") {
    header("Location: menu.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../asset/includePHP/dbh.inc.php";
    require_once "menu_model.inc.php";
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;
    switch ($formType) {
        case "create_menu":
            echo "Menu Table have intialize";
            create_menu($pdo);
            break;
        case 'add-food':
            // if (isset($_FILES["foodImage"])) {
            //     if ($_FILES["foodImage"]["error"] == 0) {
            //         $movieImage = file_get_contents($_FILES["foodImage"]["tmp_name"]);
            //         InsertMovie($myconnect, $_POST["foodName"], $_POST["movieGenre"], $_POST["movieDescription"], $movieImage);
            //     } else {
            //         echo "File upload error: " . $_FILES["movieImage"]["error"];
            //     }

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
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>

    <div id="admin-container">
        <h1>Welcome to Admin Page </h1>
        <form action="adminpage.php" method="post">
            <div id="wrapper">Update Menu</div>
            <div id="wrapper">Intialize Menu
                <input type="hidden" name="form_type" value="create_menu" id="create_menu">
                <div><button type="submit" id="submit-button-create-menu">Click me</button></div>
            </div>
            <div id="wrapper">
                <h2>View Orders</h2>
                <div>
                    <table class="food-admin-table">
                        <thead>
                            <tr>
                                <th>Food Name</th>
                                <th>Cuisine</th>
                                <th>Food Description</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                            <tr>
                                <?php
                                foreach ($result as $row) {
                                    echo '<tr>';
                                    echo '<td> ' . $row['foodname'] . '</td> ';
                                    echo '<td> ' . $row['cuisine'] . '</td> ';
                                    echo '<td> ' . $row['food_description'] . '</td> ';
                                    echo '<td> ' . $row['price'] . '</td> ';
                                    echo '<td> <img  src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '"/></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>

        <form action="" method="post" enctype="multipart/form-data">
            <input type='hidden' value='add-new-food' name='form_type'>
            <div id="wrapper">Add Food </div>
            <input type="hidden" name="form_type" value="create_new_movie" id="create_new_movie_hidden">
            <label for="Foodname">Food name</label>
            <input type="text" name="foodName" id="foodName">

            <label for="Cuisine">Cuisine</label>
            <input type="text" name="cuisine" id="cuisine">

            <label for="Food Description">Food Description</label>
            <input type="text" name="foodDescription" id="foodDescription">

            <label for="Price">Price</label>
            <input type="number" name="Price" id="Price">

            <label for="foodImage">Food Image</label>
            <input type="file" name="foodImage" id="foodImage">

            <input type="submit" value="Upload Food" id="submit-button-create-new-food">

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