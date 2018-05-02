
<!--******************************************************
Fichier : UI_motDePasseOublie.php
Auteur : Roméo
Fonctionnalité : Interface utilisateur du mot de passe oublié
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================
2018-04-29         Joel Lapointe         Oui
Historique de modifications :
Date                    Nom             Description
=========================================================
2018-05-02              Roméo           Ajouté CSS
********************************************************-->

<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="HTML/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <title>Mot de passe oublié</title>
</head>
<body body class="inscriptionBody">

<nav class="entete col-12">
    <img src="HTML/image/logo.png" alt="logo"/>
    <ul>
        <li class="menu col-2 col-t-2"><a href="#">Accueil</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nos produits</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">En savoir plus</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Points de ventes</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nous joindre</a></li>
    </ul>
</nav>

<section class="sectionInscription col-12">
    <br>
    <div class="inscriptionheader"><i>Récupérer votre mot de passe</i></div>
    <br>
    <fieldset>
        <form class="formInscription" action="CtrlMotDePasseOublie.php" method="post">
            <div class="centerForm">
                <br><br><br>
                <p>
                    <label class="label" for="email">Entrez votre adresse email</label>
                    <input type="text" name="email" id="email" required/>
                </p>
                <p>
                    <input  class="btnInscrire btnStyle" name="envoi" type="submit" value="Envoyer"/>
                    <button class="btnInscrire btnStyle" formnovalidate name="cancel" type="reset" value="Annuler">Annuler</button>
                </p>
            </div>
        </form>
        <footer class="inscriptionFooter">
            <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "emailInvalide") == true) {
                echo  "<p style='color:red;'>". "Adresse email non valide" ."</p>";
            }
            elseif (strpos($fullUrl, "emailEnvoye") == true) {
                echo "<p style='color:green;'>" . "Votre mot de passe a été envoyé à votre adresse email" ."</p>";
            }
            ?>
        </footer>
    </fieldset>
</section>
</body>
</html>
