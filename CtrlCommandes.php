<?php
/********************************
Fichier : GestionnaireCommande.php
Auteur : Joel Lapointe
Fonctionnalité : WEB-02 - Gestion des commandes
Date : 25 avril 2018

Vérification :
Date                Nom                 Approuvé
====================================================

Historique de modifications :
Date                Nom                 Description
======================================================
 *****************************/

    require_once 'GestionnaireCommande.php';

    $produit_commande = array();
    $quantite_commande = array();

    $qty = $_POST['qty'];
    $produit = $_POST['chk'];

    $i = 0;
    foreach ($qty as $q){
        if ($q > 0) {
            $quantite_commande[$i] = $q;
            $i++;
        }

    }

    $nb = 0;
    foreach($quantite_commande as $qty){
        $nb++;
    }

    for ($x = 0; $x < $nb ; $x++) {
        array_push($produit_commande, $produit[$x], $quantite_commande[$x]);
    }

    $manager = new GestionnaireCommande(0,$_POST['nom'],$_POST['adresse'],date("Y-m-d"),
        $_POST['montant'],1,$_POST['livraison'],$produit_commande);
    
    $manager->ajouterCommande();
 ?>