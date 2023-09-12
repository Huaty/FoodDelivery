<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {

    include('../asset/db_connection.php');
    $conn = Opencon();

    $firstname = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $homeaddress = $_POST["address"];

    if (
        isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["address"])
        && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["address"])
    ) {
        $sql = "INSERT INTO `users` (`firstname`,`email`, `pwd`,`homeaddress`) VALUES ('$firstname', '$email', '$password','$homeaddress')";

        $query = mysqli_query($conn, $sql); /// First name , Last name , email , password cannot be null in the database
        if ($query) {
            header("Location: ../html/login.php"); // Redirect browser to signup page using PHP.
            exit();
        } else {
            echo "Data insertion failed";
        }
    } else {
        header("Location: ../html/signup.php"); // Redirect browser to signup page using PHP. If they leave blank
        exit();
    }
} else {
    header("Location: ../html/signup.php");
    exit();
}
