<?php
require_once "db.inc.php";
require_once "createDbMovie.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formType = $_POST["form_type"];
    switch ($formType) {
        case "create_movie":
            create_movie($myconnect);
            echo "test";
            break;
        case "create_new_movie":
            if (isset($_FILES["movieImage"])) {
                if ($_FILES["movieImage"]["error"] == 0) {
                    $movieImage = file_get_contents($_FILES["movieImage"]["tmp_name"]);
                    InsertMovie($myconnect, $_POST["movieTitle"], $_POST["movieGenre"], $_POST["movieDescription"], $movieImage);
                } else {
                    echo "File upload error: " . $_FILES["movieImage"]["error"];
                }
            }
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="initialize-form" method="POST">
        <h1 id="wrapper">Intialize Movie </h1>
        <input type="hidden" name="form_type" value="create_movie" id="create_movie">
    </form>
    <div><button type="submit" id="submit-button-create-movie">Click me</button></div>
    <div><br></div>
    <h1>Upload New Movie</h1>
    <form id="upload-new-movie-form" method="POST" enctype="multipart/form-data">
        <div id="wrapper">
            <input type="hidden" name="form_type" value="create_new_movie" id="create_new_movie_hidden">
            <label for="movieTitle">Movie Title</label>
            <input type="text" name="movieTitle" id="movieTitle">

            <label for="movieGenre">Movie Genre</label>
            <input type="text" name="movieGenre" id="movieGenre">

            <label for="movieDescription">Movie Description</label>
            <input type="text" name="movieDescription" id="movieDescription">

            <label for="movieImage">Movie Image</label>
            <input type="file" name="movieImage" id="movieImage">

            <input type="submit" value="Upload Movie" id="submit-button-create-new-movie">
        </div>
    </form>

</body>
<script src="script.js"></script>

</html>