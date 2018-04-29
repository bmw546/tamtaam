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

  /**
   *  GestionnaireSuiviCommandes constructor.
   * @param $nomClient nom du client
   */
  public function __construct($nomClient){
      $this->connexion   = new Connexion;
      $result = array();
      //SELECT de la plupart des informations
      $query  = "SELECT commande.id_commande, livraison.adresse, livraison.date_livraison_prevue, etat_commande.nom_etat FROM commande JOIN client ON commande.id_client=client.id_client JOIN livraison ON commande.id_commande=livraison.id_commande JOIN etat_commande ON commande.id_etat=etat_commande.id_etat WHERE client.nom_utilisateur = '$nomClient'";
      $result = $this->connexion->execution_avec_return($query);

      if (sizeof($result)>0) {
          $resultComm = array();
          $resultComm=end($result);

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

<<<<<<< HEAD
          //SELECT des informations pour le montant
          $query  = "SELECT `id_produit`, `nb_produit` FROM `ta_produit_commande` WHERE `id_commande` = '$numeroCommande'";
          $result = $this->connexion->execution_avec_return($query);

          $montant = 0;
          //pour chaque produit
          for ($x =0; $x <= sizeof($result); $x++)
        	{
        		$produit = $result[$x];

        		$noProduit = $produit[0];

            $quantite = $produit[1];

            $query  = "SELECT `prix` FROM `produit` WHERE `id_produit` = '$noProduit'";
            $result2 = array();

            $result2 = $this->connexion->execution_avec_return($query);
            //calcul du montant
=======
          $query  = "SELECT `id_produit`, `nb_produit` FROM `ta_produit_commande` WHERE `id_commande` = '$numeroCommande'";
          $result = $this->connexion->execution_avec_return($query);

          $montant = 0;

          for ($x =0; $x <= sizeof($result); $x++)
        	{
        		$produit = $result[$x];

        		$noProduit = $produit[0];

            $quantite = $produit[1];

            $query  = "SELECT `prix` FROM `produit` WHERE `id_produit` = '$noProduit'";
            $result2 = array();

            $result2 = $this->connexion->execution_avec_return($query);

>>>>>>> 261310b22b36d4ad77306e3e2abb94e4fb66d567
            $montant += $result2[0][0]*$quantite;
        	}


    }


<<<<<<< HEAD
      $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat,"","");
=======
      $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat,"");
>>>>>>> 261310b22b36d4ad77306e3e2abb94e4fb66d567
  }

  /**
   * @return mixed la commande
   */
  public function getUneCommande(){
      return $this->uneCommande;
  }

}
?>
