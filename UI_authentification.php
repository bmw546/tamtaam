<!--
/****************************************
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
****************************************/
-->
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>
    </head>
    <body style="margin:auto; width:950px;">
    <header>
        <h1 style="text-align:center;"><i>Connexion</i></h1>
    </header>
        <fieldset>
            <form action="CtrlAuthentification.php" method="post">
                <p>
                    <label for="nom_utilisateur">Nom d'utilisateur: </label>
                    <input type="text" name="nom_utilisateur" id="nom_utilisateur" required/>
                </p>
                <p>
                  <label for="mot_de_passe">Mot de passe: </label>
                  <input style="margin-left:25px;" type="password" name="mot_de_passe" id="mot_de_passe" required/>
                </p>
                <p>
                    <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="connexion" type="submit" value="Se connecter"/>
                    <button formnovalidate style=" margin-left:25%; margin-right:100px; background-color:black; color:white; border-color:black;" name="cancel" type="reset" value="Annuler">Annuler</button>
                </p>
            </form>
            <center>
            <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "nomUtilisateurInvalide") == true) {
              echo "<p style='color:red;'>". "Nom d'utilisateur invalide" ."</p>";
            }
            /*elseif (strpos($fullUrl, "success") == true) {
              echo "<p style='color:green;'>". "Authentification réussie" ."</p>";
            }*/
            elseif (strpos($fullUrl, "mdpInvalide") == true) {
              echo "<p style='color:red;'>". "Mot de passe invalide" ."</p>";
            }
             ?>
           </center>
             <br>
             <a style=" margin-left:90px; width:30%; display:block;float:left;" href="UI_Inscription.php">Créer un compte</a>
             <a style="width:30%; display:block;float:left;" href="UI_motDePasseOublie.php">Mot de passe oublié</a>
             <a style="width:30%; display:block;float:left;" href="UI_nomUtilisateurOublie.php">Nom d'utilisateur oublié</a>
        </fieldset>

    </body>

</html>
