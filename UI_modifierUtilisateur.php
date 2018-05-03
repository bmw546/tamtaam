<!--******************************************************
Fichier : UI_modifierUtilisateur.php
Auteur : Roméo
Fonctionnalité : Modifier les infos d'un utilisateur authentifié
Date : 2018-05-02

Vérification :
Date                Nom 		          Approuvé
=========================================================

Historique de modifications :
Date                    Nom             Description
=========================================================

***********************************************************-->
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="HTML/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <title>Modifier votre compte</title>
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
    <div class="inscriptionheader"><i>Modifier votre compte</i></div>
    <form class="centerForm formInscription" action="CtrlModifierUtilisateur.php" method="post">
        <br>
        <?php
        require_once 'utilisateur.php';
        session_start();
        if (isset($_SESSION['utilisateur'])){
            $usr = unserialize($_SESSION['utilisateur']);
            $nom = $usr->getNomUtilisateur();
            $adr = $usr->getAdresse();
            $email = $usr->getEmail();
            $tel = $usr->getTelephone();
            $passwd = $usr->getMotDePasse(); ?>

            <label class="label" for="user" ><b>Nom d'utilisateur :</b></label>
            <input class="" required type="text" name="user" id="user" size="30" value="<?php echo $nom ?>"/>

            <br><br>
            <label class="label" for="adresse" ><b>Adresse :</b></label>
            <input class="" required type="text" name="adresse" id="adresse" size="30"  value="<?php echo $adr ?>"/>

            <br><br>
            <label class="label" for="email" ><b>E-mail :</b></label>
            <input class="" required type="text" name="email" id="email" size="30"  value="<?php echo $email ?>"/>

            <br><br>
            <label class="label" for="noTelephone" ><b>Numéro de téléphone :</b></label>
            <input class="" required type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="30"  value="<?php echo $tel ?>"/>

            <br><br>
            <label class="label" for="passwd" ><b>Mot de passe :</b></label>
            <input class="" required type="password" name="passwd" id="passwd" size="30"  value="<?php echo $passwd ?>">

            <br><br>
            <label class="label" for="confirmer" ><b>Confirmer votre mot de passe :</b></label>
            <input class="" required type="password" name="confirmer" id="confirmer" size="30" value="<?php echo $passwd; ?>"

            <br><br>
            <!-- (Remi nouvelle fonction : captcha dans Inscription) -->
            <input class="btnInscrire btnStyle " name="modifier" type="submit" value="Modifier"/>
        <?php }else{echo "Vous n'êtes pas connecté"; echo "<br>";} ?>
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
            echo "<p class='greenText'>". "Votre compte a été modifié." ."</p>";
        }
        ?>
    </div>
</footer>
</body>
</html>
