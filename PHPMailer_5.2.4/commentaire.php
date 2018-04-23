<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title>cible gestion users</title>
	</head>
	<body>
		<?php
        include"gestionnaire_commentaire.php";
        $comments= new mail();
        // ajouter les commentaire a la BD
        $nom = $_POST['nom'];
        $courriel = $_POST['courriel'];
        $sujet = $_POST['sujet'];
        $question = $_POST['question'];
        $comments->sentMail($nom,$courriel,$sujet,$question);

		?>
	</body>
</html>
