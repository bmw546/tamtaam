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

        /**
         * GestionnaireCommande constructor.
         * @param $uneCommande
         */
        public function __construct( $numeroCommande,$nomClient, $adresse, $date, $montant, $etat, $type){
            $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat, $type);
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

            $connection = new Connexion();

            //Id client 1 pour test
            $query = "INSERT INTO commande(id_client, id_etat,id_type_commande, date, montant, nom )".
                "VALUES ('1', '$etat', '$type', '$date','$montant','$nomClient')";

            $connection->execution($query);

            //Si c'est une livraison
            if ($etat == 1 )
            {
                $query = "SELECT * FROM commande ORDER BY id_commande DESC LIMIT 1";
                $result = $connection->execution($query);
                $id_commande = $result[0][0];

                $query2 = "INSERT INTO livraison(id_commande, adresse,adresse_latitude, adresse_longitude, 
                                                date_livraison_prevue, date_livraison_reel )".
                    "VALUES ('$id_commande', '$adresse', '0', '0','$date','NULL')";
                $connection->execution($query2);
            }
        }

        public function modifierCommande(){

        }

    }
    ?>
