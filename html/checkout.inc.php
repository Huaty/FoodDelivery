<?php
// PHP Script to Process the Submitted Order Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodNames = isset($_POST['foodName']) ? $_POST['foodName'] : [];
    $qtys = isset($_POST['qty']) ? $_POST['qty'] : [];

    for ($i = 0; $i < count($foodNames); $i++) {
        $foodName = $foodNames[$i];
        $qty = $qtys[$i];
        // Process each ordered item here
    }
}
