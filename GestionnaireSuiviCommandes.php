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
  require_once 'MoteurRequeteBD.php';

class GestionnaireSuiviCommandes{

  private $uneCommande;
  private $connexion;


  public function __construct($nomClient){
      $this->connexion   = new Connexion;
      $result = array();
      $query  = "SELECT commande.id_commande, livraison.adresse, livraison.date_livraison_prevue, etat_commande.nom_etat FROM commande JOIN client ON commande.id_client=client.id_client JOIN livraison ON commande.id_commande=livraison.id_commande JOIN etat_commande ON commande.id_etat=etat_commande.id_etat WHERE client.nom_utilisateur = '$nomClient'";
      $result = $this->connexion->execution_avec_return($query);

      if (sizeof($result)>0) {
          $resultComm = array();
          $resultComm=end($result);
          //end($resultComm);
          $numeroCommande = current($resultComm);
          next($resultComm);
          next($resultComm);
          $adresse = current($resultComm);
          next($resultComm);
          next($resultComm);
          $date = current($resultComm);
          next($resultComm);
          next($resultComm);
          $etat = current($resultComm);




    }


      $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, 30, $etat,"");
  }

  public function getUneCommande(){
      return $this->uneCommande;
  }

}
?>
