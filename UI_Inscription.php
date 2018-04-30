
<!--******************************************************
Fichier : UI_Inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================
2018-04-29         Joel Lapointe         Oui

Historique de modifications :
Date                    Nom             Description
=========================================================
2018-04-25							Roméo          Modifié textfield pour password pour le champ mot de passe
2018-04-29							Roméo 				 Rajouté les messages d'erreurs/succès
********************************************************-->
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des comptes utilisateurs</title>
	</head>

	<body style="margin:auto; width:950px;">
		<header>
			<h1 style="text-align:center;"><i>Inscription des utilisateurs</i></h1>
		</header>

		<form action="CtrlInscription.php" method="post" style="padding:20px; border:solid black;">
                    <br>
                    <label for="user" style="padding-right:50px;"><b>Entrer votre nom d'utilisateur :</b></label>
                    <input type="text" name="user" id="user" size="30" required/>

                    <br><br>
                    <label for="adresse" style="padding-right:118px;"><b>Entrer votre adresse :</b></label>
                    <input type="text" name="adresse" id="adresse" size="30" required/>

                    <br><br>
                    <label for="email" style="padding-right:122px;"><b>Entrer votre E-mail :</b></label>
                    <input type="text" name="email" id="email" size="30" required/>

                    <br><br>
                    <label for="noTelephone" style="padding-right:25px;"><b>Entrer votre numéro de téléphone :</b></label>
                    <input type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="30" required/>

                    <br><br>
                    <label for="passwd" style="padding-right:80px;"><b>Entrer votre mot de passe :</b></label>
                    <input type="password" name="passwd" id="passwd" size="30" required/>

                    <br><br>
                    <label for="confirmer" style="padding-right:54px;"><b>Confirmer votre mot de passe :</b></label>
                    <input type="password" name="confirmer" id="confirmer" size="30" required/>

                    <br><br>
                    <input  style="margin-left:80px; margin-right:100px; background-color:black; color:white; border-color:black;" name="inscrire" type="submit" value="S'inscrire"/>
                    <button style="background-color:black; color:white; border-color:black;" type="reset" name="cancel" value="Annuler">Annuler</button>
		</form>
								<center>
										<?php
										$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
										if (strpos($fullUrl, "nomUtilisateurInvalide") == true) {
											echo "<p style='color:red;'>". "Nom d'utilisateur déja utilisé. Veuillez en entrer un autre." ."</p>";
										}
										elseif (strpos($fullUrl, "emailInvalide") == true) {
											echo "<p style='color:red;'>". "Adresse email déja utilisée. Veuillez en entrer une autre." ."</p>";
										}
										elseif (strpos($fullUrl, "success") == true) {
											echo "<p style='color:green;'>". "Inscription réussie" ."</p>";
										}
										 ?>
							 </center>
	</body>
</html>
