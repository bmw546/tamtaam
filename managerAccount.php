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
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title>cible gestion users</title>
	</head>
	<body>
		<?php
		require_once 'utilisateur.php';
		
		$aUser = new Utilisateur($_POST['user'], $_POST['adresse'], $_POST['email'], 
		$_POST['noTelephone'], $_POST['passwd']);

		//ajoute l'utilisateur a la base de donnée
		//TODO

		echo "<p>".$_POST['user']."</p>".
			 "<p>".$_POST['adresse']."</p>".
			 "<p>".$_POST['email']."</p>".
			 "<p>".$_POST['noTelephone']."</p>".
			 "<p>".$_POST['passwd']."</p>".
			 "<p>".$_POST['confirmer']."</p>";

		?>
	</body>
</html>
