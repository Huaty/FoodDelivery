<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstname = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $homeaddress = $_POST["address"];


    try {
        require_once "../asset/includePHP/dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_view.inc.php";
        require_once "signup_contr.inc.php";

        //Error handlers
        $errors = [];

        if (is_input_empty($firstname, $email, $pwd, $homeaddress)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email";
        }
        if (is_email_taken($pdo, $email)) {
            $errors["email_taken"] = "Email already taken";
        }

        require_once "../asset/includePHP/config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            $signupData = [
                "firstname" => $firstname,
                "email" => $email,
                "homeaddress" => $homeaddress
            ];

            $_SESSION["signup_data"] = $signupData;
            header("Location: ../html/signup.php");
            die();
        }

        create_user($pdo, $firstname, $email, $pwd, $homeaddress);

        header("Location: ../html/signup.php?signup=success");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOEXCEPTION $e) {
        die("Query Failed" . $e->getMessage());
    }
} else {
    header("Location: ../html/login.php");
    die();
}
