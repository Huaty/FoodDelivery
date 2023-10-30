<?php
require_once "error.php";
require_once "db.inc.php";
session_start();
echo " Seats:";
var_dump($_SESSION);
$seats = $_SESSION["seats"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateSeats = "update seats set IsBooked = 1 where MovieID = ? and SeatNumber = ?";
    $stmt = $myconnect->prepare($updateSeats);
    if (!$stmt) {
        die("Query preparation failed: " . $myconnect->error);
    }
    foreach ($seats as $seat) {
        if (!$stmt->bind_param("is", $_SESSION["movie_id"], $seat)) {
            die("Binding parameters failed: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Query execution failed: " . $stmt->error);
        }
    }
    $stmt->close();
    header("Location: index.php");
    exit();
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
        <div><a href="admin.php">Admin Page</a></div>
    </div>
    <div>
        <form method="POST" action="">
            <?php
            echo "chosen seats:";
            foreach ($seats as $seat) {
                echo "<div>" . $seat . "</div>";
            }
            echo "<input type='submit' value='Checkout' id='checkout-button'>";
            ?>
        </form>

    </div>
    <!-- <button type="submit" id="checkout-button">Checkout</button> -->
    </div>
</body>
<script src="script.js"></script>

</html>