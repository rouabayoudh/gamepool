<?php
use LDAP\Result;

session_start();

class Functions {
    public static function validate($inputData, $conn) {
        $validateData = htmlspecialchars($inputData); // Using htmlspecialchars to prevent XSS attacks
        return trim($validateData);
    }

    public static function redirect($url, $status) {
        $_SESSION['status'] = $status;
        header('Location: ' . $url);
        exit(0);
    }

    public static function alertMessage() {
        if (isset($_SESSION['status'])) {
            echo '<div class ="alert alert-success">
            <h6>'.htmlspecialchars($_SESSION['status']).'</h6>
            </div>';
            unset($_SESSION['status']);
        }
    }

    public static function getall($tablename) {
        require_once('../config/dbcon.php'); // Include your database connection file

        $table = Functions::validate($tablename, $conn);

        $query = "SELECT * FROM $table";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Fetch all rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function checkParamId($paramType) {
        if (isset($_GET[$paramType])) {
            if ($_GET[$paramType] != null) {
                return $_GET[$paramType];
            } else {
                return 'no id found ';
            }
        } else {
            return 'no id given ';
        }
    }

    public static function getById($tablename, $id) {
        require_once('../config/dbcon.php'); // Include your PDO connection file

        $table = Functions::validate($tablename, $conn);
        $id = Functions::validate($id, $conn);

        $query = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Fetch the row as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $response = ['status' => 200, 'message' => 'fetched data', 'data' => $row];
        } else {
            $response = ['status' => 404, 'message' => 'No Data Found'];
        }

        return $response;
    }

    public static function deleteQuery($tableName, $id) {
        require_once('../config/dbcon.php'); 

        // Validate inputs to prevent SQL injection
        $table = Functions::validate($tableName, $conn);
        $id = Functions::validate($id, $conn);

        // Prepare the SQL statement
        $query = "DELETE FROM $table WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id);

        // Execute the statement
        $result =  $stmt->execute();

        // Check if the deletion was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>
