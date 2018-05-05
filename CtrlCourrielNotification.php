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
2018-05-05         Roméo                 modifié le php pour qu'il prenne l'utilisateur authentifié
 *****************************************************************/
require_once  'utilisateur.php';
include("GestionnaireCourrielNotification.php");
session_start();

if (isset($_SESSION['utilisateur']))
{
    $Email = new CourrielNotification();
    $usr = unserialize($_SESSION['utilisateur']);
    $id_client = $usr->getId();
    $sms = $_POST['sms'];

    $notification = $_POST['notification'];
    $nouveau = $_POST['nouveau'];
    $reception = $_POST['reception'];
    $etat = $_POST['etat'];
    $Email->chercher_si_existe($id_client,$sms,$notification,$nouveau,$reception,$etat);
}
else{
    echo "Vous n'êtes pas connecté";
}
?>