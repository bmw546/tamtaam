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

    $produit_commande = array();    //Liste des produits

    $qty = $_POST['qty'];

    //Ignore les quantités 0
    $idProduit= 1;
    foreach ($qty as $q){
        if ($q > 0) {
            array_push($produit_commande, $idProduit, $q);
            echo $idProduit . "</br>";
            echo $q . "</br>";

            $idProduit++;
        }

    }

    $manager = new GestionnaireCommande(0,$_POST['nom'],$_POST['adresse'],date("Y-m-d"),
        $_POST['montant'],1,$_POST['livraison'],$produit_commande);
    $manager->ajouterCommande();
 ?>