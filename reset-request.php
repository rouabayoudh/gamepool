<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require __DIR__ . "/vendor/autoload.php";


$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token); //creating a secure token for verification of the email address.

$expiry = date("Y-m-d H:i:s", time() + 60 * 30); //the token is valid for 30 minutes

// Include the database configuration file
require_once __DIR__ . "/connectdatabase.php";

try {
    // Create a new PDO connection
    $mysqlConnection = new MySQLConnection();
    $conn = $mysqlConnection->getConnection();

    // Prepare the SQL query
    $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bindParam(1, $token_hash);
    $stmt->bindParam(2, $expiry);
    $stmt->bindParam(3, $email);
    $stmt->execute();

    // Check if the update was successful
    $affected_rows = $stmt->rowCount();
    if ($affected_rows > 0) {
        // Include the mailer class and create a new instance
        require_once __DIR__ . "/mailer.php";
        $mail = new PHPMailer(true); // assuming PHPMailer object is directly instantiated here

        // Set up email parameters
        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = "Click <a href='http://localhost/TP_PHP-MAIN/forget-password.php?token=$token'>here</a> to reset your password.";

        // Send the email
        if ($mail->send()) {
            echo "Email sent successfully.";
        } else {
            echo "Message could not be sent.";
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
        echo "Message sent, please check your inbox."; // Moved this echo outside the if-else block
    } else {
        echo "No rows updated";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
echo "Message sent,please check your inbox";
?>





    

