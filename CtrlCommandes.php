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
    require_once 'connection.php';

    $connection = new Connexion();
    $query  = "SELECT LAST (id_commande) FROM commande;";
    $result = $connection->execution_avec_return($query);
    $numero = $result[0][0] + 1;

    $manager = new GestionnaireCommande($numero,$_POST['nom'],$_POST['adresse'],$_POST['date'],
        $_POST['montant'],1,$_POST['livraison'] );
    $manager->ajouterCommande();
 ?>