<?php

/*****************************************************************
Fichier : CtrlMotDePasseOublie.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
et de les formatter et envoyer a la fonction mot de passe oublié
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================



Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/

include ("GestionnaireUtilisateur.php");

if (isset($_POST['envoi'])) {
  $gest = new GestionnaireUtilisateur;
  $email = $_POST['email'];
  $gest->motDePasseOublie($email);

  $msg = $gest->getEtat();
  header("Location: UI_motDePasseOublie.php?$msg");
}

?>
