<?php

$pwdSignup = "password";

function pwdSignup($pwdSignup)
{
    $options = [
        'cost' => 12, //  cost is set to 12, which means that the hashing algorithm will perform 2^12 (4,096) iterations. The higher the cost, the more secure the password hash is against brute-force attacks, but it also requires more computational resources.
    ];

    $hashedPwd = password_hash($pwdSignup, PASSWORD_DEFAULT, $options);
    return $hashedPwd;
}


function pwdLogin($pwdLogin, $hashedPwd)
{

    if (password_verify($pwdLogin, $hashedPwd)) {
        return true;
    } else {
    }
}
