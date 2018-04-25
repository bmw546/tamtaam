<?php
include ("GestionnaireUtilisateur.php");
$auth = new GestionnaireUtilisateur;
$email = $_POST['email'];
$auth->nomUtilisateurOublie($email);
echo $auth->getEtat();
?>
