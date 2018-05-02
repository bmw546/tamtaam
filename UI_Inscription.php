<!--******************************************************
Fichier : UI_Inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                Nom 		          Approuvé
=========================================================
2018-04-29          Joel Lapointe         Oui

Historique de modifications :
Date                    Nom             Description
=========================================================
2018-04-25				Roméo            Modifié textfield pour password pour le champ mot de passe
2018-04-29				Roméo 		     Rajouté les messages d'erreurs/succès
2018-04-30             Rémi             Rajout lien avec css, ajout de style css
2018-05-01             Rémi             Modification style css
***********************************************************-->
<html>
	<head>
		<meta charset="utf-8" />
        <link rel="stylesheet" href="HTML/css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
		<title>Gestion des comptes utilisateurs</title>
	</head>

	<body class="inscriptionBody">


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



        <section class="sectionInscription col-12">
            <div class="inscriptionheader"><i>Inscription des utilisateurs</i></div>
            <form  class="centerForm formInscription" action="CtrlInscription.php" method="post">
                <br>
                <label class="label" for="user" ><b>Nom d'utilisateur :</b></label>
                <input class="" type="text" name="user" id="user" size="30" required/>

                <br><br>
                <label class="label" for="adresse" ><b>Adresse :</b></label>
                <input class="" type="text" name="adresse" id="adresse" size="30" required/>

                <br><br>
                <label class="label" for="email" ><b>E-mail :</b></label>
                <input class="" type="text" name="email" id="email" size="30" required/>

                <br><br>
                <label class="label" for="noTelephone" ><b>Numéro de téléphone :</b></label>
                <input class="" type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="30" required/>

                <br><br>
                <label class="label" for="passwd" ><b>Mot de passe :</b></label>
                <input class="" type="password" name="passwd" id="passwd" size="30" required/>

                <br><br>
                <label class="label" for="confirmer" ><b>Confirmer votre mot de passe :</b></label>
                <input class="" type="password" name="confirmer" id="confirmer" size="30" required/>

                <br>

                <input class="btnInscrire btnStyle " name="inscrire" type="submit" value="S'inscrire"/>
                <button class="btnInscrire btnStyle " type="reset" name="cancel" value="Annuler">Annuler</button>
            </form>
        </section>

        <footer class="inscriptionFooter">
            <div>
                <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if (strpos($fullUrl, "nomUtilisateurInvalide") == true) {
                    echo "<p class='redText'>". "Nom d'utilisateur déja utilisé. Veuillez en entrer un autre." ."</p>";
                }
                elseif (strpos($fullUrl, "emailInvalide") == true) {
                    echo "<p class='redText'>". "Adresse email déja utilisée. Veuillez en entrer une autre." ."</p>";
                }
                elseif (strpos($fullUrl, "success") == true) {
                    echo "<p class='greenText'>". "Inscription réussie" ."</p>";
                }
                ?>
            </div>
        </footer>
	</body>
</html>
