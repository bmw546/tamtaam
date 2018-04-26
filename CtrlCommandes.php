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

    $manager = new GestionnaireCommande($_POST['nom'],$_POST['adresse'],date("Y-m-d"),
        $_POST['montant'],1,$_POST['livraison'] );
    
    $manager->ajouterCommande();
 ?>