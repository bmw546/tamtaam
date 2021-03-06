<!--*****************************************************************************************************
Fichier : UI_authentification.php
Auteur :  Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Interface qui ser à authentifier un utilisateur au système (interface d'utilisateur)

Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Joel Lapointe         Oui


Historique de modifications :
Date               Nom                   Description
===========================================================
2018-04-25		    Roméo			Ajout de commentaire, ajout des "required"
2018-05-01          Roméo          Implémenté CSS
******************************************************************************************************-->
<html class="transition apparaitreVersGauche">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/pageTransition.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <title>Connexion</title>
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
    <div class="inscriptionheader"><i>Connexion des utilisateurs</i></div>
    <fieldset>
        <form class="formInscription" action="CtrlAuthentification.php" method="post">

            <div class="centerForm">
                <p >
                    <label class="label" for="nom_utilisateur">Nom d'utilisateur: </label>
                    <input type="text" name="nom_utilisateur" id="nom_utilisateur" required/>
                </p>
                <br>
                <p>
                    <label class="label" for="mot_de_passe">Mot de passe: </label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required/>
                </p>
                <br><br>

                <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if (strpos($fullUrl, "nomUtilisateurInvalide") == true) {
                    echo "<p class='msg redText'>". "Nom d'utilisateur invalide" ."</p>";
                }
                elseif (strpos($fullUrl, "mdpInvalide") == true) {
                    echo "<p class='msg redText'>". "Mot de passe invalide" ."</p>";
                }
                ?>

                <p class="col-12">
                    <input  class="btnInscrire btnStyle " name="connexion" type="submit" value="Se connecter"/>
                    <button class="btnInscrire btnStyle" onclick="location.href='menu.php'" type="button"> Annuler</button>
                </p>
                <br><br>
            </div>
        </form>
        <footer class="inscriptionFooter">
            <br>
            <a class="col-4 col-m-4" href="UI_Inscription.php">Créer un compte</a>
            <a class="col-4 col-m-4" href="UI_motDePasseOublie.php">Mot de passe oublié</a>
            <a class="col-4 col-m-4" href="UI_nomUtilisateurOublie.php">Nom d'utilisateur oublié</a>
        </footer>
    </fieldset>
</section>

</body>

</html>
