<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

function getMailer() {
    $mail = new PHPMailer(true); // Enable exceptions
    // Server settings
   $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "rouabayoudh8@gmail.com"; 
    $mail->Password = "rouabayoudh2003"; 

    // Email settings
    $mail->isHTML(true);

    return $mail;
}
