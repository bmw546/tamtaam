<!DOCTYPE html>
<!--******************************************************
Fichier : UIgestCourrielNotification.html
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des courriels et des notifications
Date : 2018-04-25

Vérification :
Date                    Nom 		    Approuvé
=========================================================
2018-04-29         Joel Lapointe         Oui

Historique de modifications :
Date                    Nom             Description
=========================================================
2018-04-25			Marc-Étienne 		Prendre la reléve sur ce projet
2018-05-05         Roméo               Enlevé php inutile, modifié bouton retour au menu
2018-05-05         Rémi                correction style css
********************************************************-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des courriels et des notifications</title>
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    </head>

    <body class="inscriptionBody">
        <nav class="entete col-12 col-t-12">
            <img  src="image/logo.png" alt="logo"/>
            <ul>
                <li class="menu ccol-1 col-3 col-t-1 col-t-3"><a href="https://tamtaam.com/">Accueil</a></li>
                <li class="pointMenu menu col-1 col-3 col-t-1 col-t-3"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
                <li class="pointMenu menu col-1 col-3 col-t-1 col-t-3"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
                <li class="pointMenu menu col-1 col-3 col-t-1 col-t-3"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
                <li class="pointMenu menu col-1 col-3 col-t-1 col-t-3"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
            </ul>
        </nav>

        <header>
            <div class="inscriptionheader"><i>Gestion des courriels/Notifications</i></div>
        </header>

        <form class="centerForm formInscription " action="CtrlCourrielNotification.php" method="post">
            <br>
            <label class="labelGrand" for="email" ><b>Courriel de l'utilisateur :</b></label>
            <?php
                session_start();
                require_once 'utilisateur.php';
                if (isset($_SESSION['utilisateur'])) {
                    $usr = unserialize($_SESSION['utilisateur']);
                    $email = $usr->getEmail();
            ?>
                <input type="text" name="email" id="email" size="33" required
                       value="<?php echo $email ?>" disabled="disabled"/>
            <?php
                }
                else{
            ?>
                <input type="text" name="email" id="email" size="30" required/>
            <?php
            }
            ?>

            <br><br>
            <label class="labelGrand">Activer les notifications par courriel :</label>
            <input type="radio" name="notification" id="yes" value="oui" required/><label for="yes">Oui</label>
            <input type="radio" name="notification" id="no" value="non" required/><label for="no">Non</label>

            <br><br>
            <label class="labelGrand">Activer les notifications par SMS :</label>
            <input type="radio" name="sms" id="radioYes" value="oui" required/><label for="radioYes">Oui</label>
            <input type="radio" name="sms" id="radioNo" value="non" required/><label for="radioNo">Non</label>

            <!--************************ champs numéro de téléphone ***********************-->
            <br><br>
            <label class="labelGrand" for="noTelephone">Numéro de téléphone :</label>
            <input type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="24" required/>
            <!--****************************************************************************-->

            <br><br>
            <label class="labelGrand">Type de notification :</label>
            <input type="checkbox"  value="1" name="nouveau" id="nouveau"><label for="nouveau">Nouvelles et nouveautés</label><br>
            <input class="checkBoxAlign" type="checkbox"  value="2" name ="reception" id="reception"><label for="reception">Réception de commande</label><br>
            <input class="checkBoxAlign" type="checkbox"  value="3" name="etat" id="etat"><label for="etat">Changement sur l'état de la livraison</label>

            <br><br>
            <input class="btnInscrire btnStyle" name="modifier" type="submit" value="Modifier"/>
            <button class="btnInscrire btnStyle" type="reset" name="cancel" value="cancel">Effacer</button>
            <button class="btnInscrire btnStyle" onclick="location.href='menu.php'" type="button">Retour au menu</button>

            <div class="inscriptionFooter">
                <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if (strpos($fullUrl, "success") == true) {
                    echo "<p class='greenText'>". "Modification réussie" ."</p>";
                }
                elseif (strpos($fullUrl, "noConnect") == true) {
                    echo "<p class='redText'>". "Vous n'êtes pas connecté." ."</p>";
                }
                ?>
            </div>
        </form>

    </body>
</html>