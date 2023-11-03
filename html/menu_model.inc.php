<?php


declare(strict_types=1);

function create_menu(object $pdo) ///// set config file to max_allowed_packet = 64M
{
    // $food_data = [foodname,cuisine,food_description,price,image_data]
    $food_data = [
        [
            'foodname' => 'Healthy Salad Bowl',
            'cuisine' => 'Mediterranean',
            'category_course' => 'Appetizer',
            'category_food' => 'Vegetarian',
            'food_description' => 'A refreshing mix of lettuce, boiled eggs, edamame beans, cherry tomatoes, grilled tofu, corn, cucumber, and purple cabbage, drizzled with a light vinaigrette.',
            'price' => '12.99',
            'image_data' => file_get_contents("../asset/menu_image/food1.jpg")
        ],
        [
            'foodname' => 'French Toast Delight',
            'cuisine' => 'French',
            'category_course' => 'Main Course',
            'category_food' => 'Vegetarian',
            'food_description' => 'Golden brown slices of bread soaked in a rich custard mix, topped with fresh bananas, blueberries and a drizzle of maple syrup. Served with a dusting of powdered sugar.',
            'price' => '9.99',
            'image_data' => file_get_contents("../asset/menu_image/food5.jpg")
        ],
        [
            'foodname' => 'Ultimate Breakfast Burger',
            'cuisine' => 'American',
            'category_course' => 'Main Course',
            'category_food' => 'Meat',
            'food_description' => 'A juicy beef patty topped with melted cheese, crispy bacon, and a perfectly fried egg. Nestled between a soft bun and served with a side of fresh greens.',
            'price' => '14.99',
            'image_data' => file_get_contents("../asset/menu_image/food7.jpg")
        ],
        [
            'foodname' => 'Crispy Chicken Burger',
            'cuisine' => 'American',
            'category_course' => 'Main Course',
            'category_food' => 'Meat',
            'food_description' => 'A crunchy chicken patty topped with tangy slaw and pickled onions, served in a toasted sesame bun.',
            'price' => '13.99',
            'image_data' => file_get_contents("../asset/menu_image/food6.jpg")
        ], [
            'foodname' => 'Rustic Egg Toast',
            'cuisine' => 'European',
            'category_course' => 'Appetizer',
            'category_food' => 'Vegetarian',
            'food_description' => 'Sliced whole grain toast with creamy avocado spread, topped with fresh spinach and soft-boiled eggs, garnished with herbs. Accompanied by cookies and a vintage lantern setting.',
            'price' => '11.99',
            'image_data' => file_get_contents("../asset/menu_image/food4.jpg")
        ], [
            'foodname' => 'Honey Drizzled Pancakes',
            'cuisine' => 'American',
            'category_course' => 'Dessert',
            'category_food' => 'Vegetarian',
            'food_description' => 'Stacked golden pancakes adorned with banana slices, topped with fresh mint leaves. Beautifully garnished and a hand pouring honey over them. Presented on a wooden plate with an antique-looking metal teapot on the side.',
            'price' => '20.00',
            'image_data' => file_get_contents("../asset/menu_image/food2.jpg")
        ],
        [
            'foodname' => 'Raspberry Layered Cake',
            'cuisine' => 'European',
            'category_course' => 'Dessert',
            'category_food' => 'Vegetarian',
            'food_description' => 'A slice of creamy mousse or cheesecake with layers interspersed with vibrant red raspberries. Topped with fresh raspberries and delicate mint leaves, presented on a modern black plate.',
            'price' => '10.99',
            'image_data' => file_get_contents("../asset/menu_image/food3.jpg")
        ]

    ];

    try {
        foreach ($food_data as $food_item) {
            $foodname = $food_item['foodname'];
            $food_description = $food_item['food_description'];
            $category_course = $food_item['category_course'];
            $category_food = $food_item['category_food'];
            $cuisine = $food_item['cuisine'];
            $price = $food_item['price'];
            $image_data = $food_item['image_data'];

            // Instead of $_FILES, you should use $image_data directly
            $query = "INSERT INTO menus (foodname, cuisine,category_course,category_food, food_description, price, image_data) VALUES (:foodname, :cuisine,:category_course,:category_food, :food_description, :price, :image_data)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":foodname", $foodname, PDO::PARAM_STR);
            $stmt->bindParam(":cuisine", $cuisine, PDO::PARAM_STR); // Adding the cuisine binding
            $stmt->bindParam(":category_course", $category_course, PDO::PARAM_STR);
            $stmt->bindParam(":category_food", $category_food, PDO::PARAM_STR);
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
