<?php
/********************************************************
Fichier : getFormat.php
Auteur : Joel Lapointe
But : Récupere la description des produits
Date : 2018-04-30

Vérification :
Date                    Nom 		    Approuvé
=========================================================
2018-05-06              Rémi            Oui

Historique de modifications :
Date                    Nom                 Description
=========================================================
***********************************************************/
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