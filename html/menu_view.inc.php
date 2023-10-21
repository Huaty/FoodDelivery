<?php


function menu_display()
{
    require_once "menu_model.inc.php";
    require  "../asset/includePHP/dbh.inc.php";
    $menuItems = get_menu($pdo);

    // Render the menu items on the HTML page
    foreach ($menuItems  as $menuItem) {
        echo "<div class='menu-item'>";
        echo "<h3>{$menuItem['foodname']}</h3>";
        echo "<p>{$menuItem['food_description']}</p>";
        echo "<p>Price: {$menuItem['price']}</p>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($menuItem['image_data']) . "' alt='{$menuItem['foodname']}' />";
        echo "<button class='decrease-qty'>-</button>";
        echo "<span class='current-qty'>0</span>";
        echo "<button class='increase-qty'>+</button>";
        echo "<button class='add-to-cart'>Add to Cart</button>";
        echo "</div>";
    }
    return $menuItems;
}
