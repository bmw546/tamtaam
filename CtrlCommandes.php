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
    $quantite_commande = array();   //Liste des quantités

    $qty = $_POST['qty'];
    $produit = $_POST['chk'];

    //Ignore les quantités 0
    $i= 0;
    foreach ($qty as $q){
        if ($q > 0) {
            $quantite_commande[$i] = $q;
            $i++;
        }

    }

    //Compte le nombre d'élément dans quantité
    $nb = 0;
    foreach($quantite_commande as $qty){
        $nb++;
    }

    //Ajoute les produits avec leur quantité
    for ($x = 0; $x < $nb ; $x++) {
        array_push($produit_commande, $produit[$x], $quantite_commande[$x]);
    }


    $manager = new GestionnaireCommande(0,$_POST['nom'],$_POST['adresse'],date("Y-m-d"),
        $_POST['montant'],1,$_POST['livraison'],$produit_commande);
    $manager->ajouterCommande();
 ?>