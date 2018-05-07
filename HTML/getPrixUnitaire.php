<?php
/********************************************************
Fichier : getPrixUnitaire.php
Auteur : Joel Lapointe
But : Récupere le prix des produits
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
$description = $_POST['qty'];
$connection = new Connexion();
$query  = "SELECT prix FROM produit WHERE nom = '$nomProduit' AND description ='$description'";
$result = $connection->execution_avec_return($query);

echo $result[0][0];

?>