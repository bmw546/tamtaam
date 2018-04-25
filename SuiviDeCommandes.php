<!--****************************************
Fichier : SuiviDeCommandes.php
Auteur : Benoit Audette-Chavigny
Fonctionnalité : Gestion des demandes et suivi de livraison
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

	<?php
		$datePrevue="Mai 1";
		$etatCommande="Limbo";
		$adresse="123 somewhere";
		$montant=30;
	?>
	<head>
		<meta charset='utf-8'/>
		<title>cible suivi des commandes</title>
	</head>
	<body>
		Numéro de commande :<?php echo $_POST["orderNumber"];	?>
		<br>
		Date de livraison prévue : <?php echo $datePrevue;?>
		<br>
		État de la commande : <?php echo $etatCommande;?>
		<br>
		Adresse de livraison : <?php echo $adresse;?>
		<br>
		Montant : <?php echo $montant;?>$
	</body>
</html>
