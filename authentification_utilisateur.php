<?php

include ("authentification.php");
$auth = new Authentification;

$nom_utilisateur = $_POST['nom_utilisateur'];
$mot_de_passe = $_POST['mot_de_passe'];
$auth->validationAuthentification($nom_utilisateur, $mot_de_passe);
echo $auth->getEtat();
?>
