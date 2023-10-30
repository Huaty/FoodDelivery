<?php
session_start();

require_once "db.inc.php";
$queryMovie = "select * from movie";
$stmt = $myconnect->prepare($queryMovie);
$stmt->execute();
$resultMovie = $stmt->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $movie_id = $_POST["movie_id"];
    $_SESSION["movie_id"] = $movie_id;
    echo $movie_id;
    header("Location: seats.php");
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
    <div id="movie-container">
        <?php foreach ($resultMovie as $movie) {
            echo "<form method='POST' action=''>";
            echo "<div id='movie-wrapper'>";
            echo "<input type='hidden' name='movie_id' value='" . $movie['MovieID'] . "'/>";
            echo "<img class='movie-image' src='data:image/jpeg;base64," . base64_encode($movie['MovieImage']) . "' />";
            echo "<div> Movie Title" . $movie['MovieName'] . " </div>";
            echo "<div>Movie Genre " . $movie['MovieGenre'] . " </div>";
            echo "<div>Description " . $movie['MovieDescription'] . " </div>";
            echo "<input type='submit' value='Click Me'/>";
            echo "</div>";
            echo "</form>";
        } ?>

    </div>
</body>
<script src="script.js"></script>

</html>