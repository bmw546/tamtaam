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
		require_once 'commande.php';
		require_once 'GestionnaireSuiviCommandes.php';
		$gestionnaire = new GestionnaireSuiviCommandes($_POST["username"]);
		$uneCommande = $gestionnaire->getUneCommande();
		$noCommande = $uneCommande->getNumeroCommande();
		$datePrevue = $uneCommande->getDate();
		$etatCommande = $uneCommande->getEtat();
		$adresse = $uneCommande->getAdresse();
		$montant = $uneCommande->getMontant();
	?>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="style.css" />
		<title>cible suivi des commandes</title>
	</head>
	<body style="margin:auto; width:950px;">
		<header class="inscriptionheader col-12">
			SuiviDeCommandes
		</header>
		<p class="txtSuiviComm" >
			<br>
			<br>
			<br>
			Numéro de commande :<br>

			<?php echo $noCommande;?>
			<br>
			<br>
			Date de livraison prévue :
			<br>
			<?php echo $datePrevue;?>
			<br>
			<br>
			État de la commande :
			<br>
			<?php echo $etatCommande;?>
			<br>
			<br>
			Adresse de livraison :
			<br>
			<?php echo $adresse;?>
			<br>
			<br>
			Montant :
			<br>
			<?php echo $montant;?>$
		</p>
	</body>
</html>
