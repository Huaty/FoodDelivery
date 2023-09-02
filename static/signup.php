<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" ){

        $conn = mysqli_connect("localhost", "root", "", "MajulahMunchies") or die("Connection Failed:".mysqli_connect_error());


        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO `users` (`firstname`,`lastname`,`email`, `password`) VALUES ('$firstname', '$lastname', '$email', '$password')";

        $query = mysqli_query($conn, $sql);
        if($query)
        {
            echo "Data inserted successfully";
        }
        else
        {
            echo "Data insertion failed";
        }
        

    }


?>