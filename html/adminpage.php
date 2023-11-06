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



if (($_SESSION["user_email"]) != "admin@gmail.com") {
    header("Location: menu.php");
}

$selectedCuisine = '';
$selectedCategory = '';

// Create an array to store all categories
$allCategories = [];
$allCuisines = [];

// Populate the array with categories from each row
foreach ($result as $row) {
    $allCategories[] = $row['category_course'];
    $allCuisines[] = $row['cuisine'];
}

// Remove duplicates from the array
$uniqueCategories = array_unique($allCategories);
$uniqueCuisines = array_unique($allCuisines);




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
                    $category_course = $_POST['categoryCourse'];
                    $category_food = $_POST['categoryCuisine'];
                    echo $category_course;
                    echo $category_food;

                    try {
                        $insertNewFood = "INSERT INTO menus (foodname,cuisine,category_course,category_food,food_description,price,image_data) VALUES (:foodName, :cuisine,:category_course,:category_food,:food_description,:price,:image_data)";
                        $insertStmt = $pdo->prepare($insertNewFood);
                        $insertStmt->bindParam(':foodName', $foodName, PDO::PARAM_STR);
                        $insertStmt->bindParam(':cuisine', $cuisine, PDO::PARAM_STR);
                        $insertStmt->bindParam(':food_description', $food_description, PDO::PARAM_STR);
                        $insertStmt->bindParam(':category_course', $category_course, PDO::PARAM_STR);
                        $insertStmt->bindParam(':category_food', $category_food, PDO::PARAM_STR);
                        $insertStmt->bindParam(':price', $price, PDO::PARAM_STR);  // Assuming price is an integer
                        $insertStmt->bindParam(':image_data', $foodImage, PDO::PARAM_LOB);  // Using LOB for binary data
                        echo "working";
                        $insertStmt->execute();
                        header("Location: adminpage.php");
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
            header("Location: adminpage.php");
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




    <div id="admin-container">
        <div id="admin-title">
            <h1>Welcome to Admin Page </h1>
        </div>
        <div id="initialize-db">
            <form action="adminpage.php" method="POST">
                <div id="wrapper">Intialize Menu
                    <input type="hidden" name="form_type" value="create_menu" id="create_menu">
                    <div><button type="submit" id="submit-button-create-menu">Click me</button></div>
                </div>
            </form>
        </div>

        <div id="admin-table-container">
            <div class="food-admin-table">
                <table>
                    <h2>View Orders</h2>
                    <thead>
                        <tr>
                            <th><label>Food Name</label></th>
                            <th><label>Cuisine</label></th>
                            <th><label>Food Description</label></th>
                            <th><label>Price</label></th>
                            <th><label>Category Course</label></th>
                            <th><label>Category Food</label></th>
                            <th><label>Image</label></th>
                        </tr>

                        <tr>
                            <?php
                            $categories_course = [];
                            $categories_food = [];
                            foreach ($result as $row) {
                                $categories_course[] = $row['category_course'];
                            }
                            foreach ($result as $row) {
                                $categories_food[] = $row['category_food'];
                            }
                            $categories_course = array_unique($categories_course);
                            $categories_food = array_unique($categories_food);

                            foreach ($result as $row) {

                                echo '<tr class = admin-food-menu>';
                                // Displaying Food Name as simple text
                                echo "<div class ='input-group'>";
                                echo '<td class=admin-food-name>' . $row['foodname'] . '</td>';
                                echo '</div>';
                                // Displaying Cuisine as simple text
                                echo "<div class ='input-group'>";
                                echo '<td>' . $row['cuisine'] . '</td>';
                                echo '</div>';

                                echo "<form method='POST' enctype='multipart/form-data' id='form-" . $row['foodname'] . "'>";

                                echo "<input type=hidden name=form_type value=update_food id=>";
                                echo "<input type=hidden name=foodname value='" . $row['foodname'] . "' id='foodname'>";
                                // Input field for Food Description
                                echo '<td>';
                                echo "<div class ='input-group'>";
                                echo "<textarea name='foodDescription[" . $row['foodname'] . "]'>" . $row['food_description'] . "</textarea>";
                                echo '</div>';
                                echo '</td>';

                                // Input field for Price
                                echo '<td>';
                                echo "<div class ='input-group'>";
                                echo "<input type='number' step='0.01' name='price[" . $row['foodname'] . "]' value='" . $row['price'] . "' id='price'>";
                                echo '</div>';
                                echo '</td>';


                                // Input field for Category Course
                                echo '<td>';
                                echo "<div class ='input-group'>";

                                echo '<select name="category_course[' . $row['foodname'] . ']" id="category_course">';
                                foreach ($categories_course  as $category) {
                                    $selected = ($row['category_course'] == $category) ? "selected" : "";
                                    echo '<option value="' . $category . '" ' . $selected . '>' . $category . '</option>';
                                }
                                echo '</select>';
                                echo '</div>';
                                echo '</td>';

                                // Input field for Category Food

                                echo '<td>';
                                echo "<div class ='input-group'>";
                                echo '<select name="category_course[' . $row['foodname'] . ']" id="category_course">';
                                foreach ($categories_food  as $category) {
                                    $selected = ($row['category_food'] == $category) ? "selected" : "";
                                    echo '<option value="' . $category . '" ' . $selected . '>' . $category . '</option>';
                                }
                                echo '</select>';
                                echo '</div>';
                                echo '</td>';

                                // Display current Image and provide input for new Image
                                echo '<td>';
                                echo "<div class ='input-group'>";
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" width="100"/>';
                                echo "<label for='fileUpload' class='custom-file-upload'>Choose Image</label>";
                                echo "<input  type='file' name='foodImage[" . $row['foodname'] . "]'>";
                                echo '</div>';
                                echo '</td>';
                                echo '</form>';
                                // Update button
                                echo '<td>';
                                echo "<input type='submit'" . $row['foodname'] . "'>";
                                echo '</td>';

                                echo '</tr>';
                            }

                            ?>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        <div id="create-new-food-admin-container">
            <form action="" method="post" enctype="multipart/form-data" id="wrapper">

                <div id="wrapper">
                    <h2>Add Food </h2>
                </div>
                <input type="hidden" name="form_type" value="create_new_food" id="create_new_food_hidden">
                <label for="Foodname">Food name</label>
                <input type="text" name="foodName" id="foodName">

                <label for="Cuisine">Cuisine</label>
                <input type="text" name="cuisine" id="cuisine">

                <label for="Food Description">Food Description</label>
                <input type="text" name="foodDescription" id="foodDescription">

                <label for="Price">Price</label>
                <input type="number" name="price" id="price">

                <?php
                // Ensure $uniqueCategories and $selectedCategory are defined above this point.

                echo "<label for='categoryCourse'>Category Course</label>";
                echo "<select name='categoryCourse' id='categoryCourse'>";

                foreach ($uniqueCategories as $category) {
                    $selectedAttribute = ($category == $selectedCategory) ? ' selected' : '';
                    echo "<option value='" . htmlspecialchars($category, ENT_QUOTES) . "'" . $selectedAttribute . ">" . htmlspecialchars($category) . "</option>";
                }

                echo "</select>";
                ?>

                <div class="category-cuisine-container">

                    <?php
                    // Ensure $uniqueCuisines and $selectedCuisines are defined above this point.

                    echo "<label for='categoryCuisine'>Category Cuisine</label>";
                    echo "<select name='categoryCuisine' id='categoryCuisine'>";

                    foreach ($uniqueCuisines as $cuisine) {
                        $selectedAttribute = ($cuisine == $selectedCuisines) ? ' selected' : '';
                        echo "<option value='" . htmlspecialchars($cuisine, ENT_QUOTES) . "'" . $selectedAttribute . ">" . htmlspecialchars($cuisine) . "</option>";
                    }

                    echo "</select>";
                    ?>
                </div>


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
        </div>
    </footer>
</body>


<script src="../asset/js/script.js"></script>


</html>