<?php

include ("GestionnaireUtilisateur.php");
$auth = new GestionnaireUtilisateur;

$nom_utilisateur = $_POST['nom_utilisateur'];
$mot_de_passe = $_POST['mot_de_passe'];
$auth->authentification($nom_utilisateur, $mot_de_passe);
echo $auth->getEtat();
?>
