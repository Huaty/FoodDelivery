<?php


$dsn = "mysql:host=localhost;dbname=MajulahMunchies"; /// DSN=Data Source Name
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    // Perform database operations here
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database Connection Successful";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Database Connection Failed: " . $e->getMessage();
}
