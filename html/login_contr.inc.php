<?php

declare(strict_types=1);


function is_input_empty(string  $email, string  $pwd,) ///check input where is empty
{

    if (empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}



function is_email_wrong(bool|array $result) //// if $result return as empty which is falsy
{
    if (!$result) { // !$result will be true if $result is empty
        return true;
    } else {
        return false;
    }
}



function is_pwd_wrong(string $pwd, string $hashedpwd)
{

    if (password_verify($pwd, $hashedpwd)) {
        return true;
    } else {

        return false;
    }
}
