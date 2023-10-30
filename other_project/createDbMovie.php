<?php
require_once "db.inc.php";
require_once "error.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

function create_movie(object $myconnect)
{

    // Rename the array to $movie_data for clarity
    $movie_data = [
        [
            'foodname' => 'Lost Horizon',
            'cuisine' => 'Scary',
            'food_description' => 'A vast desert landscape...',
            'price' => '12.99',
            'image_data' => file_get_contents("movie1.png")
        ],
        [
            'foodname' => 'Echoes of the Past',
            'cuisine' => 'Love',
            'food_description' => 'A bustling modern city street...',
            'price' => '9.99',
            'image_data' => file_get_contents("batman.png")
        ],
    ];

    try {
        $stmt = $myconnect->prepare("INSERT INTO MOVIE (MovieName, MovieGenre, MovieDescription, MovieImage) VALUES (?, ?, ?, ?)");

        foreach ($movie_data as $movie_item) {
            // Bind parameters
            $stmt->bind_param("ssss", $movie_item['foodname'], $movie_item['cuisine'], $movie_item['food_description'], $movie_item['image_data']);

            // Execute the prepared statement
            $stmt->execute();
            $movieId = $myconnect->insert_id;
            createSeats($myconnect, $movieId); ///create seat for each movie
        }

        // Close the prepared statement
        $stmt->close();
        echo "Movies inserted successfully!";
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

function InsertMovie(object $myconnect, string $movieTitle, string $movieGenre, string $movieDescription, string $movieImage)
{
    try {
        $stmt = $myconnect->prepare("INSERT INTO MOVIE (MovieName, MovieGenre, MovieDescription, MovieImage) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $movieTitle, $movieGenre, $movieDescription, $movieImage);
        $stmt->execute();
        $movieId = $myconnect->insert_id;
        createSeats($myconnect, $movieId); ///create seat for each movie
        $stmt->close();
        echo "Movies inserted successfully!";
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

function createSeats(object $myconnect, $movieId)
{

    require_once "db.inc.php";
    $rows = ['A', 'B', 'C', 'D', 'E', 'F']; // Example row values
    $isBooked = 0;
    $stmt = $myconnect->prepare("INSERT INTO SEATS (MovieID, SeatNumber,IsBooked) VALUES (?, ?,?)");
    foreach ($rows as $row) {
        for ($j = 1; $j <= 10; $j++) {
            $seat = $row . $j;
            try {
                $stmt->bind_param("isi", $movieId, $seat, $isBooked);
                $stmt->execute();
            } catch (PDOException $e) {
                die("Query Failed: " . $e->getMessage());
            }
        }
    }
    $stmt->close();
}
