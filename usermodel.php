<?php
require_once 'connectdatabase.php';

class UserModel {
    private $conn;

    public function __construct() {
        $connection = new MySQLConnection();
        $this->conn = $connection->getConnection();
    }
    //to insert a user into the database
    public function insertUser($email, $username, $phone, $password) {
        $sql = "INSERT INTO Users (email, name , phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $username, $phone, $password]);
    }
    //to get a user from the database
    public function getUser($username) {
        $sql = "SELECT * FROM Users WHERE email = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn = null;
        return $user;
    }
   //to get an admin from the database
   // SAMARITAN7XP33h password admin
    public function getAdmin($email) {
        $sql = "SELECT * FROM admins WHERE email = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->conn = null;
        return $admin;
    }

   
    //to check if a user already exists in the database
    public function userExists($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        return count($result) > 0;
    }
}


