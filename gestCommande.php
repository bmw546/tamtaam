<?php
/********************************
    Fichier : gestCommande.php
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
    require_once 'connection.php';
    require_once 'commande.php';
    require_once 'produit.php';

    class GestionnaireCommande{

        private $uneCommande;

        /**
         * GestionnaireCommande constructor.
         * @param $uneCommande
         */
        public function __construct($numeroCommande, $nomClient, $adresse, $date, $montant, $etat){
            $this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat);
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
            $numeroCommande = $this->uneCommande->getNumeroCommande();
            $nomClient = $this->uneCommande->getNomClient();
            $adresse = $this->uneCommande->getAdresse();
            $date = $this->uneCommande->getDate();
            $montant = $this->uneCommande->getMontant();
            $etat = $this->uneCommande->getEtat();

            $connection = new Connexion();

            $query = "INSERT INTO commande( id_commande, id_client, id_etat, adresse, date, montant )".
                "VALUES ('$numeroCommande', '$nomClient', '$etat', '$adresse', $date,$montant)";

            $connection->execution($query);

        }

        public function modifierCommande(){

        }

    }
    ?>
