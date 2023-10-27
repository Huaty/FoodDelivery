<?php

declare(strict_types=1);

function create_menu(object $pdo) ///// set config file to max_allowed_packet = 64M
{
    // $food_data = [foodname,cuisine,food_description,price,image_data]
    $food_data = [
        [
            'foodname' => 'Healthy Salad Bowl',
            'cuisine' => 'Mediterranean',
            'food_description' => 'A refreshing mix of lettuce, boiled eggs, edamame beans, cherry tomatoes, grilled tofu, corn, cucumber, and purple cabbage, drizzled with a light vinaigrette.',
            'price' => '12.99',
            'image_data' => file_get_contents("../asset/menu_image/food1.jpg")
        ],
        [
            'foodname' => 'French Toast Delight',
            'cuisine' => 'French',
            'food_description' => 'Golden brown slices of bread soaked in a rich custard mix, topped with fresh bananas, blueberries and a drizzle of maple syrup. Served with a dusting of powdered sugar.',
            'price' => '9.99',
            'image_data' => file_get_contents("../asset/menu_image/food5.jpg")
        ],
        [
            'foodname' => 'Ultimate Breakfast Burger',
            'cuisine' => 'American',
            'food_description' => 'A juicy beef patty topped with melted cheese, crispy bacon, and a perfectly fried egg. Nestled between a soft bun and served with a side of fresh greens.',
            'price' => '14.99',
            'image_data' => file_get_contents("../asset/menu_image/food7.jpg")
        ]
    ];

    try {
        foreach ($food_data as $food_item) {
            $foodname = $food_item['foodname'];
            $food_description = $food_item['food_description'];
            $cuisine = $food_item['cuisine'];
            $price = $food_item['price'];
            $image_data = $food_item['image_data'];

            // Instead of $_FILES, you should use $image_data directly
            $query = "INSERT INTO menus (foodname, cuisine, food_description, price, image_data) VALUES (:foodname, :cuisine, :food_description, :price, :image_data)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":foodname", $foodname, PDO::PARAM_STR);
            $stmt->bindParam(":cuisine", $cuisine, PDO::PARAM_STR); // Adding the cuisine binding
            $stmt->bindParam(":food_description", $food_description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":image_data", $image_data, PDO::PARAM_LOB);


            if ($stmt->execute()) {
                echo "Success";
                $_SESSION['create_menu'] = false;
            } else {
                echo "Error inserting data.";
            }
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

function get_menu(object $pdo)
{
    try {
        // Query to retrieve menu items
        $query = "SELECT item_id,foodname,food_description,price,image_data FROM menus";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Fetch menu items as an associative array

        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $menuItems;
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
