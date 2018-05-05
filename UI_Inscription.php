<!--***************************************************************************************************
Fichier : UI_Inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                Nom 		          Approuvé
=====================================================================================================
2018-04-29          Joel Lapointe         Oui

Historique de modifications :
Date                    Nom             Description
=====================================================================================================
2018-04-25				Roméo            Modifié textfield pour password pour le champ mot de passe
2018-04-29				Roméo 		     Rajouté les messages d'erreurs/succès
2018-04-30             Rémi             Rajout lien avec css, ajout de style css
2018-05-01             Rémi             Modification style css
2018-05-02             Rémi             Ajout nouvelle fonctionnalité (captcha)
2018-05-03             Rémi             Ajout javascript temporaire pour valider les regex.
******************************************************************************************************-->
<html>
	<head>
		<meta charset="utf-8" />
        <link rel="stylesheet" href="HTML/css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
		<title>Gestion des comptes utilisateurs</title>
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
            <div class="inscriptionheader"><i>Inscription des utilisateurs</i></div>
            <form  class="centerForm formInscription" action="CtrlInscription.php" method="post">
                <!--------------------------Informations du client------------------------>
                <br>
                <label class="label" for="user" ><b>Nom d'utilisateur :</b></label>
                <input class="" type="text" name="user" id="user" size="36" required/>

                <br><br>
                <label class="label" for="adresse" id="lAdresse"><b>Adresse complète:</b></label>
                <input class="" type="text" name="adresse" id="adresse" placeholder="32 rue du cegep, Sherbrooke, Qc, J1E 4E2" size="36" required
                       onblur="check('adresse', 'lAdresse', /((([0-9]+))(\w+(\s\w+){2,})(,)?(\s{0,})([a-z]{0,})(\s{0,})(,)?(\s{0,})([a-z]{0,})(,)?(\s)([a-z][0-9][a-z] ?[0-9][a-z][0-9])|(([a-z][0-9][a-z])-([0-9][a-z][0-9]))|([a-z][0-9][a-z][0-9][a-z][0-9]))/i)"/>

                <br><br>
                <label class="label" for="email" id="lemail"><b>E-mail :</b></label>
                <input class="" type="text" name="email" id="email" placeholder="nom@email.com" size="36" required
                       onblur="check('email', 'lemail', /([a-z0-9\.-_]+)@([a-z0-9]+)\.([a-z]{2,})|(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/i)"/>

                <br><br>
                <label class="label" for="noTelephone" id="lNoTelephone"><b>Numéro de téléphone :</b></label>
                <input class="" type="text" name="noTelephone" id="noTelephone" placeholder="000 000 0000" size="36" required
                       onblur="check('noTelephone', 'lNoTelephone', /(\(?[0-9]{3}\)?)? ?\.?-?[0-9]{3}\.?-?[0-9]{4}/)"/>

                <!-----------------------------Champs Mot de passe et confirmation----------------------->
                <br><br>
                <label class="label" for="passwd" ><b>Mot de passe :</b></label>
                <input class="" type="password" name="passwd" id="passwd" size="36" required/>

                <br><br>
                <label class="label" for="confirmer" ><b>Confirmer votre mot de passe :</b></label>
                <input class="" type="password" name="confirmer" id="confirmer" size="36" required/>
                <br><br>

                <!-------------------- Validation anti-robot captcha------------------------------>
                <p><img src="verif_code_gen.php" alt="Code de vérification" /></p>
                <br>
                <label for="verif_code">Merci de retaper le code de l'image ci-dessus :</label>
                <input type="text" name="verif_code" id="verif_code"/>
                <br>

                <!-------------------------------Bouton inscrire et annuler ------------------------>
                <input class="btnInscrire btnStyle " name="inscrire" id="btnInscrire" type="submit" value="S'inscrire"/>
                <button class="btnInscrire btnStyle " type="reset" name="cancel" value="Annuler">Effacer</button>

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
                        echo "<p class='greenText'>". "Inscription réussie" ."</p>";
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
    //pour utiliser dans le formuliare :
    //onblur="check('noTelephone', 'lNoTelephone', /(\(?[0-9]{3}\)?)? ?\.?-?[0-9]{3}\.?-?[0-9]{4}/)"
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
            //a mettre si l'on veut empecher inscrire avec erreur : document.getElementById("btnInscrire").disabled = true; ajouter un parametre pour le bouton
            //alert("ERREUR l'adresse contient des information invalide :"+ value +" veuillez faire comme ceci ex: 475 Rue du Cegep, Sherbrooke, QC J1A 4K1 ");
        }
        else{
            document.getElementById(label).style.color = 'black';
        }
    }
</script>
