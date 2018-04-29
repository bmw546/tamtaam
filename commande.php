<?php
/********************************
    Fichier : Commande.php
    Auteur : Joel Lapointe
    Fonctionnalité : WEB-02 - Gestion des commandes
    Date : 23 avril 2018

    Vérification :
    Date                Nom                 Approuvé
    ====================================================

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
         * @param $numeroCommande
         * @param $nomClient
         * @param $adresse
         * @param $date
         * @param $montant
         * @param $etat
         * @param $type
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

        /**
         * @return mixed
         */
        public function getNumeroCommande()
        {
            return $this->numeroCommande;
        }

        /**
         * @param mixed $numeroCommande
         */
        public function setNumeroCommande($numeroCommande)
        {
            $this->numeroCommande = $numeroCommande;
        }

        /**
         * @return mixed
         */
        public function getNomClient()
        {
            return $this->nomClient;
        }

        /**
         * @param mixed $nomClient
         */
        public function setNomClient($nomClient)
        {
            $this->nomClient = $nomClient;
        }

        /**
         * @return mixed
         */
        public function getAdresse()
        {
            return $this->adresse;
        }

        /**
         * @param mixed $adresse
         */
        public function setAdresse($adresse)
        {
            $this->adresse = $adresse;
        }

        /**
         * @return mixed
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @param mixed $date
         */
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * @return mixed
         */
        public function getMontant()
        {
            return $this->montant;
        }

        /**
         * @param mixed $montant
         */
        public function setMontant($montant)
        {
            $this->montant = $montant;
        }

        /**
         * @return mixed
         */
        public function getEtat()
        {
            return $this->etat;
        }

        /**
         * @param mixed $etat
         */
        public function setEtat($etat)
        {
            $this->etat = $etat;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param mixed $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * @return mixed
         */
        public function getListeProduit()
        {
            return $this->listeProduit;
        }

        /**
         * @param mixed $listeProduit
         */
        public function setListeProduit($listeProduit)
        {
            $this->listeProduit = $listeProduit;
        }



    }
?>