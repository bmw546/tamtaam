<!--******************************************************
Fichier : UI_modifierUtilisateur.php
Auteur : Roméo
Fonctionnalité : Modifier les infos d'un utilisateur authentifié (basé sur UI_inscription.php)
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
    <link rel="stylesheet" href="HTML/css/pageTransition.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <title>Modifier les infos du compte</title>
</head>

<body class="inscriptionBody">

<nav class="entete col-12">
    <img  src="HTML/image/logo.png" alt="logo"/>
    <ul>
        <li class="menu col-2 col-t-2"><a href="https://tamtaam.com/">Accueil</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
    </ul>
</nav>

<section class="sectionInscription col-12">
    <div class="inscriptionheader"><i>Modifier votre compte</i></div>
    <form  class="centerForm formInscription" action="CtrlModifierUtilisateur.php" method="post">
        <!--------------------------Informations du client------------------------>
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

            <br>
            <label class="label" for="user" ><b>Nom d'utilisateur :</b></label>
            <input class="" type="text" name="user" id="user" size="36" value="<?php echo $nom ?>" required/>

            <br><br>
            <label class="label" for="adresse" id="lAdresse"><b>Adresse complète:</b></label>
            <input class="" type="text" name="adresse" id="adresse" value="<?php echo $adr ?>" size="36" required
                   onblur="check('adresse', 'lAdresse', /((([0-9]+))(\w+(\s\w+){2,})(,)?(\s{0,})([a-z]{0,})(\s{0,})(,)?(\s{0,})([a-z]{0,})(,)?(\s)([a-z][0-9][a-z] ?[0-9][a-z][0-9])|(([a-z][0-9][a-z])-([0-9][a-z][0-9]))|([a-z][0-9][a-z][0-9][a-z][0-9]))/i)"/>

            <br><br>
            <label class="label" for="email" id="lemail"><b>E-mail :</b></label>
            <input class="" type="text" name="email" id="email" value="<?php echo $email ?>" size="36" required
                   onblur="check('email', 'lemail', /([a-z0-9\.-_]+)@([a-z0-9]+)\.([a-z]{2,})|(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/i)"/>

            <br><br>
            <label class="label" for="noTelephone" id="lNoTelephone"><b>Numéro de téléphone :</b></label>
            <input class="" type="text" name="noTelephone" id="noTelephone" value="<?php echo $tel ?>" size="36" required
                   onblur="check('noTelephone', 'lNoTelephone', /(\(?[0-9]{3}\)?)? ?\.?-?[0-9]{3}\.?-?[0-9]{4}/)"/>

            <!-----------------------------Champs Mot de passe et confirmation----------------------->
            <br><br>
            <label class="label" for="passwd" ><b>Mot de passe :</b></label>
            <input class="" type="password" name="passwd" id="passwd" size="36" value="<?php echo $passwd ?>" required/>

            <br><br>
            <label class="label" for="confirmer" ><b>Confirmer votre mot de passe :</b></label>
            <input class="" type="password" name="confirmer" id="confirmer" size="36" value="<?php echo $passwd ?>" required/>
            <br><br>

            <!-------------------- Validation anti-robot captcha------------------------------>
            <p><img src="verif_code_gen.php" alt="Code de vérification" /></p>
            <br>
            <label for="verif_code">Merci de retaper le code de l'image ci-dessus :</label>
            <input type="text" name="verif_code" id="verif_code"/>
            <br>

            <!-------------------------------Bouton inscrire et annuler ------------------------>
        <?php }else{echo "Vous n'êtes pas connecté"; echo "<br>";} ?>
        <input class="btnInscrire btnStyle " name="modifier" id="btnModifier" type="submit" value="Modifier"/>
        <button class="btnInscrire btnStyle " type="reset" name="cancel" value="Annuler">Réinitialiser</button>
        <button  class="btnInscrire btnStyle" onclick="location.href='HTML/menu.php'" type="button">Retour</button>

        <!-- message qui indique l'état de l'inscription -->
        <div class="inscriptionFooter">
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
            elseif (strpos($fullUrl, "mauvais") == true) {
                echo "<p class='redText'>". "Votre code de confirmation n'est pas bon ! Merci de réessayer." ."</p>";
            }
            elseif (strpos($fullUrl, "nothing") == true) {
                echo "<p class='redText'>". "Vous devez remplir le champ du code de confirmation !" ."</p>";
            }
            ?>
        </div>
    </form>
</section>
</body>
</html>

<script>
    /**
     * valide les informations des champs d'un formulaire
     * @param who string  le nom de l'id du champ
     * @param label l'étiquette associé au champs
     * @param myRegex l'expression regex pour valider un champ
     */
    function check(who, label, myRegex){

        var value;
        value = document.getElementById((who)).value;
        if(!myRegex.test(value)){
            document.getElementById(label).style.color = 'red';
            document.getElementById(who).select();
        }
        else{
            document.getElementById(label).style.color = 'black';
        }
    }
</script>
