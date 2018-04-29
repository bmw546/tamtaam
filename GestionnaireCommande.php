<?php
/********************************
    Fichier : GestionnaireCommande.php
    Auteur : Joel Lapointe
    Fonctionnalité : WEB-02 - Gestion des commandes
    Date : 23 avril 2018

    Vérification :
    Date                Nom                 Approuvé
    ====================================================

    Historique de modifications :
    Date                Nom                 Description
    ======================================================
*****************************/
    require_once 'MoteurRequeteBD.php';
    require_once 'commande.php';
    require_once 'produit.php';

    class GestionnaireCommande{

        private $uneCommande;
        private $numeroCommande,$nomClient, $adresse, $date, $montant, $etat, $type;
        private $listeProduit = array();

        /**
         * GestionnaireCommande constructor.
         * @param $uneCommande
         */
        public function __construct( $numeroCommande,$nomClient, $adresse, $date, $montant, $etat, $type,$listeProduit){
            $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat, $type,$listeProduit );
        }

        /**
         * @return mixed
         */
        public function getUneCommande(){
            return $this->uneCommande;
        }

        /**
         * @param mixed $uneCommande
         */
        public function setUneCommande($uneCommande){
            $this->uneCommande = $uneCommande;
        }


        public function ajouterCommande(){
            $nomClient = $this->uneCommande->getNomClient();
            $adresse = $this->uneCommande->getAdresse();
            $date = $this->uneCommande->getDate();
            $montant = $this->uneCommande->getMontant();
            $etat = $this->uneCommande->getEtat();
            $type = $this->uneCommande->getType();
            $listeProduit= $this->uneCommande->getListeProduit();

            $connection = new Connexion();

            //Id client 1 pour test
            $query = "INSERT INTO commande(id_client, id_etat,id_type_commande, date, montant, nom )".
                "VALUES ('1', '$etat', '$type', '$date','$montant','$nomClient')";
            $connection->execution($query);

            //Requete du numero de commande
            $query = "SELECT * FROM commande ORDER BY commande.id_commande DESC LIMIT 1";
            $result = $connection->execution_avec_return($query);
            $numeroCommande=$result[0][0];
            //Si c'est une livraison
            if ($etat == 1 )
            {
                $query = "SELECT * FROM commande ORDER BY id_commande DESC LIMIT 1";

                $result = $connection->execution_avec_return($query);
                //echo $result;
                $id_commande = $result[0][0];
                //echo $id_commande;

                //$date_livraison = date_add(date("Y-m-d"),date_interval_create_from_date_string('3 days'));
                $date_livraison = date('Y-m-d', strtotime($date. ' + 2 days'));
                $query2 = "INSERT INTO livraison(id_commande, adresse,adresse_latitude, adresse_longitude, 
                                                date_livraison_prevue, date_livraison_reel )".
                    "VALUES ('$id_commande', '$adresse', '0', '0','$date_livraison','NULL')";
                $connection->execution($query2);
              //  echo $query2;
            }


            foreach ($listeProduit as $cb){
                echo $cb. "<br/>";;
            }

            //Insertion dans la table d'association
            $i = 0;
            $nbElement = count($listeProduit)/2;
            for ($x = 0; $x < $nbElement; $x++){
                $j = $i + 1;
                $query = "INSERT INTO ta_produit_commande(id_produit,id_commande,nb_produit ) ".
                    " VALUES ('$listeProduit[$i]','$numeroCommande','$listeProduit[$j]')";
                $connection->execution($query);
                $i = $i + 2;
            }
        }
    }
    ?>
