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
2018-05-06         Rémi                  Oui


Historique de modifications :
Date               Nom                   Description
===========================================================

 *****************************************************************/
include_once("MoteurRequeteBD.php");
class CourrielNotification{

    /**
     * @param $id_client
     * @param $sms
     * @param $notification
     * @param $nouveau
     * @param $reception
     * @param $etat
     */
    function chercher_si_existe($id_client, $sms, $notification, $nouveau, $reception, $etat){
        $bd = new Connexion();
        $sql = "SELECT * FROM `notification` WHERE ( `id_client` = \"".$id_client."\" )";
        $result = $bd->execution_avec_return($sql);
        if ($result != null){
            $this->modifier($id_client,$sms,$notification,$nouveau,$reception,$etat);
        }
        else{
            $this->ajouter($id_client,$sms,$notification,$nouveau,$reception,$etat);
        }
    }

    function modifier($id_client,$sms,$notification,$nouveau,$reception,$etat){
        $bd = new Connexion();
        $sql = "UPDATE `notification` SET `nouvelle` = '$nouveau', `reception` = '$reception' , `etat` = '$etat', `sms` = '$sms' , `notification` = '$notification' WHERE `id_client`  = $id_client";
        $bd->execution($sql);
    }

    function ajouter($id_client,$sms,$notification,$nouveau,$reception,$etat){
        $bd = new Connexion();
        $sql = "INSERT INTO notification (sms, notification, nouvelle, reception, etat, id_client) VALUES ('$sms', '$notification', '$nouveau', '$reception', '$etat', $id_client)";
        $bd->execution($sql);
    }
}
?>
