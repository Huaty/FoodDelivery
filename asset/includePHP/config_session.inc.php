<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);


session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true,
]);

session_start();

//// the main reason for this snippet is to regenerate the session ID every 30 minutes. To prevent session fixation attacks.

if (!isset($_SESSION['last_regeneration'])) { //// this if statement to check whether the session have ID
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} else {
    $interval = 60 * 30;  // Set an interval of 30 minutes (in seconds)
    if (time() - $_SESSION['last_regeneration'] >= $interval) { /// this if current time stamp - last_regeneration time stamp is more than 30 minutes, then regenerate the session ID again
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
