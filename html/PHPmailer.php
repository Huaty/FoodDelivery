<?php
// Include PHPMailer autoloader

function sendEmail(){
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';
require 'path/to/PHPMailer/src/Exception.php';

// require 'vendor/autoload.php'; // Update this with the path to your autoloader

// Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

//  // Creating the confirmation message
//     $confirmationMessage = "Dear $name,

//     Thank you for your order. Your order with Order ID: $orderID has been confirmed.

//     We will process your order shortly. You will receive a notification once your order is shipped.

//     If you have any questions or need further assistance, feel free to contact us at Mahjulahmunchies@gmail.com.

//     Thank you for choosing our services.

//     Best regards,
//     MahjulahMunches

//     // $confirmationMessage now contains the confirmation message with the order ID and user's name

// Create a new PHPMailer instance
$mail = new PHPMailer(true); // Passing `true` enables exceptions

if(isset($_POST['send'])) //button press
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);
    $orderID = "oRDERID?"; // Replace this with your actual order ID from your system


    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'your.smtp.server'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'bingweiwebdesign4717@gmail.com'; // SMTP username
    $mail->Password = 'htlr oqve gnct yoxg'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to

    // Recipients
    $mail->setFrom('from@example.com', 'Your Name');
    $mail->addAddress('recipient@example.net', 'Recipient Name'); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->setFrom('$email', '$name');
    $mail->addAddress('bingweiwebdesign4717@gmail.com');
    $mail->Subject = 'Order Confirmation';
    $mail->Body = $confirmationMessage;

    try {
        $mail->send();
        echo "Confirmation email has been sent";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    

}

?>
