<?php
require 'connectdatabase.php';
require 'log.php';


$message = $_POST["message"];
$type = $_POST["type"];





// Prepare an SQL statement
$sql = "UPDATE users SET message = :message , type = :type  WHERE email = :email";


// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters

$stmt->bindParam(":message", $message, PDO::PARAM_STR);
$stmt->bindParam(":type", $type, PDO::PARAM_STR);
$stmt->bindParam(':email',$username, PDO::PARAM_STR);

// Execute the statement
try {
    $stmt->execute();
   // echo "New record inserted successfully";
    header('Location: home.php');
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the statement and connection
$stmt = null;
$conn = null;
