<!--****************************************
Fichier : GestionnaireSuiviDeCommandes.php
Auteur : Benoit Audette-Chavigny
Fonctionnalité : Gestion des demandes et suivi de livraison
Date : 2018-04-25

Vérification :
Date                    Nom 		    Approuvé
=========================================================

Historique de modifications :
Date                    Nom             Description
=========================================================

***********************************************-->
<?php
  require_once 'commande.php';

class GestionnaireSuiviCommandes{

  private $uneCommande;

  public function __construct($numeroCommande, $nomClient, $adresse, $date, $montant, $etat,$type){
      $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat,$type);
  }

  public function getUneCommande(){
      return $this->uneCommande;
  }

}
?>
