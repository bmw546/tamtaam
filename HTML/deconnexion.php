<?php
/*****************************************************************
Fichier : deconnexion.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Déconnecter un utilisateur
Date : 2018-05-05

Vérification :
Date               Nom                   Approuvé
===========================================================
Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/

session_start();
if (isset($_SESSION['utilisateur'])){
    session_destroy();
}
header('location: menu.php');
?>