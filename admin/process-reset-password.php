<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

require_once __DIR__ . "/connectdatabase.php";

$sql = "SELECT * FROM user WHERE reset_token_hash = :token_hash";
$stmt = $pdo->prepare($sql);

stmt->bindParam(':token_hash', $token_hash, PDO::PARAM_STR);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

// Validate the password
$password = $_POST["password"];
$password_confirmation = $_POST["password_confirmation"];

if (strlen($password) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $password)) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $password)) {
    die("Password must contain at least one number");
}

if ($password !== $password_confirmation) {
    die("Passwords must match");
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement for updating the user's password
$sql = "UPDATE user SET password_hash = :password_hash, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
$stmt->bindParam(':id', $user["id"], PDO::PARAM_INT);
$stmt->execute();

echo "Password updated. You can now login.";

