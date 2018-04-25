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

    $manager = new GestionnaireCommande($_POST['numero'],$_POST['nom'],$_POST['adresse'],$_POST['date'],
        $_POST['montant'],$_POST['etat'],$_POST['type'] );

    $manager->ajouterCommande();
 ?>