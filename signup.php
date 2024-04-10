<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
        <form action="register.php" method="post">
        <?php if (isset($_SESSION['error'])) { ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>
            <div class="input">
                <input type="email" placeholder="MAIL" name="username" required>
            </div>
            <div class="input">
                <input type="text" placeholder="USERNAME" name="name" required>
            </div>
            <div class="input">
    <input type="text" placeholder="PHONE" name="phone" pattern="[\+\-\(\)0-9\s]+" title="Please enter a phone number" required>
</div>
            <div class="input">
    <input type="password" placeholder="PASSWORD" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
</div>
            <div class="input">
                <input type="password" placeholder="CONFIRM PASSWORD" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
            </div>
            <div class="button">
                <button type="submit">SIGN UP</button>
            </div>
            <div class="lastline">
                <em>ALREADY A MEMBER ? </em>
                <a href="loguser.php">LOG IN</a>
            </div>
        </form>
    </div>
</body>
</html>