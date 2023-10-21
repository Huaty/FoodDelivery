<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedSeats = array_keys($_POST);  // Get the keys of the $_POST array, which are the names of the checked checkboxes
    echo "Selected seats: " . implode(", ", $selectedSeats);  // Print the selected seats as a comma-separated string
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>


<body>
    <div id="nav-bar">
        Nav
    </div>

    <div id="main-content">
        <div id="movie-screen">
            <div id="screen">Screen</div>
            <div id="movie">
                <form method="POST" action="" id="selectedCheckBoxForm">
                    <div id="movieseats"></div>
                </form>
            </div>
        </div>
        <div id="checkout-container">
            Checkout
            <div id="print-seats">

                <div id="checkout-seats"></div>
            </div>
            <button type="submit" id="checkout-button">Checkout</button>
        </div>
        <!-- <button type="submit" id="checkout-button">Checkout</button> -->
    </div>
</body>
<script src="script.js"></script>

</html>