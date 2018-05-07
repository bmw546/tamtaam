
<?php
require_once 'MoteurRequeteBD.php';

    $nomProduit = $_POST['produit'];
    $connection = new Connexion();
    $query  = "SELECT description FROM produit WHERE nom = '$nomProduit'";
    $result = $connection->execution_avec_return($query);

    $arrayKeys = array_keys($result);
    $lastArrayKey = array_pop($arrayKeys);

    foreach ($result as $rs){
        echo $rs[0];
        echo ",";
    }

?>