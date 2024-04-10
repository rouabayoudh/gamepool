<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamePool</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    

    
    <div class="bgAnimation" id="bgAnimation">
        <div class="backgroundAmim">
            
        </div>
    </div>

    <div class="container">
        <nav>
            
            <ul>
                
                <li><a href="download_services.php">Services</a></li>
                
                
                <li><a href="#" id="contactLink">Contact</a></li>
            </ul>
        </nav>
        
        <section>
            <div class="textBox">
                <h1><span>GAME</span> POOL</h1>
                <p>........ </p>
                <p>stop searching  ! </p>
                    <p> Find your perfect game with just a few clicks... </p>
                    <p>........ </p>
                   
                
                
            </div>
        </section>

    </div>

<!--the popup code is in here -->
    <?php
        include("contact.php"); 
        $contactPopup = new ContactPopup();
    ?>
    <main>
        <!-- Popup for contact information -->
        <div id="contactPopup" style="display: none; position: absolute; top: 10%; left: 50%; transform: translate(-50%, -50%); background: #1d1d1d; padding: 50px; border-radius: 10px;">
            <h2>Contact Information</h2>
            <p>Email: gamepool@example.com</p>
            <p>Address: Insat,Tunis</p>
            <button   onclick="hideContactPopup()" >Close</button>
        </div>
    </main>


    



  <!-- the label design is in here  -->
    <main>
        <div style="position: absolute; top: 77%; left: 45%; transform: translate(-60%, -50%);">
            <form action="choice.php" method="post" style="background: linear-gradient(to left, white, #707ac0); border-radius: 10px; ">
                <label for="choose" style="color: white; font-size: 18px;"></label>
                <select name="choose" id="choose" style="font-size: 16px; padding: 14px; border: none; background: transparent; color: black;">
                    <option value="none">None</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option> 
                </select>
                <div class="textBox">

                    <button class="homeBtn" style="--i:#626fcf;position: absolute; top: 55.6%; left: 120%; transform: translate(-20%, -80%); font-size: 10px">permission to enter</button>

                </div>

            </form>
        </div>
    </main>

    <?php  include("footer.php"); ?>

    <audio id="page-music" src="8bit Click Sound Effect (320 kbps).mp3"></audio>
    <script src="script.js"></script>
    <?php echo $contactPopup->getEventListener(); ?>

    <?php echo $contactPopup->hideContactPopupScript(); ?>
</body>
</html>