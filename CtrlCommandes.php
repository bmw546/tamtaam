<?php
/*****************************************************
Fichier : GestionnaireCommande.php
Auteur : Joel Lapointe
Fonctionnalité : WEB-02 - Gestion des commandes
Date : 25 avril 2018

Vérification :
Date                Nom                 Approuvé
====================================================
2018-04-29          Rémi Létourneau     Oui

Historique de modifications :
Date                Nom                 Description
======================================================
 *****************************************************/

    require_once 'GestionnaireCommande.php';

    session_start();

    $produit_commande = array();
    $nomProduit = $_POST['listeProduit']   ; //Liste des produits
    $qty = $_POST['qty'];
    $format = $_POST['format'];

    $connection = new Connexion();

    //Ignore les quantités 0
    $i=0;
    foreach ($qty as $q){
        if ($q > 0) {
            $query  = "SELECT id_produit FROM produit WHERE nom = '$nomProduit[$i]' AND description ='$format[$i]'";
            $result = $connection->execution_avec_return($query);
            $idProduit = $result[0][0];

            array_push($produit_commande, $idProduit, $q);
            $i++;
        }
    }

    $manager = new GestionnaireCommande(0,$_POST['nom'],$_POST['adresse'],date("Y-m-d"),
        $_POST['total'],1,$_POST['livraison'],$produit_commande);
    $manager->ajouterCommande();

    $msg = "Commande effectué";
    header("Location: UI_gestCommandes.php?$msg");
 ?>