<?php
/****************************************
Fichier : inscription.php
Auteur : Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================
2018-04-29							Roméo        Oui
Historique de modifications :
Date                    Nom             Description
=========================================================
2018-04-29							Roméo           Ajouté l'envoie de messages d'erreurs/succès
***********************************************/
require_once 'GestionnaireUtilisateur.php';

if (isset($_POST['inscrire'])) {
    session_start();
    //si le champ du code de confirmation a été rempli
    if(IsSet($_POST['verif_code']) AND !Empty($_POST['verif_code'])){
       if($_POST['verif_code']==$_SESSION['aleat_nbr']){
           //le bon nombre a été entrée
           $manager = new GestionnaireUtilisateur($_POST['user'], $_POST['passwd'], $_POST['email'], $_POST['adresse'], $_POST['noTelephone']);
           $manager->ajouterUtilisateur();
           $msg = $manager->getEtat();
           header("Location: UI_Inscription.php?$msg");
       }
       else{
           $msg = 'mauvais';
           header("Location: UI_Inscription.php?$msg");
       }
    }
    else{
        $msg = 'nothing';
        header("Location: UI_Inscription.php?$msg");
    }


}
?>
