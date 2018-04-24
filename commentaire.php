<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title>cible gestion users</title>
	</head>
	<body>
		<?php
		include ("gestionnaire_commentaire.php");
		$Email = new mail();
		//$aUser = new Utilisateur($_POST['user'], $_POST['adresse'], $_POST['email'],
		//$_POST['noTelephone'], $_POST['passwd']);

		//ajoute l'utilisateur a la base de donn�e
		//TODO
        /*
		echo "<p>".$_POST['nom']."</p>".
			 "<p>".$_POST['courriel']."</p>".
			 "<p>".$_POST['sujet']."</p>".
			 "<p>".$_POST['question']."</p>"
		*/
        $nom = $_POST['nom'];
        $courriel = $_POST['courriel'];
        $sujet = $_POST['sujet'];
        $question = $_POST['question'];
        $Email->sentMail($nom,$courriel,$sujet,$question);
        ?>
	</body>
</html>
