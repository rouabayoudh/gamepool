
<?php

class ChoiceHandler {

    public function handleChoice() {

        // Check if the request method is POST to be more secure

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $choose = htmlspecialchars($_POST["choose"]);

            if ($choose == "none") {
                
                
                // Introduce a delay of 1 second (1000 milliseconds) before redirecting
                usleep(1000000); // 1 second in microseconds
                
                $this->redirectToPreviousPage();
                // If 'None' is selected, redirect back to the previous page
                
            }
        
            elseif ($choose == "admin") {
            // If 'Admin' is selected, redirect to another website
                include_once("loginadmin.php");  
            }
            else {
            // If 'user' is selected, redirect to another website
             include_once("loguser.php"); 
            
        }
        }else{
            $this->redirectToPreviousPage();

        }

    }

    private function redirectToPreviousPage() {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();  // Ensure script termination after redirection
    }
    
       
}

// Instantiate the ChoiceHandler class and call the handleChoice method

$choiceHandler = new ChoiceHandler();
$choiceHandler->handleChoice();
?>
