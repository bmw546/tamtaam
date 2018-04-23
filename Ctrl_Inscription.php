<!--****************************************
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

***********************************************-->
<?php
	require_once 'gestionnaireUtilisateur.php';


	echo "<p>".$_POST['user']."</p>".
		 "<p>".$_POST['adresse']."</p>".
		 "<p>".$_POST['email']."</p>".
		 "<p>".$_POST['noTelephone']."</p>".
		 "<p>".$_POST['passwd']."</p>".
		 "<p>".$_POST['confirmer']."</p>";

?>

