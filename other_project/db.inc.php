<?php

$servername = "localhost"; // Replace with your database server name
$username = "root";    // Replace with your database username
$password = "";    // Replace with your database password
$database = "MOVIE";  // Replace with your database name

// Create a connection to the MySQL database
$myconnect = new mysqli($servername, $username, $password, $database);
if ($myconnect->connect_error) {
    die("Connection failed: " . $myconnect->connect_error);
}
