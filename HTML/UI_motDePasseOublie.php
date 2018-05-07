
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

<html  class="transition rebondirversBas">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/pageTransition.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <title>Mot de passe oublié</title>
</head>
<body class="inscriptionBody">

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

<section class="sectionInscription col-12">
    <br>
    <div class="inscriptionheader"><i>Récupérer votre mot de passe</i></div>
    <br>
        <form class="formInscription" action="CtrlMotDePasseOublie.php" method="post">
            <div class="centerForm">
                <br><br><br>
                <p>
                    <label class="label" for="email">Entrez votre adresse email</label>
                    <input type="text" name="email" id="email" required/>
                </p>

                <br><br><br>
                <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if (strpos($fullUrl, "emailInvalide") == true) {
                    echo  "<p class='msg redText'>". "Adresse email non valide" ."</p>";
                }
                elseif (strpos($fullUrl, "emailEnvoye") == true) {
                    echo  "<p class='msg greenText' '>" . "Votre mot de passe a été envoyé à votre adresse email" ."</p>";
                }
                ?><br><br>
                <p>
                    <input  class="btnInscrire btnStyle" name="envoi" type="submit" value="Envoyer"/>
                    <button  class="btnInscrire btnStyle" onclick="location.href='UI_authentification.php'" type="button">Annuler</button>
                </p>
            </div>
        </form>
</section>
</body>
</html>
