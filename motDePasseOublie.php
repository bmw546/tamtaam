<?php
include ("GestionnaireUtilisateur.php");
$auth = new GestionnaireUtilisateur;
$email = $_POST['email'];
$auth->motDePasseOublie($email);
echo $auth->getEtat();
?>
