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
2018-04-29         Rémi Létourneau       Oui


Historique de modifications :
Date               Nom                   Description
===========================================================
2018-04-25		Marc-Étienne			Ajoute de commentaire

 *****************************************************************/

    include("GestionnaireCourriel.php");

    $Email = new GestionnaireCourriel();

    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $sujet = $_POST['sujet'];
    $question = $_POST['question'];

    $Email->sentMail($nom,$courriel,$sujet,$question);
?>