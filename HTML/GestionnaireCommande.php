<?php
/********************************************************
    Fichier : GestionnaireCommande.php
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
***********************************************************/
    require_once 'MoteurRequeteBD.php';
    require_once 'commande.php';
    require_once 'produit.php';
    require_once 'utilisateur.php';

    class GestionnaireCommande{

        private $uneCommande;
        private $numeroCommande,$nomClient, $adresse, $date, $montant, $etat, $type;
        private $listeProduit = array();

        /**
         * GestionnaireCommande constructor.
         * @param $uneCommande
         */
        public function __construct( $numeroCommande,$nomClient, $adresse, $date, $montant, $etat, $type,$listeProduit){
            ##$this->uneCommande = new Commande($numeroCommande, $nomClient, $adresse, $date, $montant, $etat, $type,$listeProduit );
            $this->numeroCommande=$numeroCommande;
            $this->nomClient=$nomClient;
            $this->adresse=$adresse;
            $this->date=$date;
            $this->montant=$montant;
            $this->etat=$etat;
            $this->type=$type;
            $this->listeProduit=$listeProduit;
        }

        /**Getteur d'une commande
         * @return Commande
         */
        public function getUneCommande(){
            return $this->uneCommande;
        }

        /**Setteur d'une commande
         * @param Commande $uneCommande
         */
        public function setUneCommande($uneCommande){
            $this->uneCommande = $uneCommande;
        }

        //Ajoute une commande dans la base de données
        public function ajouterCommande(){
            /*
            $nomClient = $this->uneCommande->getNomClient();
            $adresse = $this->uneCommande->getAdresse();
            $date = $this->uneCommande->getDate();
            $montant = $this->uneCommande->getMontant();
            $etat = $this->uneCommande->getEtat();
            $type = $this->uneCommande->getType();
            $listeProduit= $this->uneCommande->getListeProduit();
            */
            $nomClient = $this->nomClient;
            $adresse = $this->adresse;
            $date = $this->date;
            $montant = $this->montant;
            $etat = $this->etat;
            $type = $this->type;
            $listeProduit= $this->listeproduit;
            $connection = new Connexion();

            $user = unserialize($_SESSION['utilisateur']);
            $str_user = $user->getId();

            $query = "INSERT INTO commande(id_client, id_etat,id_type_commande, date, montant, nom )".
                "VALUES ('$str_user', '$etat', '$type', '$date','$montant','$nomClient')";
            $connection->execution($query);

            //Requete du numero de commande
            $query = "SELECT * FROM commande ORDER BY commande.id_commande DESC LIMIT 1";
            $result = $connection->execution_avec_return($query);
            $numeroCommande=$result[0][0];

            //Ajout d'une livraison dans la BD si c'est une livraison
            if ($etat == 1 )
            {
                $query = "SELECT * FROM commande ORDER BY id_commande DESC LIMIT 1";
                $result = $connection->execution_avec_return($query);
                $id_commande = $result[0][0];

                //Trouve la longitude/latitude
                $prepAddr = str_replace(' ','+',$adresse);
                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                //2 jour de livraison est temporaire
                $date_livraison = date('Y-m-d', strtotime($date. ' + 2 days'));
                $query2 = "INSERT INTO livraison(id_commande, adresse,adresse_latitude, adresse_longitude, 
                                                date_livraison_prevue, date_livraison_reel ) VALUES ('$id_commande', '$adresse', '$latitude', '$longitude','$date_livraison','NULL')";
                $connection->execution($query2);
            }

            //Insertion dans la table d'association de produit et commande
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
