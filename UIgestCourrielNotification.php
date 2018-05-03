<!DOCTYPE html>
<!--******************************************************
Fichier : UIgestCourrielNotification.php
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
2018-05-03          Roméo              Ajouté l'email de l'utilisateur authentifié
********************************************************-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des courriels et des notifications</title>
</head>
<body style="margin:auto; width:950px;">
<header>
    <h1 style="text-align:center;"><i>Gestion des courriels/Notifications</i></h1>
</header>

<form action="CtrlCourrielNotification.php" method="post" style="padding:20px; border:solid black;">
    <br>

    <label for="email" style="padding-right:122px;"><b>Courriel :</b></label>
    <?php
    require_once 'utilisateur.php';
    session_start();

    if (isset($_SESSION['utilisateur'])){
        $usr = unserialize($_SESSION['utilisateur']);
        $email = $usr->getEmail();
        ?> <input type="text" name="email" id="email" size="30" value="<?php echo $email ?>" disabled="disabled" required/>  <?php
    }
    else{
        ?> <input type="text" name="email" id="email" size="30" required/> <?php
    }

    ?>


    <br><br>
    <label style="padding-right:10px;"><b>Activer les notifications par courriel :</b></label>
    <input type="radio" name="notification" value="oui" required/>Oui
    <input type="radio" name="notification" value="non" required/>Non

    <br><br>
    <label style="padding-right:31px;"><b>Activer les notifications par SMS :</b></label>
    <input type="radio" name="sms" value="oui" required/>Oui
    <input type="radio" name="sms" value="non" required/>Non

    <!--************************ champs numéro de téléphone ***********************-->
    <br><br>
    <label for="noTelephone" style="padding-right:115px;"><b>Numéro de téléphone :</b></label>
    <input type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="30" required/>
    <!--****************************************************************************-->

    <br><br>
    <label ><b>Type de notification :</b></label>
    <input style="margin-left:89px;" type="checkbox" name="type" value="1" required/>Nouvelles et nouveautés <br>
    <input style="margin-left:238px;" type="checkbox" name="type" value="2" required/>Réception de commande <br>
    <input style="margin-left:238px;" type="checkbox" name="type" value="3" required/>Changement sur l'état de la livraison



    <br><br>
    <input  style="margin-left:80px; margin-right:100px; background-color:black; color:white; border-color:black;" name="modifier" type="submit" value="Modifier"/>
    <button style="background-color:black; color:white; border-color:black;" type="reset" name="cancel" value="Annuler">Annuler</button>
</form>
</body>
</html>