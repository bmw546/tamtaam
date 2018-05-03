<?php
/*****************************************************************
Fichier : CtrlAuthentification.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
et de les formatter et envoyer a la fonction modifierUtilisateur
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================

Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/

require_once 'GestionnaireUtilisateur.php';

if (isset($_POST['modifier'])) {

    session_start();
    if (isset($_SESSION['utilisateur']))
    {
        $user = unserialize($_SESSION['utilisateur']);
        $gest = new GestionnaireUtilisateur;
        $gest->setUnUtilisateur($user);
        $gest->modifier($_POST['user'], $_POST['email'], $_POST['passwd'], $_POST['adresse'], $_POST['noTelephone']);
        $msg = $gest->getEtat();
        session_start();
        $user = $gest->getUnUtilisateur();
        $_SESSION['utilisateur'] = serialize($user);
        header("Location: UI_modifierUtilisateur.php?$msg");
    }
    else{
        header("Location: HTML/menu.php");
    }

}

?>