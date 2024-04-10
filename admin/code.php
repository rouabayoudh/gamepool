<?php
require '../config/dbcon.php';
require '../config/function.php'; // Include function.php for validate function

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addUser($name, $phone, $email, $password, $role, $is_ban) {
        // Validate input
        $name = Functions::validate($name, $this->conn);
        $phone = Functions::validate($phone, $this->conn);
        $email = Functions::validate($email, $this->conn);
        $password = Functions::validate($password, $this->conn);
        $role = Functions::validate($role, $this->conn);

        // Check if all fields are filled
        if ($name != '' && $email != '' && $phone != '' && $password != '') {
            // Insert into database
            $query = "INSERT INTO users (name, phone, email, password, is_ban, role) 
                      VALUES (:name, :phone, :email, :password, :is_ban, :role)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':is_ban', $is_ban, PDO::PARAM_INT);
            $stmt->bindParam(':role', $role);
            $result = $stmt->execute();

            if ($result) {
                Functions::redirect('users.php', 'User/Admin added successfully');
            } else {
                Functions::redirect('users-create.php', 'Something went wrong');
            }
        } else { 
            Functions::redirect('users-create.php', 'Please fill all input fields');
        }
    }

    public function UpdateUser($name, $phone, $email, $password, $role, $is_ban, $userId)
    {
        // Validate input
        $name = Functions::validate($name, $this->conn);
        $phone = Functions::validate($phone, $this->conn);
        $email = Functions::validate($email, $this->conn);
        $password = Functions::validate($password, $this->conn);
        $role = Functions::validate($role, $this->conn);
        $userId = Functions::validate($userId, $this->conn);

        // Check if all fields are filled
        if ($name != '' && $email != '' && $phone != '' && $password != '') {
            // Update database
            $query = "UPDATE users SET name=:name, phone=:phone, email=:email, password=:password, is_ban=:is_ban, role=:role WHERE id=:userId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':is_ban', $is_ban, PDO::PARAM_INT);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $result = $stmt->execute();

            if ($result) {
                Functions::redirect('users.php', 'User/Admin updated successfully');
            } else {
                Functions::redirect('users-edit.php?id=' . $userId, 'Something went wrong');
            }
        } else { 
            Functions::redirect('users-edit.php?id=' . $userId, 'Please fill all input fields');
        }
    }
}

if (isset($_POST['SaveUser'])) {
    $user = new User($conn);
    $user->addUser($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['role'], isset($_POST['is_ban']));
} elseif (isset($_POST['updateUser'])) {
    $user = new User($conn);
    $user->UpdateUser($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['role'], isset($_POST['is_ban']), $_POST['userId']);
} else {
    Functions::redirect('users-create.php', 'Form not submitted properly');
}
?>
