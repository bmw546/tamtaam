<?php
/*****************************************************************
Fichier : GestionnaireCourrielNotification.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert a faire les demande a la base de donnée pour ajouter/modifier
                la banque de notification.
Date : 2018-04-25

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Rémi Létourneau       Oui


Historique de modifications :
Date               Nom                   Description
===========================================================
 *****************************************************************/
include_once("MoteurRequeteBD.php");
class CourrielNotification {

    /**
     * @param $courriel String Le courriel du client
     * @param $telephone integer Le numéro de telephone du client
     * @param $sms String le message texte
     * @param $notification String le message notifier
     */
    function chercher_si_existe($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = "SELECT * FROM `notification` WHERE ( `courriel` = \"".$courriel."\" )";
        $result = $bd->execution_avec_return($sql);
        if ($result != null){
            $this->modifier($courriel,$telephone,$sms,$notification);
        }
        else{
            $this->ajouter($courriel,$telephone,$sms,$notification);
        }
    }

    /**
     * @param $courriel String Le courriel du client
     * @param $telephone integer Le numéro de telephone du client
     * @param $sms String le message texte
     * @param $notification String le message notifier
     */
    function modifier($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = ("UPDATE `notification` SET `courriel` = \"".$courriel."\" , `telephone` =".$telephone." , `sms` = \"".$sms."\" , `notification` =\"".$notification."\" WHERE `courriel`  =\"".$courriel."\" AND `telephone` =".$telephone." ");
        $result = $bd->execution($sql);
    }

    /**
     * @param $courriel String Le courriel du client
     * @param $telephone integer Le numéro de telephone du client
     * @param $sms String le message texte
     * @param $notification String le message notifier
     */
    function ajouter($courriel,$telephone,$sms,$notification){
        $bd = new Connexion();
        $sql = ("INSERT INTO  `notification`(`courriel`, `telephone`, `sms`, `notification`) VALUES (\"".$courriel."\" , \"".$telephone."\" , \"".$sms."\" , \"".$notification."\")");
        $result = $bd->execution($sql);
    }
}
?>