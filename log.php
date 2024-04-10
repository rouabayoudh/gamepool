<?php
session_start();
// Vérifie si la session pour l'email existe
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo "La session pour l'email n'existe pas.";
}

try {
    $query = "SELECT id, Score FROM users WHERE email = :username";

    // Préparation de la requête pour récupérer le score et l'ID selon l'email
    $statement = $conn->prepare($query);
    $statement->bindParam(':username', $username);

    // Exécution de la requête
    $statement->execute();

    // Récupération du résultat
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Récupération de la valeur du score et de l'ID
    $score = $row['Score'];
    $userID = $row['id'];

} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
