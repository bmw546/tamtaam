<?php
include ("authentification.php");
$auth = new Authentification;
$email = $_POST['email'];
$auth->motDePasseOublie($email);
echo $auth->getEtat();
?>
