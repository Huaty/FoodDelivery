<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["submit"])) {
    require_once "../asset/includePHP/dbh.inc.php";
    $changeAddress = $_POST["changeAddress"];

    if (isset($_POST["changeAddress"])) {
        try {
            $query = "UPDATE users SET homeaddress =:changeAddress where user_id=19";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":changeAddress", $changeAddress);
            $stmt->execute();

            $stmt = null;
            $pdo = null;

            header("Location: ../html/login.php");
            exit();
        } catch (PDOException $e) {
            die("Query Failed: " . $e->getMessage());
        }
    }
} else {
    header("Location: ../html/changeAddress.php");
}
