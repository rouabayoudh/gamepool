<?php
require_once 'usermodel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }
    //to connect to the admin page
    public function handleLoginAdmin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Get the admin from the database
            $admin = $this->model->getAdmin($email);
    
            // Verify the password
            if ($admin && password_verify($password, $admin['password'])) {
                session_start();
                $_SESSION['email'] = $email;
                header("Location: admin/index.php");
            } else {
                session_start();
                $_SESSION['error'] = "Invalid Email or Password";
                header("Location: loginadmin.php");
            }
        }
    }

    //to register a user
    public function handleRegister() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
           
            // Check if user with the same email already exists
            if ($this->model->userExists($username)) {
                session_start();
                $_SESSION['error'] = "User with the same email already exists";
                header("Location: signup.php");
                return;
            }
    
            // Check if passwords match
            if ($password != $confirm_password) {
                session_start();
                $_SESSION['error'] = "Passwords do not match";
                header("Location: signup.php");
                return;
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // If all checks pass, insert the user
            $this->model->insertUser($username, $name, $phone, $hashed_password);
            header("Location: loguser.php");
        }
    }
    //to login a user
    public function handleLoginuser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Get the user from the database
            $user = $this->model->getUser($username);
    
            // Verify the password
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: start.php");
            } else {
                session_start();
                $_SESSION['error'] = "Invalid Email or Password";
                header("Location: loguser.php");
            }
        }
    }
}
?>
