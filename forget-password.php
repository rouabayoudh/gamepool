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
        
        <div class="button">
            <h2>Reset your password</h2>
        </div>
        <p>
            AN email will be send to you with instructions on how to reset your password.</p>

    <form action="reset-request.php" method="post">  
        <div class="row"> 
            <i class="fas fa-user"></i>   
            <input type="email" name="email" id="email" placeholder="Enter your e-mail address....">
            
        </div> 
        <button type="submit" name="reset-request-submit">Receive new password by email</botton> 
    </form>
    
    </div>
</body>
</html>