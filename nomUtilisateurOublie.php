<?php
include ("authentification.php");
$auth = new Authentification;
$email = $_POST['email'];
$auth->nomUtilisateurOublie($email);
echo $auth->getEtat();
?>
