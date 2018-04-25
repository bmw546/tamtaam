<!--****************************************
Fichier : Ctrl_Inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================

Historique de modifications :
Date                    Nom             Description
=========================================================

***********************************************-->
<?php
	require_once 'GestionnaireUtilisateur.php';

	$manager = new GestionnaireUtilisateur($_POST['user'], $_POST['passwd'], $_POST['email'], $_POST['adresse'], $_POST['noTelephone']);
	
	$manager->ajouterUtilisateur();
	
	echo "<p>".$_POST['user']."</p>".
		 "<p>".$_POST['adresse']."</p>".
		 "<p>".$_POST['email']."</p>".
		 "<p>".$_POST['noTelephone']."</p>".
		 "<p>".$_POST['passwd']."</p>";

?>

