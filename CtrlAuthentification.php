<?php
/*****************************************************************
Fichier : CtrlAuthentification.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
et de les formatter et envoyer a la fonction d'authentification
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Rémi Létourneau       Oui

Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/

include ("GestionnaireUtilisateur.php");
if (isset($_POST['connexion'])) {

  $auth = new GestionnaireUtilisateur;
  $nom_utilisateur = $_POST['nom_utilisateur'];
  $mot_de_passe = $_POST['mot_de_passe'];
  $auth->authentification($nom_utilisateur, $mot_de_passe);
  $msg = $auth->getEtat();
  header("Location: UI_authentification.php?$msg");
}
?>
