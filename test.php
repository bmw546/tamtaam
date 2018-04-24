<?php

include_once 'authentification.php';

$auth = new Authentification;
$u1 = new Utilisateur;

$u1->setId(999);
$u1->setNomUtilisateur("jTbB");
$u1->setMotDePasse("Romeo");
$u1->setEmail("roger123@gmail.com");
$u1->setTelephone("8198888888");

$auth->setUtilisateur($u1);

$auth->validationAuthentification();
echo $auth->getEtat();

 ?>
