<?php
require_once "menu_view.inc.php";
require_once "../asset/includePHP/config_session.inc.php";


// if (!isset($_SESSION["user_id"])) {
//     // Redirect the user to the login page or display an error message.
//     header("Location: login.php");
//     exit();
// }

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
    <?php

    $menuItems = menu_display();
    // $js_array = array(); ////JSON FORMAT
    // foreach ($menuItems as $menuItem) {
    //     $id_price = array(
    //         'id' => $menuItem['item_id'],
    //         'price' => $menuItem['price']
    //     );
    //     $js_array[] = $id_price;
    // }
    // $json = json_encode($js_array);
    // echo "<script>var data=$json;</script>";

    ?>

</body>


<script src="../asset/js/script.js"></script>


</html>