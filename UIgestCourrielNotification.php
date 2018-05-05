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
2018-05-05         Roméo               Enlvé php inutile, modifié bouton retour au menu
********************************************************-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des courriels et des notifications</title>
    <link rel="stylesheet" href="css/style.css" />
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
            <h1 style="text-align:center;"><i>Gestion des courriels/Notifications</i></h1>
        </header>

        <form class="centerForm formInscription adapt"  action="CtrlCourrielNotification.php" method="post" style="padding:20px; border:solid black;">
            <?php
                $id_client = $_POST['id_client'];
                echo '<input type="hidden" name="id_client" id="id_client" value="$id_client">';
            ?>
            <br>
            <label for="email" style="padding-right:122px;"><b>Courriel :</b></label>
            <input type="text" name="email" id="email" size="30" required/>

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
            <input style="margin-left:89px;" type="checkbox" name="type" value="1" id="nouveau" required/>Nouvelles et nouveautés <br>
            <input style="margin-left:238px;" type="checkbox" name="type" value="2" id="reception" required/>Réception de commande <br>
            <input style="margin-left:238px;" type="checkbox" name="type" value="3" id="etat" required/>Changement sur l'état de la livraison



            <br><br>
            <input  style="margin-left:80px; margin-right:100px; background-color:black; color:white; border-color:black;" name="modifier" type="submit" value="Modifier"/>
            <button style="background-color:black; color:white; border-color:black;" type="reset" name="cancel" value="Annuler">Annuler</button>
        </form>
        <form class="centerForm formInscription adapt"  action="HTML/menu.php" method="post" style="padding:20px; border:solid black;">
            <?php
            $id_client = $_POST['id_client'];
            echo '<input type="hidden" name="id_client" id="id_client" value="$id_client">';
            ?>
            <input  style="margin-left:80px; margin-right:100px; background-color:black; color:white; border-color:black;" name="modifier" type="submit" value="Retour au menu"/>
        </form>
    </body>
=======
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
    <h1 style="text-align:center;"><i>Gestion des courriels/Notifications</i></h1>
</header>

<form class="centerForm formInscription adapt"  action="CtrlCourrielNotification.php" method="post" style="padding:20px; border:solid black;">
    <br>
    <label for="email" style="padding-right:122px;"><b>Courriel :</b></label>
    <?php
    session_start();
    require_once 'utilisateur.php';
    if (isset($_SESSION['utilisateur'])) {
        $usr = unserialize($_SESSION['utilisateur']);
        $email = $usr->getEmail();  ?>
        <input type="text" name="email" id="email" required
               value="<?php echo $email ?>" disabled="disabled"/>

        <?php
    }
    else{
        ?> <input type="text" name="email" id="email" size="30" required/><?php
    }?>

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
    <input style="margin-left:89px;  "type="checkbox"  value="1" name="nouveau"    id="nouveau">Nouvelles et nouveautés <br>
    <input style="margin-left:238px; "type="checkbox"  value="2" name ="reception" id="reception">Réception de commande <br>
    <input style="margin-left:238px; "type="checkbox"  value="3" name="etat"       id="etat">Changement sur l'état de la livraison



    <br><br>
    <input   class="btnInscrire btnStyle" name="modifier" type="submit" value="Modifier"/>
    <button  class="btnInscrire btnStyle" type="reset" name="cancel" value="Annuler">Annuler</button>
    <button  class="btnInscrire btnStyle" onclick="location.href='menu.php'" type="button"">Retour au menu</button>
</form>

</body>
>>>>>>> e393c00ceeb07997c7ddfe18a4bbea28e2f597ba
</html>