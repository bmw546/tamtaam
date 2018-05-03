<?php
/*****************************************************************
Fichier : CtrlCourrielNotification.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
et de les formatter et envoyer a la fonction pour notification de courriel et SMS
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Rémi Létourneau       Oui

Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/
include("GestionnaireCourrielNotification.php");
    $Email = new CourrielNotification();
    $id_client = $_POST['id_client'];
    $sms = $_POST['sms'];
    $notification = $_POST['notification'];
    $nouveau = $_POST['nouveau'];
    $reception = $_POST['reception'];
    $etat = $_POST['etat'];
    $Email->chercher_si_existe($id_client,$sms,$notification,$nouveau,$reception,$etat);
?>