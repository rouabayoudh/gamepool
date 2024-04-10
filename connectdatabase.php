<?php
class  MySQLConnection
{
    private $servername;
    private $username;
    private $password;
    private $db;
    private $conn;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db = "fundaservices";

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
$mysqlConnection = new MySQLConnection();
$conn = $mysqlConnection->getConnection();
?>
