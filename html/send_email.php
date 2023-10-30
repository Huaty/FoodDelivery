<?php
require_once "../asset/includePHP/config_session.inc.php";
require_once "../asset/includePHP/dbh.inc.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_SESSION['orders']);
$orders = $_SESSION['orders'];

$userName = $_SESSION["user_firstname"];

$query = "SELECT homeaddress FROM users WHERE firstname=:email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $userName);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);
// Your email details
$to = 'f32ee@localhost'; // Change this to your desired recipient email address
$subject = 'Payment Confirmation';
$message = 'Thank you for your payment!'; // You can customize this message

// Headers
$headers = 'From: your-email@example.com' . "\r\n" .
    'Reply-To: your-email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Send email
$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    foreach ($result as $result) {
        echo $result;
    }
    echo "<br>";
    echo "Email sent successfully.";
} else {
    echo "Email sending failed.";
}
