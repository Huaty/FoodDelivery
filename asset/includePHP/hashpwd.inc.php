<?php

$pwdSignup = "password";

function pwdSignup($pwdSignup)
{
    $hashedPwd = password_hash($pwdSignup, PASSWORD_DEFAULT);
    return $hashedPwd;
}


function pwdLogin($pwdLogin, $hashedPwd)
{
    $pwdLogin = "password";
    if (password_verify($pwdLogin, $hashedPwd)) {
        echo "Password is correct";
    } else {
    }
}
