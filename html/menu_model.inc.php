<?php

declare(strict_types=1);

function create_menu() ///// set config file to max_allowed_packet = 64M
{
    $food_data = [
        ['Pizza', 'Italian', 12.99, file_get_contents("../asset/menu_image/chickensalad.jpg")]
    ];

    try {
        require_once "../asset/includePHP/dbh.inc.php"; // Assuming this file contains your PDO connection

        foreach ($food_data as $food_item) {
            $foodname = $food_item[0];
            $food_description = $food_item[1];
            $price = $food_item[2];
            $image_data = $food_item[3];

            // Instead of $_FILES, you should use $image_data directly
            $query = "INSERT INTO menus (foodname, food_description, price, image_data) VALUES (:foodname, :food_description, :price, :image_data)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":foodname", $foodname, PDO::PARAM_STR);
            $stmt->bindParam(":food_description", $food_description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            // You can bind the image data as a parameter using PDO::PARAM_LOB
            $stmt->bindParam(":image_data", $image_data, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                echo "Success";
            } else {
                echo "Error inserting data.";
            }
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

create_menu();
