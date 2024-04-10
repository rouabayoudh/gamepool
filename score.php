<?php
require 'connectdatabase.php';
require 'log.php';
require 'updaate.php';

$data = json_decode(file_get_contents('php://input'), true);// Récupère les données JSON envoyées depuis la requête HTTP POST

if (isset($data['score'])) {//Vérifie si la clé 'score' existe
    $score = $data['score'];//assigne la valeur à la variable $score
    if (updateScore($conn, $score, $username)) {
        echo 'Score mis à jour avec succès.';
    } else {
        echo 'Erreur lors de la mise à jour du score.';
    }
    
    
} else {
    http_response_code(400);
    echo 'Error: Score data or username is missing or invalid.';
}

?>
