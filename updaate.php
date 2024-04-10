<?php
function updateScore($conn, $score, $username) {
    try {
        // Mettre à jour le score directement là où le mot de passe correspond
        $query = "UPDATE users SET Score = :score WHERE email = :username";
        $statement = $conn->prepare($query);
        $statement->bindParam(':score', $score);
        $statement->bindParam(':username', $username);
        $statement->execute();
        
        // Vérifier si des lignes ont été affectées par la mise à jour
        if ($statement->rowCount() > 0) {
            http_response_code(200);
            echo 'Score successfully updated in the database for username: ' . $username;
            return true;
        } else {
            http_response_code(404);
            echo 'Error: No row found for the specified username.';
            return false;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}
function updatetext($conn, $text, $username) {
    try {
        // Mettre à jour le score directement là où le mot de passe correspond
        $query = "UPDATE users SET mybag = :text WHERE email = :username";
        $statement = $conn->prepare($query);
        $statement->bindParam(':text', $text);
        $statement->bindParam(':username', $username);
        $statement->execute();
        
        // Vérifier si des lignes ont été affectées par la mise à jour
        if ($statement->rowCount() > 0) {
            http_response_code(200);
            echo 'text successfully updated in the database for username: ' . $username;
            return true;
        } else {
            http_response_code(404);
            echo 'Error: No row found for the specified username.';
            return false;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}
?>