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
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
		<title>cible suivi des commandes</title>
	</head>
	<body class="txtSuiviComm">
		<nav class="entete col-12">
				<img  src="HTML/image/logo.png" alt="logo"/>
				<ul>
						<li class="menu col-2 col-t-2"><a href="#">Accueil</a></li>
						<li class="pointMenu menu col-2 col-t-2"><a href="#">Nos produits</a></li>
						<li class="pointMenu menu col-2 col-t-2"><a href="#">En savoir plus</a></li>
						<li class="pointMenu menu col-2 col-t-2"><a href="#">Points de ventes</a></li>
						<li class="pointMenu menu col-2 col-t-2"><a href="#">Nous joindre</a></li>
				</ul>
		</nav>
		<header class="inscriptionheader col-12">
			SuiviDeCommandes
		</header>
		<table  style="border:solid black; align:center; margin:28%; margin-top:5%;margin-bottom:10%;"class="col-5">
			<tr>
				<td>Numéro de commande :</td>
				<td><?php echo $noCommande;?></td>
			</tr>
			<tr>
				<td>Date de livraison prévue :</td>
				<td><?php echo $datePrevue;?></td>
			</tr>
			<tr>
				<td>État de la commande :</td>
				<td><?php echo $etatCommande;?></td>
			</tr>
			<tr>
				<td>Adresse de livraison :</td>
				<td><?php echo $adresse;?></td>
			</tr>
			<tr>
				<td>Montant :</td>
				<td><?php echo $montant;?>$</td>
			</tr>
		</table>

		<div id="googleMap" style="width:100%;height:500px"></div>

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(45.4110,-71.8859);
  var mapCanvas = document.getElementById("googleMap");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({
		position:myCenter,
		animation:google.maps.Animation.BOUNCE
	});
  marker.setMap(map);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2DoS7rI7KbNt_FTauYlTFH2kgPx2wc3I&callback=myMap"></script>
	</body>
</html>
