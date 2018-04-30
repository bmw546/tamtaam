<?php
/*****************************************************************
Fichier : CtrlNomUtilisateurOublie.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
et de les formatter et envoyer a la fonction nom d'utilisateur oublié
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Rémi Létourneau     Oui


Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/
include ("GestionnaireUtilisateur.php");

if (isset($_POST['envoi'])) {
  $gest = new GestionnaireUtilisateur;
  $email = $_POST['email'];
  $gest->nomUtilisateurOublie($email);
  $msg = $gest->getEtat();
  header("Location: UI_nomUtilisateurOublie.php?$msg");
}
?>
