<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    try {


        require_once "../asset/includePHP/dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_view.inc.php";
        require_once "login_contr.inc.php";

        $errors = [];

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        $result = get_user($pdo, $email); //// an empty array will return as falsy 
        if (is_email_wrong($result)) {
            $errors["User_not_found"] = "User not found";
            // echo"User not found";
        }



        if (!is_email_wrong($result) && is_pwd_wrong($pwd, $result["pwd"])) /// (if the user is exist insde && password is wrong) return this
        {
            $errors["wrong_pwd"] = "Wrong password";
        }

        require_once "../asset/includePHP/config_session.inc.php";

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../html/login.php");
            die();
        }

        // Creating Session with user id
        $newSessionId = session_create_id(); /// create new session id
        session_id($sessionId); /// set new session id
        require_once "../asset/includePHP/config_session.inc.php";
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_firstname"] = htmlspecialchars($result["firstname"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: ../html/menu.php");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOEXCEPTION $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../html/login.php");
    exit();
}
