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




if (($_SESSION["user_firstname"]) !== "admin") {
    header("Location: menu.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../asset/includePHP/dbh.inc.php";
    require_once "menu_model.inc.php";
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;
    echo $formType;

    switch ($formType) {
        case 'create_new_food':
            if (isset($_FILES["foodImage"])) {
                if ($_FILES["foodImage"]["error"] == 0) {
                    $foodName = $_POST["foodName"];
                    $cuisine = $_POST["cuisine"];
                    $price = $_POST['price'];
                    $food_description = $_POST["foodDescription"];
                    $foodImage = file_get_contents($_FILES["foodImage"]["tmp_name"]);

                    try {
                        $insertNewFood = "INSERT INTO menus (foodname, cuisine, food_description,price,image_data) VALUES (:foodName, :cuisine, :food_description,:price,:image_data)";
                        $insertStmt = $pdo->prepare($insertNewFood);
                        $insertStmt->bindParam(':foodName', $foodName, PDO::PARAM_STR);
                        $insertStmt->bindParam(':cuisine', $cuisine, PDO::PARAM_STR);
                        $insertStmt->bindParam(':food_description', $food_description, PDO::PARAM_STR);
                        $insertStmt->bindParam(':price', $price, PDO::PARAM_STR);  // Assuming price is an integer
                        $insertStmt->bindParam(':image_data', $foodImage, PDO::PARAM_LOB);  // Using LOB for binary data
                        echo "working";
                        $insertStmt->execute();
                    } catch (PDOException $e) {
                        die("ERROR: Could not execute $insertNewFood. " . $e->getMessage());
                    }
                } else {
                    echo "File upload error: " . $_FILES["foodImage"]["error"];
                }
            }
            break;
        case "create_menu":
            echo "Menu Table have intialize";
            create_menu($pdo);
            break;

        case "update_food":
            var_dump($_POST);
            $foodname = $_POST['foodname'];
            $foodDescription = $_POST['foodDescription'][$foodname];
            $price = $_POST['price'][$foodname];

            try {
                if (!empty($_FILES["foodImage"]["tmp_name"][$foodname])) {
                    /// Admin upload image 
                    $foodImage = file_get_contents($_FILES["foodImage"]["tmp_name"][$foodname]);

                    // Update query with image data
                    $updateFood = "UPDATE menus SET food_description = :foodDescription, price = :price ,image_data =:image_data WHERE foodname = :foodname";
                    $updateStmt = $pdo->prepare($updateFood);
                    $updateStmt->bindParam(':image_data', $foodImage, PDO::PARAM_LOB);
                } else {

                    /// Admin did not upload image
                    $updateFood = "UPDATE menus SET food_description = :foodDescription, price = :price WHERE foodname = :foodname";
                    $updateStmt = $pdo->prepare($updateFood);
                }
                $updateStmt->bindParam(':foodDescription', $foodDescription, PDO::PARAM_STR);
                $updateStmt->bindParam(':price', $price, PDO::PARAM_STR);  // Assuming price is an integer
                $updateStmt->bindParam(':foodname', $foodname, PDO::PARAM_STR);
                $updateStmt->execute();
                header("Location: adminpage.php");
            } catch (PDOException $e) {
                die("ERROR: Could not execute $updateFood. " . $e->getMessage());
            }
            break;
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
        <form action="adminpage.php" method="POST">
            <div id="wrapper">Update Menu</div>
            <div id="wrapper">Intialize Menu
                <input type="hidden" name="form_type" value="create_menu" id="create_menu">
                <div><button type="submit" id="submit-button-create-menu">Click me</button></div>
            </div>
        </form>

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

                                echo '<tr class = admin-food-menu>';

                                // Displaying Food Name as simple text
                                echo '<td class=admin-food-name>' . $row['foodname'] . '</td>';

                                // Displaying Cuisine as simple text
                                echo '<td>' . $row['cuisine'] . '</td>';

                                // Input field for Food Description
                                echo "<form method='POST' enctype='multipart/form-data' id='form-" . $row['foodname'] . "'>";
                                echo "<input type=hidden name=form_type value=update_food id=>";
                                echo "<input type=hidden name=foodname value='" . $row['foodname'] . "' id='foodname'>";
                                echo '<td>';
                                echo "<textarea name='foodDescription[" . $row['foodname'] . "]'>" . $row['food_description'] . "</textarea>";
                                echo '</td>';

                                // Input field for Price
                                echo '<td>';
                                echo "<input type='number' step='0.01' name='price[" . $row['foodname'] . "]' value='" . $row['price'] . "' id='price'>";
                                echo '</td>';

                                // Display current Image and provide input for new Image
                                echo '<td>';
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" width="100"/>';
                                echo "<div> Upload new image </div>";
                                echo "<input type='file' name='foodImage[" . $row['foodname'] . "]'>";
                                echo '</td>';
                                echo '</form>';
                                // Update button
                                echo '<td>';
                                echo "<input type='submit' id ='" . $row['foodname'] . "'>";
                                echo '</td>';

                                echo '</tr>';
                            }

                            ?>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">

            <div id="wrapper">Add Food </div>
            <input type="hidden" name="form_type" value="create_new_food" id="create_new_food_hidden">
            <label for="Foodname">Food name</label>
            <input type="text" name="foodName" id="foodName">

            <label for="Cuisine">Cuisine</label>
            <input type="text" name="cuisine" id="cuisine">

            <label for="Food Description">Food Description</label>
            <input type="text" name="foodDescription" id="foodDescription">

            <label for="Price">Price</label>
            <input type="number" name="price" id="price">

            <label for="foodImage">Food Image</label>
            <input type="file" name="foodImage" id="foodImage">

            <input type="submit" value="Upload Food" id="submit-button-create-new-food">
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