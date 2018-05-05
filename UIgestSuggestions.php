<!DOCTYPE html>
<!--/****************************************************************************
Fichier : UIgestSuggestions.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert a envoyé des commentaires (interface d'utilisateur)
Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
=================================================================================
2018-04-29         Joel Lapointe         Oui


Historique de modifications :
Date               Nom                   Description
==================================================================================
2018-04-25	   Marc-Étienne			Ajoute de commentaire, ajout des "required"
2018-04-25     Roméo                   Ajouter formnovalidate pou le bouton annuler
2018-05-02     Roméo                  Implémenté les infos du user authentifié
*******************************************************************************/-->
<html>
<head>
    <meta charset="utf-8" />
    <title>Commentaire et inscription</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="inscriptionBody" onload="updateDate(dateAujourdhui())">
<nav class="entete col-12">
    <img src="HTML/image/logo.png" alt="logo"/>
    <ul>
        <li class="menu col-2 col-t-2"><a href="#">Accueil</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nos produits</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">En savoir plus</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Points de ventes</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nous joindre</a></li>
    </ul>
</nav>
    <div>
        <header class="inscriptionheader" >
            <h1 style="text-align:center;"><i>Commentaire et inscription</i></h1>
        </header>
        <fieldset class="adapt">

            <form  class="centerForm formInscription"  action="CtrlSuggestions.php" method="post">
                <br>
                <p class="label">
                    <br>
                    <label class="label" for="nom">Nom: </label>
                    <?php
                    require_once 'utilisateur.php';
                    session_start();

                    if (isset($_SESSION['utilisateur'])){
                        $usr = unserialize($_SESSION['utilisateur']);
                        $nom = $usr->getNomUtilisateur();
                        ?>
                        <input type="text" name="nom" id="nom" value="<?php echo $nom ?>" disabled="disabled"/>
                        <?php
                    }
                    else{
                        ?> <input type="text" name="nom" id="nom" required/><?php
                    }?>
                </p>
                <br><br>
                <p class="label">
                    <label class="label" for="courriel">Courriel: </label>
                    <?php
                    if (isset($_SESSION['utilisateur'])) {
                        $usr = unserialize($_SESSION['utilisateur']);
                        $email = $usr->getEmail();  ?>
                        <input type="text" name="courriel" id="courriel" required
                               value="<?php echo $email ?>" disabled="disabled"/>

                        <?php
                    }
                    else{
                        ?><input type="text" name="courriel" id="courriel" required/><?php
                    }?>
                </p>
                <br><br>
                <p class="label">
                    <label class="label" for="sujet">Sujet: </label>
                    <input type="text" name="sujet" id="sujet" required/>
                </p>
                <br><br>
                <br><br>
                <p class="label" for="commentaire">Commentaire/suggestion: </p>
                <textarea name="question" rows="10" cols="30" id="question" required/> </textarea>
                </p>
                <p style=" margin-top: 25px;">
                    <input  class="label" style=" background-color:black; color:white; border-color:black;" name="Envoyer" type="submit" value="Envoyer"/>
                    <button formnovalidate class="label" style="  background-color:black; color:white; border-color:black;" name="cancel" value="Annuler">Annuler</button>

                </p>
                <button  class="btnInscrire btnStyle" onclick="location.href='HTML/menu.php'" type="button"">Retour au menu</button>
            </form>

        </fieldset>
    </div>
</body>

</html>
