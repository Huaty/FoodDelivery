<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {

    require_once "../asset/includePHP/dbh.inc.php";
    $firstname = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $homeaddress = $_POST["address"];

    if (
        isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["address"])
        && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["address"])
    ) {
        try {
            $query = "INSERT INTO users (firstname,email,pwd,homeaddress) VALUES (:firstname,:email,:pwd,:homeaddress)"; ////? is  placeholer
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", $pwd);
            $stmt->bindParam(":homeaddress", $homeaddress);
            $stmt->execute();

            $pdo = null;
            $stmt = null;
            header("Location: ../html/login.php");
            exit();
        } catch (PDOEXCEPTION $e) {
            die("Query Failed" . $e->getMessage());
        }
    } else {
        header("Location: ../html/signup.php"); // Redirect browser to signup page using PHP. If they leave blank
        exit();
    }
} else {
    header("Location: ../html/signup.php");
    exit();
}
