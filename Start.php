
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div id="app" class="app">
        <h1 id="titre">🕵️‍♂️ Welcome Detective!</h1>
        <div class="quiz">
            <h2 id="question" style="color: white;">We've been eagerly awaiting your arrival. 🛬<br>Detective,We're counting on your leadership.<br><br>Let's harness that formidable intellect of yours and dive headfirst into the challenges that lie ahead 🔥.<br><br>Are you ready to showcase your detective prowess and lead us to victory?<br> <br>The adventure awaits!🔍🔍<br><br></h2>
            <div class="wrapper" id="container">
            <button id="next"><a href="home.php">PLAY</a></button>
            <button id="next1"><a href="loguser.php">QUIT</a></button>
            <button id="next2" data-bs-toggle="modal" data-bs-target="#exampleModal">MY BAG</button>
            </div>
            
        </div>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">🕵️‍♂️ MY BAG 🛍️</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  <?php
                require 'connectdatabase.php'; 
                require 'log.php';
                // Vérifier si l'ID de l'utilisateur est défini
                if (isset($userID)) {
                    // Effectuer une requête pour sélectionner les noms et les quantités des produits de la table mybag pour cet utilisateur
                    $query = "SELECT product_name, quantity FROM mybag WHERE user_id = :userID";
                    $statement = $conn->prepare($query);
                    $statement->bindParam(':userID', $userID);
                    $statement->execute();
                    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

                    // Afficher les éléments de la table mybag dans le corps du modal
                    if ($items) {
                        echo '<ul>'; // Commencer une liste non ordonnée pour afficher les éléments
                        foreach ($items as $item) {
                            echo '<li>' . $item['product_name'] . ' - Quantity: ' . $item['quantity'] . '</li>'; // Afficher le nom et la quantité de chaque produit
                        }
                        echo '</ul>'; // Fin de la liste non ordonnée
                    } else {
                        echo 'Empty bag.'; // Afficher un message si le sac de l'utilisateur est vide
                    }
                } else {
                    echo 'Erreur: ID utilisateur non défini.'; // Afficher un message d'erreur si l'ID utilisateur n'est pas défini
                }
            ?>

      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</body>
</html>

