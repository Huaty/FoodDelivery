<?php
require_once "error.php";
require_once "db.inc.php";
session_start();
echo " Movie Id:";
echo $_SESSION["movie_id"];
$movie_id = $_SESSION["movie_id"];


try {
    $querySeats = "select * from seats where MovieID = ?";
    $stmt = $myconnect->prepare($querySeats);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $resultSeats = $stmt->get_result();
    echo "working";
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seats = array();
    foreach ($_POST as $key => $seat) {
        echo "Key: " . $key . "";
        $seats[] = $key;
    }
    $_SESSION["seats"] = $seats;
    header("Location: payment.php");
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

    <div id="main-content">
        <div id="movie-screen">
            <div id="screen">Screen</div>
            <div id="movie">
                <form method="POST" action="" id="selectedCheckBoxForm">
                    <div id="movieseats">
                        <?php
                        foreach ($resultSeats as $seat) {
                            if ($seat["IsBooked"] == 0) {  // If the seat is not booked
                                echo "<input type='checkbox' id=" . $seat["SeatNumber"] . " class='seat' name=" . $seat["SeatNumber"] . ">";
                                echo "<label for=" . $seat["SeatNumber"] . " class='seat-label seat'>" . $seat["SeatNumber"] . " </label>";
                            } else {  // If the seat is booked
                                // You can customize this section for booked seats, like adding a class that visually indicates it's booked
                                echo "<input type='checkbox' id=" . $seat["SeatNumber"] . " class='seat booked' name=" . $seat["SeatNumber"] . " disabled>";
                                echo "<label for=" . $seat["SeatNumber"] . " class='seat-label booked-label'>" . $seat["SeatNumber"] . " </label>";
                            }
                        } ?>
                    </div>

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