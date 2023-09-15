<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {
    require_once "../asset/includePHP/dbh.inc.php";
    $changeName = $_POST["changeName"];
    echo $changeName;


    if (isset($_POST["changeName"])) {
        try {
            $query = "UPDATE users SET firstname=:changeName where user_id=19";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":changeName", $changeName);
            $stmt->execute();

            $stmt = null;
            $pdo = null;
            header("Location: ../html/login.php");
            exit();
        } catch (PDOEXCEPTION $e) {
            die("Query Failed:" . $e->getMessage());
        }
    } else {
        header("Location: ../html/signup.php");
    }
} else {
    header("Location: ../html/changeName.php");
}
