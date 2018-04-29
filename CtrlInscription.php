<?php
/****************************************
Fichier : inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================

Historique de modifications :
Date                    Nom             Description
=========================================================
2018-04-29							Roméo           Ajouté l'envoie de messages d'erreurs/succès
***********************************************/
require_once 'GestionnaireUtilisateur.php';

if (isset($_POST['inscrire'])) {
	$manager = new GestionnaireUtilisateur($_POST['user'], $_POST['passwd'], $_POST['email'], $_POST['adresse'], $_POST['noTelephone']);
	$manager->ajouterUtilisateur();
	$msg = $manager->getEtat();
	header("Location: UI_Inscription.php?$msg");
}
?>
