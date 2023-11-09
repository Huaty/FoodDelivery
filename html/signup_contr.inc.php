<?php

declare(strict_types=1);

function is_input_empty(string $username, string  $email, string  $pwd, string  $address) ///check input where is empty
{

    if (empty($username) || empty($pwd) || empty($email) || empty($address)) {
        return true;
    } else {
        return false;
    }
}


function is_email_invalid(string $email) /// check if email is valid
{

    if (!$email) {
        return true;
    } else {
        return false;
    }
}


function is_email_taken(object $pdo, string $email) /// check if email is valid
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $firstname, string $email, string  $pwd, string  $address)
{
    set_user($pdo, $firstname, $email,  $pwd, $address);
}
