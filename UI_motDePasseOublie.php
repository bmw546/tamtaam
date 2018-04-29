
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
********************************************************-->

<html>
    <head>
        <meta charset="utf-8" />
        <title>Mot de passe oublié</title>
    </head>
    <body style="margin:auto; width:950px;">
    <header>
        <h1 style="text-align:center;"><i>Récuperer votre mot de passe</i></h1>
    </header>
        <fieldset>
            <form action="CtrlMotDePasseOublie.php" method="post">
                <p>
                    <label for="email">Entrez votre adresse email</label>
                    <input type="text" name="email" id="email" required/>
                </p>
                <p>
                    <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="envoi" type="submit" value="Envoyer"/>
                    <button formnovalidate style=" margin-left:25%; margin-right:100px; background-color:black; color:white; border-color:black;" name="cancel" type="reset" value="Annuler">Annuler</button>
                </p>
            </form>
            <center>
            <?php
              $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              if (strpos($fullUrl, "emailInvalide") == true) {
                echo "Adresse email non valide";
              }
              elseif (strpos($fullUrl, "emailEnvoye") == true) {
                echo "Votre mot de passe a été envoyé à votre adresse email";
              }
             ?>
           </center>
        </fieldset>

    </body>
</html>
