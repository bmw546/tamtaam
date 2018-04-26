<?php
/*****************************************************************
Fichier : CtrlSuggestions.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
                 et de les formatter et envoyer a la fonction
                 envoyer une email.
Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
===========================================================



Historique de modifications :
Date               Nom                   Description
===========================================================
2018-04-25		Marc-Étienne			Ajoute de commentaire

 *****************************************************************/

    include("GestionnaireCourriel.php");

    $Email = new GestionnaireCourriel();
    /*
    echo "<p>".$_POST['nom']."</p>".
         "<p>".$_POST['courriel']."</p>".
         "<p>".$_POST['sujet']."</p>".
         "<p>".$_POST['question']."</p>"
    */
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $sujet = $_POST['sujet'];
    $question = $_POST['question'];
    $Email->sentMail($nom,$courriel,$sujet,$question);

?>