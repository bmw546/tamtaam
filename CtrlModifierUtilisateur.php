<?php

//va devoir exclure son propre courriel/nom d'utilisateur pour les messages d'erreurs, sinon marche pas
require_once 'GestionnaireUtilisateur.php';

if (isset($_POST['modifier'])) {

    //si l'adresse email/nom d'utilisateur entré ne sont pas celle de l'utilisateurs et sont déjà dans la bd et on retourn à la page
    //UI_modifierUtilisateur avec un message d'erreur
    if (){

    }
    //sinon on modifie les nouvelles infos dans la variables de la session/bd et on va au menu
    else{
        //fonction modifier dans la classe GestionUtilisateurs (modifie dans la bd + objet + modifier $_SESSION['utilisateur'] pour l'utilisateur modifié
    }

    /*$manager = new GestionnaireUtilisateur($_POST['user'], $_POST['passwd'], $_POST['email'], $_POST['adresse'], $_POST['noTelephone']);
    $manager->ajouterUtilisateur();
    $msg = $manager->getEtat();
    header("Location: UI_Inscription.php?$msg");*/
}

?>