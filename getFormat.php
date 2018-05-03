<?php
require_once 'MoteurRequeteBD.php';

    $nomProduit = $_POST['prod'];
    $connection = new Connexion();
    $query  = "SELECT description FROM 'produit' WHERE  nom = '".$nomProduit."'";
    $result = $connection->execution_avec_return($query);

   $format_arr = array();

    foreach ($result as $rs){
        array_push($format_arr,$rs[0]);
    }
    echo json_encode($format_arr);
?>