<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" ){

        include ('db_connection.php');
        $conn = Opencon();

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $homeaddress = $_POST["homeaddress"];

        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["homeaddress"])
        && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["homeaddress"]))
        {
            $sql = "INSERT INTO `users` (`firstname`,`lastname`,`email`, `pwd`,`homeaddress`) VALUES ('$firstname', '$lastname', '$email', '$password','$homeaddress')";

            $query = mysqli_query($conn, $sql); /// First name , Last name , email , password cannot be null in the database
            if($query)
            {
                echo "Data inserted successfully";
            }
            else
            {
                echo "Data insertion failed";
            }
        }
        else
        {
            echo '<p style="color: red;">All fields are required.</p>';
            header("Location: ../static/signup.html"); // Redirect browser to signup page using PHP.
            exit();
        }
  
    }


?>