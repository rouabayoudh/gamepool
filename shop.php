<?php
    require 'connectdatabase.php';
    require 'log.php';
    require 'updaate.php';

    
    $amount = $score;
    
    if (isset($_POST['add_to_cart'])){
        if(isset($_SESSION['cart'])){
            $session_array_id=array_column($_SESSION['cart'],"id");
            if(!in_array($_GET['id'],$session_array_id)){
                $session_array=array(
                    'id'=>$_GET['id'],
                    "name"=>$_POST['name'],
                    "price"=>$_POST['price'],
                
    
                );
                $_SESSION['cart'][]=$session_array;
            }

        }else{
            $session_array=array(
                'id'=>$_GET['id'],
                "name"=>$_POST['name'],
                "price"=>$_POST['price'],
            

            );
            $_SESSION['cart'][]=$session_array;
        }
    }
    
    if (isset($_GET['action'])){   //action du bouton de retour à "Detective room"
        if($_GET['action']=="goback"){
            unset($_SESSION['cart']);
            header("Location: Start.php");
            exit();
        }
    }

    $text = "";
    $message = "";
    $total=0;

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $total += $value['price'];
            $text .= $value['name'] . "<br/>";
        }
        
        $tot=$amount-$total;
        $message = '<br/>Total : ' . $total . '🪙<br/> Remaining Amount : ' .$tot. '🪙';
    }
    if (isset($_POST['confirmButton'])) {
        // Mettre à jour le score et le texte et gérer le succès/erreur
        if (updateScore($conn, $tot, $username) ) {
            // Insertion ou mise à jour des éléments de $_SESSION['cart'] dans la table mybag
            foreach ($_SESSION['cart'] as $key => $value) {
                // Vérifier si l'élément existe déjà dans la table mybag
                $query_check = "SELECT * FROM mybag WHERE user_id = :userID AND product_name = :productName";
                $statement_check = $conn->prepare($query_check);
                $statement_check->bindParam(':userID', $userID);
                $statement_check->bindParam(':productName', $value['name']);
                $statement_check->execute();
                $existing_item = $statement_check->fetch(PDO::FETCH_ASSOC);
                
                if ($existing_item) {
                    // Si l'élément existe déjà, mettre à jour la quantité en incrémentant de 1
                    $query_update = "UPDATE mybag SET quantity = quantity + 1 WHERE user_id = :userID AND product_name = :productName";
                    $statement_update = $conn->prepare($query_update);
                    $statement_update->bindParam(':userID', $userID);
                    $statement_update->bindParam(':productName', $value['name']);
                    $statement_update->execute();
                } else {
                    // Si l'élément n'existe pas, insérer un nouvel enregistrement avec une quantité de 1
                    $query_insert = "INSERT INTO mybag (user_id, product_name, quantity) VALUES (:userID, :productName, 1)";
                    $statement_insert = $conn->prepare($query_insert);
                    $statement_insert->bindParam(':userID', $userID);
                    $statement_insert->bindParam(':productName', $value['name']);
                    $statement_insert->execute();
                }
            }
    
            // Toutes les insertions/mises à jour réussies
            echo 'Les éléments ont été insérés dans votre sac avec succès.';
            unset($_SESSION['cart']); // Unset session cart après l'insertion réussie
            header("Location: start.php"); // Rediriger après unsetting session cart
            exit(); // S'assurer de quitter après la redirection
        } else {
            // Erreur lors de la mise à jour du score ou du texte
            echo 'Erreur lors de la mise à jour du score et des items.';
        }
    }
    
    

    
      
                    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAME POOL SHOP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color:whitesmoke;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Detective Store </h2>
                    <div class="col-md-12">
                        <div class="row">

                    

                        <?php
                    $stmt = null;

                    // Condition afficher les produits a vendre en fonction de la valeur de $amount qui est le score du quiz
                    if ($amount == 0) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 3");
                    } elseif ($amount == 100) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 6");
                    } elseif ($amount == 200) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 8");
                    } elseif ($amount == 300) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 10");
                    } elseif ($amount == 400) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 12");
                    } elseif ($amount == 500) {
                        $stmt = $conn->query("SELECT * FROM product LIMIT 13");
                    } else {
                        $stmt = $conn->query("SELECT * FROM product");
                    }

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {// affichage des produits
                        ?>
                        <div class="col-md-4 mb-3">
                            <form method="post" action="shop.php?id=<?= $row['id'] ?>">
                              
                                <div class="card" style="width: 14rem; border-radius: 10%; overflow: hidden;"  >
                                <img src="img/<?= $row['image'] ?>" style='height:170px;' >
                                    <div class="card-body">
                                    <h4 class="text-center"><?= $row['pname']; ?></h4>
                                    <h5 class="text-center"><?= $row['price'] . "🪙"; ?></h5>
                                    <input type="hidden" name="name" value="<?= $row['pname'] ?>">
                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                    <input id='b' type="submit" name="add_to_cart" class="btn btn-warning" value="Add To Cart">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                    ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">My Items 🛍️</h2>
                    <?php
                        $output="";
                        $output.="
                        <table class='table table-bordered table-striped'>
                            <tr>
                                <th>Item name</th>
                                <th>Item price</th>
                                
                                
                                <th>Action</th>
                            </tr>
                        ";
                        if(!empty($_SESSION['cart'])){// Parcours de chaque élément du panier stocké dans $_SESSION['cart'] 
                            foreach($_SESSION['cart'] as $key => $value) {// Pour chaque élément du panier une nouvelle ligne est ajoutée au tableau avec les détails de l'article
                                $output.="
                                <tr>
                                    <td>".$value['name']."</td>
                                    <td>".$value['price']."</td>
                                    
                                    
                                    <td>
                                        <a href='shop.php?action=remove&id=".$value['id']."'>
                                        <button class='btn btn-outline-danger'>Remove</button>
                                        </a>
                                    </td>
                                    </tr>
                                    
                                
                                    
                                ";
                                
                                
                            }
                            //ajout de la somme totale et le montant du user dans le tableau
                            $output .="
                            <tr>
                                    <td>Total :</td>
                                    <td colspan='2' style='text-align: right;'></td>
                                    
                                    </tr>
                            <tr>
                                <td></b>Total Item Price</b></td>
                                <td>".number_format($total)."</td>
                                <td>
                                    <a href='shop.php?action=clearall'>
                                    <button class='btn btn-outline-secondary'>Clear All</button>
                                </td>


                            </tr>
                            
                            <tr>
                            <td></b>My Total Money</b></td>
                            <td>".number_format($tot)."</td>
                            <td>
                                    
                                    <button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>BUY</button>
                                </td>
                            </tr>

                            <tr>
                            <td colspan='2'></td>
                            <td>
                                    <a href='shop.php?action=goback'>
                                    <button class='btn btn-outline-info'>Exit And Play Again</button>
                                </td>
                            </tr>

                            ";
                        }
                        echo $output; // Affichage du tableau HTML
                    ?>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">GAMEPOOL SHOP 🛍️</h1>
            </div>
            <div class="modal-body">
            <h6>My Items :</h6>
            <?php
                echo $text;
                echo "<h6>$message</h6>";
            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form  method="post">
                    <button type="submit" class="btn btn-primary" name="confirmButton">Confirm</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    <?php
    if (isset($_GET['action'])){   //action du bouton de suppression de tous les articles du panier
        if($_GET['action']=="clearall"){
            unset($_SESSION['cart']);
        }
    }
    
    if (isset($_GET['action'])){   //action du bouton de suppression d'un article particulier (au choix)
        if($_GET['action']=="remove"){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['id']==$_GET['id']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }
    
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

