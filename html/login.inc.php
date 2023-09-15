<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {
    require_once "../asset/includePHP/dbh.inc.php";
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    try {
        $query = "SELECT * FROM users WHERE email=:email AND pwd=:pwd";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->execute();
    } catch (PDOEXCEPTION $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../html/login.php");
    exit();
}
