<?php

declare(strict_types=1);
function menu_display()
{

    try {
        require_once "../asset/includePHP/dbh.inc.php";


        // Query to retrieve menu items
        $query = "SELECT foodname,food_description,price,image_data FROM menus";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Fetch menu items as an associative array

        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Render the menu items on the HTML page
        foreach ($menuItems as $menuItem) {
            echo "<div class='menu-item'>";
            echo "<h3>{$menuItem['foodname']}</h3>";
            echo "<p>{$menuItem['food_description']}</p>";
            echo "<p>Price: {$menuItem['price']}</p>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($menuItem['image_data']) . "' alt='{$menuItem['foodname']}' />";
            echo "</div>";
        }
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
