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
		$gestionnaire = new GestionnaireSuiviCommandes(1,$_POST["username"],"123 somewhere","Mai 1",30,"Limbo","");
		$uneCommande = $gestionnaire->getUneCommande();
		$datePrevue = $uneCommande->getDate();
		$etatCommande = $uneCommande->getEtat();
		$adresse = $uneCommande->getAdresse();
		$montant = $uneCommande->getMontant();
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
