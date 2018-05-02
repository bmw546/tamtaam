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
    <title>Formulaire &eacute;leve</title>
</head>
<body style="margin:auto; width:950px;">
<header>
    <h1 style="text-align:center;"><i>Commentaire et inscription</i></h1>
</header>
<fieldset>

    <form action="CtrlSuggestions.php" method="post">
        <p>
            <label for="nom">Nom: </label>
            <?php
            require_once 'utilisateur.php';
            session_start();

            if (isset($_SESSION['utilisateur'])){
                $usr = unserialize($_SESSION['utilisateur']);
                $nom = $usr->getNomUtilisateur();
                ?>
                <input type="text" name="nom" id="nom" size="30" value="<?php echo $nom ?>" disabled="disabled"/>
                <?php
            }
            else{
                ?> <input type="text" name="nom" id="nom" size="30" required/><?php
            }?>
        </p>
        <p>
            <label for="courriel">Courriel: </label>
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
        <p>
            <label for="sujet">Sujet: </label>
            <input type="text" name="sujet" id="sujet" required/>
        </p>
        <p>
        <p for="commentaire">Commentaire/suggestion: </p>
        <textarea name="question" rows="10" cols="30" id="question" required/> </textarea>
        </p>
        <p>
            <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="Envoyer" type="submit" value="Envoyer"/>
            <button formnovalidate style=" margin-left:25%; margin-right:100px; background-color:black; color:white; border-color:black;" name="cancel" value="Annuler">Annuler</button>

        </p>
    </form>
</fieldset>
</body>

</html>
