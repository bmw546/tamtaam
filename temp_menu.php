<?php

require_once 'Utilisateur.php';
session_start();
$usr = unserialize($_SESSION['utilisateur']);

echo "Nom d'utilisateur: " . $usr->getNomUtilisateur() . "<br>" . "Mot de passe: " . $usr->getMotDePasse() . "<br>" . "...";
?>