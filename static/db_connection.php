<?php


function Opencon(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MajulahMunchies";
    $conn = mysqli_connect($servername, $username,$password, $dbname) or die("Connection Failed:".mysqli_connect_error());
    return $conn;
}

function Closecon($conn){
    $conn -> close();
}

?>