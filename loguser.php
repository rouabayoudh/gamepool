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
        <h2 class="welcome">WELCOME BACK</h2>
        <hr>
        <form id="loginForm" action="connectuser.php" method="post">
        <?php if (isset($_SESSION['error'])) { ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>
    <div class="row">
        <i class="fas fa-user"></i>
        <input id="username" type="email" placeholder="EMAIL" name="username" required>
    </div>
    <div class="row">
        <i class="fas fa-key"></i>
        <input id="password" type="password" placeholder="PASSWORD" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
    </div>
        <div class="forget">
            <a href="forget-password.php">FORGET PASSWORD?</a>    
        </div>
        <div class="remember">
            <input type="checkbox" id="_checkbox">
            <label for="_checkbox">REMEMBER ME</label> 
        </div>
        <div class="button">
            <button type="submit">LOGIN</button>
        </div>
        <div class="lastline">
            <em>NOT A MEMBER ? </em>
            <a href="signup.php">SIGN UP</a>
        </div>
    </form>
    <?php 

?>
    </div>
    
</body>
</html>


