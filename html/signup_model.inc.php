<?php

declare(strict_types=1);


function get_email(object $pdo, string $email)
{

    $query = "SELECT email FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $firstname, string $email, string  $pwd, string  $address)
{
    require_once "../asset/includePHP/hashpwd.inc.php";
    $query = "INSERT INTO users (firstname,email,pwd,homeaddress) VALUES (:firstname,:email,:pwd,:homeaddress)";


    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", pwdSignup($pwd));
    $stmt->bindParam(":homeaddress", $address);
    $stmt->execute();

    $query = null;
    $stmt = null;
}
