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
<?php
	session_start();
?>
<!DOCTYPE html>
<html>

	<?php
		require_once 'utilisateur.php';
		$usr = unserialize($_SESSION['utilisateur']);
		require_once 'commande.php';
		require_once 'GestionnaireSuiviCommandes.php';
		$gestionnaire = new GestionnaireSuiviCommandes($usr->getNomUtilisateur());
		$uneCommande = $gestionnaire->getUneCommande();
		$noCommande = $uneCommande->getNumeroCommande();
		$datePrevue = $uneCommande->getDate();
		$etatCommande = $uneCommande->getEtat();
		$adresse = $uneCommande->getAdresse();
		$montant = $uneCommande->getMontant();
		$lat = $gestionnaire->getLatitude();
		$lon = $gestionnaire->getLongitude();
	?>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
		<title>cible suivi des commandes</title>
	</head>
	<body class="txtSuiviComm">
		<nav class="entete col-12">
		    <img src="image/logo.png" alt="logo"/>
		    <ul>
                <li class="menu col-2 col-t-2"><a href="https://tamtaam.com/">Accueil</a></li>
                <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
                <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
                <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
                <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
		    </ul>
		</nav>
		<header class="inscriptionheader col-12">
            <i>Suivi de commandes</i>
		</header>
		<table class="col-5 col-t-8 suivi">
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
		

		<div id="googleMap" class="col-8 col-t-10 map"></div>
        <p class="col-12"><button class="btnInscrire btnStyle" onclick="location.href='menu.php'" type="button">Retour au menu</button></p>
<script>
function myMap() {
	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
  var myCenter = new google.maps.LatLng(<?php echo json_encode($lat);?>,<?php echo json_encode($lon);?>);
  var mapCanvas = document.getElementById("googleMap");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);

	directionsDisplay.setMap(map);

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
						calculateAndDisplayRoute(directionsService, directionsDisplay,pos,myCenter);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

      }

			function handleLocationError(browserHasGeolocation, infoWindow, pos) {
				infoWindow.setPosition(pos);
				infoWindow.setContent(browserHasGeolocation ?
															'Error: The Geolocation service failed.' :
															'Error: Your browser doesn\'t support geolocation.');
				infoWindow.open(map);
			}


		function calculateAndDisplayRoute(directionsService, directionsDisplay,pos,myCenter){
			directionsService.route({
				origin: pos,
				destination: myCenter,
				travelMode: 'DRIVING'
			}, function(response, status) {
				if (status === 'OK') {
					directionsDisplay.setDirections(response);
					var route = response.routes[0];
					var summaryPanel = document.getElementById('directions-panel');
					summaryPanel.innerHTML = '';
					// For each route, display summary information.
					for (var i = 0; i < route.legs.length; i++) {
						var routeSegment = i + 1;
						summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
								'</b><br>';
						summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
						summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
						summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
					}
				} else {
					window.alert('Directions request failed due to ' + status);
				}
			});
		}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2DoS7rI7KbNt_FTauYlTFH2kgPx2wc3I&callback=myMap"></script>
	</body>
</html>
