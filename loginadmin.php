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
    <form action="connectadmin.php" method="post">
    <?php if (isset($_SESSION['error'])) { ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>
    <div class="row">
        <i class="fas fa-user"></i>
        <input id="email" type="email" placeholder="EMAIL" name="email" required>
    </div>
        <div class="row">
            <i class="fas fa-key"></i>
            <input type="password" placeholder="PASSWORD" name="password" required >
        </div>
        <div class="remember">
            <input type="checkbox" id="_checkbox">
            <label for="_checkbox">REMEMBER ME</label> 
        </div>
        <div class="button">
            <button type="submit">LOGIN</button>
        </div>
        
    </form>
    </div>
</body>
</html>
