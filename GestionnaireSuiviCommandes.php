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
  require_once 'connection.php';

class GestionnaireSuiviCommandes{

  private $uneCommande;
  private $connexion;


  public function __construct($nomClient){
      $this->connexion   = new Connexion;

      $query  = "SELECT commande.id_commande, livraison.adresse, livraison.date_livraison_prevue, etat_commande.nom_etat FROM commande JOIN client ON commande.id_client=client.id_client JOIN livraison ON commande.id_commande=livraison.id_commande JOIN etat_commande ON commande.id_etat=etat_commande.id_etat WHERE client.nom_utilisateur = '$nomClient'";
      $result = $this->connexion->execute($query);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

          $numeroCommande = $row["id_commande"];
          $adresse = $row["adresse"];
          $date = $row["date_livraison_prevue"];
          $etat = $row["nom_etat"];

      }
    }


      $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, 30, $etat,"");
  }

  public function getUneCommande(){
      return $this->uneCommande;
  }

}
?>
