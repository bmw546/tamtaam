<?php
/*****************************************************************
Fichier : GestionnaireCourrielNotification.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert a faire les demande a la base de donnée pour ajouter/modifier
 la banque de notification
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================



Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/
include_once ("connection.php");
class CourrielNotification{

    function chercher_si_existe($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = "SELECT * FROM `notification` WHERE ( `courriel` == \" ".$courriel." \" )";
        $result = $bd->execution_avec_return($sql);
        echo "le résulta est :";
        echo $result;
        if ($result != null){
            $this->modifier($courriel,$telephone,$sms,$notification);
            echo "you exist";

        }
        else{
            $this->ajouter($courriel,$telephone,$sms,$notification);
            echo "you actually do not exist";
        }
    }
    function modifier($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = ("UPDATE `notification` SET `courriel` = \"".$courriel."\" , `telephone` =".$telephone." , `sms` = \"".$sms."\" , `notification` \"=".$notification."\" WHERE `courriel`  =\"".$courriel."\"'' AND `telephone` =".$telephone." ");
        $result = $bd->execution_avec_return($sql);
        echo $result;
        echo $sql;
    }
    function ajouter($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = ("INSERT INTO  `notification`(`courriel`, `telephone`, `sms`, `notification`) VALUES (\"".$courriel."\" , \"".$telephone."\" , \"".$sms."\" , \"".$notification."\")");
        $result = $bd->execution($sql);
    }
}



?>