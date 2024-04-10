<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

require_once __DIR__ . "/connectdatabase.php";

$sql = "SELECT * FROM user WHERE reset_token_hash = :token_hash";

$stmt = $pdo->prepare($sql);

$stmt->bind_param(': $token_hash',$token_hash,PDO::PARAM_STR);

$stmt->execute();


$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user === false) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!--font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <!--LOCAL CSS -->
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    
    <div class="background-img"></div>
    <div class="container">
        
        
    
    <div class="row">
        <i class="fas fa-key"></i>
        <input id="password" type="password" placeholder="PASSWORD" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
    </div>
    
    
        
        <form method="post" action="process-reset-password.php">

            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <label for="password">New password</label>
            <input type="password" id="password" name="password">

            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation"
           name="password_confirmation">

            <button>Send</button>
        </form>


    </div>
    
</body>
</html>


