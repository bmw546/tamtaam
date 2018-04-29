<?php
/********************************
    Fichier : commande.php
    Auteur : Joel Lapointe
    Fonctionnalité : WEB-02 - Gestion des commandes
    Date : 23 avril 2018

    Vérification :
    Date                Nom                 Approuvé
    ====================================================
    2018-04-29          Rémi Létourneau     Oui

    Historique de modifications :
    Date                Nom                 Description
    ======================================================

 ********************************/
    class Commande
    {
        //Properties
        public $numeroCommande;
        public $nomClient;
        public $adresse;
        public $date;
        public $montant;
        public $etat;
        public $type;
        public $listeProduit;
        /**
         * Commande constructor.
         * @param $numeroCommande Le numéro de commande
         * @param $nomClient Le nom du client
         * @param $adresse l'adresse de livraison
         * @param $date la date de la commande
         * @param $montant le montant de la commande
         * @param $etat l'état de la commande
         * @param $type le type de commande
         * @param $listeProduit la liste des produits
         */
        public function __construct($numeroCommande, $nomClient, $adresse, $date, $montant, $etat,$type,$listeProduit)
        {
            $this->numeroCommande = $numeroCommande;
            $this->nomClient = $nomClient;
            $this->adresse = $adresse;
            $this->date = $date;
            $this->montant = $montant;
            $this->etat = $etat;
            $this->type = $type;
            $this->listeProduit = $listeProduit;
        }

        /** Getteur du numéro de commande
         * @return le numéro de commande
         * (Precondition: $numeroCommande != null)
         * (Postcondition: $this->numeroCommande == $numeroCommande)
         */
        public function getNumeroCommande()
        {
            return $this->numeroCommande;
        }

        /** Setteur du numéro de commande
         * @param mixed $numeroCommande
         * (Precondition: $numeroCommande != null)
         * (Postcondition: $this->numeroCommande == $numeroCommande)
         */
        public function setNumeroCommande($numeroCommande)
        {
            $this->numeroCommande = $numeroCommande;
        }

        /**Getteur du nom de client
         * @return le nom du client
         * (Precondition: $nomClient != null)
         * (Postcondition: $this->nomClient == $nomClient)
         */
        public function getNomClient()
        {
            return $this->nomClient;
        }

        /**Setteur du nom du client
         * @param mixed $nomClient
         * (Precondition: $nomClient != null)
         * (Postcondition: $this->nomClient == $nomClient)
         */
        public function setNomClient($nomClient)
        {
            $this->nomClient = $nomClient;
        }

        /**Getteur de l'adresse
         * @return une adresse
         * (Precondition: $adresse != null)
         * (Postcondition: $this->adresse == $adresse)
         */
        public function getAdresse()
        {
            return $this->adresse;
        }

        /**Setteur d'adresse
         * @param mixed $adresse
         * (Precondition: $adresse != null)
         * (Postcondition: $this->adresse == $adresse)
         */
        public function setAdresse($adresse)
        {
            $this->adresse = $adresse;
        }

        /**Getteur de date
         * @return la date de la commande
         * (Precondition: $adresse != null)
         * (Postcondition: $this->adresse == $adresse)
         */
        public function getDate()
        {
            return $this->date;
        }

        /**Setteur de date
         * @param mixed $date
         * (Precondition: $date != null)
         * (Postcondition: $this->date == $date)
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**Getteur du montant
         * @return le montant
         * (Precondition: $montant != null)
         * (Postcondition: $this->montant == $montant)
         */
        public function getMontant()
        {
            return $this->montant;
        }

        /**Setteur du montant
         * @param mixed $montant
         * (Precondition: $montant != null)
         * (Postcondition: $this->montant == $montant)
         */
        public function setMontant($montant)
        {
            $this->montant = $montant;
        }

        /**Getteur de l'état de commande
         * @return un état de commande
         * (Precondition: $etat != null)
         * (Postcondition: $this->etat == $etat)
         */
        public function getEtat()
        {
            return $this->etat;
        }

        /**Setteur d'état
         * @param mixed $etat
         * (Precondition: $etat != null)
         * (Postcondition: $this->etat == $etat)
         */
        public function setEtat($etat)
        {
            $this->etat = $etat;
        }

        /**Getteur de type
         * @return type de commande
         * (Precondition: $type != null)
         * (Postcondition: $this->type == $type)
         */
        public function getType()
        {
            return $this->type;
        }

        /**Setteur de type de commande
         * @param mixed $type
         * (Precondition: $type != null)
         * (Postcondition: $this->type == $type)
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**Getteur de la liste de produit
         * @return une liste de produit
         * (Precondition: $listeProduit != null)
         * (Postcondition: $this->listeProduit == $listeProduit)
         */
        public function getListeProduit()
        {
            return $this->listeProduit;
        }

        /**Setteur de la liste de produit
         * @param mixed $listeProduit
         * (Precondition: $listeProduit != null)
         * (Postcondition: $this->listeProduit == $listeProduit)
         */
        public function setListeProduit($listeProduit)
        {
            $this->listeProduit = $listeProduit;
        }
    }
?>