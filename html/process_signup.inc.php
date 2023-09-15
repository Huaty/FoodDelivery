<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {

    $firstname = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $homeaddress = $_POST["address"];


    try {

        require_once "../asset/includePHP/dbh.inc.php";
        require_once "../asset/includePHP/hashpwd.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_view.inc.php";
        require_once "signup_contr.inc.php";

        if (is_input_empty($firstname, $pwd, $email, $homeaddress)) {
            header("Location: ../html/signup.php");
            exit();
        } else {
            $query = "INSERT INTO users (firstname,email,pwd,homeaddress) VALUES (:firstname,:email,:pwd,:homeaddress)"; ////? is  placeholer
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", pwdSignup($pwd));
            $stmt->bindParam(":homeaddress", $homeaddress);
            $stmt->execute();

            $pdo = null;
            $stmt = null;
            header("Location: ../html/login.php");
            exit();
        }
    } catch (PDOEXCEPTION $e) {
        die("Query Failed" . $e->getMessage());
    }
} else {
    header("Location: ../html/signup.php");
    exit();
}
