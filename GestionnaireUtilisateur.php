<?php
/********************************************************************************************
Fichier : GestionnaireUtilisateur.php
Auteur :  Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================


Historique de modifications :
Date          Nom             			Description
=========================================================
2018-04-24	  Rémi Létourneau	 		Modification de la classe.
										Ajout des instructions pour ajouter
										un utilisateur a la BD. (Erreur avec propriété résolue)
2018-04-25    Rémi Létourneau  			Ajout des pré et post conditions
2018-04-25    Roméo 					Ajout du constructeur sans paramètre
2018-04-25    Roméo 					Ajout de fonctions getters et setters des 3 variables
2018-04-25    Roméo 					Ajout d'Authentification
2018-04-25    Roméo 					Ajout de mot de passe/ nom d'utilisateur oublié
2018-04-26    Rémi Létourneau          Corriger exécution de code sql et ajout de commentaire.
***********************************************************************************************/
require_once 'Utilisateur.php';
require_once 'GestionnaireCourriel.php';
require_once 'MoteurRequeteBD.php';

/**
 * Class GestionnaireUtilisateur
 * fait le lien entre l'objet utilisateur et le controlleur et communique avec la bd
 */
class GestionnaireUtilisateur {

    private $unUtilisateur;
    private $etat;
    private $courriel;
    private $connexion;

    /**
     * GestionnaireUtilisateur constructeur sans paramètre.
     */
	public function __construct(){

        $this->courriel    = new GestionnaireCourriel();
        $this->connexion   = new Connexion;
        $this->etat        = "";

        $argv = func_get_args();

        if (func_num_args() == 5) {
           self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4]);
        }
        else {
           $this->utilisateur = new Utilisateur("", "", "", "", "");
        }
    }

    /**
     * GestionnaireUtilisateur constructeur avec paramètre.
     * @param $nom_utilisateur le nom de l'utilisateur
     * @param $mot_de_passe le mot de passe de l'utilisateur
     * @param $email l'adresse email de l'utilisateur
     * @param $adresse l'adresse de la maison de l'utilisateur
     * @param $telephone le téléphone de l'utilisateur
     * (Precondition: $nom_utilisateur != null && $mot_de_passe != null)
     * (Postcondition: $this->unUtilisateur != null)
     */
    public function __construct2($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){

        $this->unUtilisateur = new Utilisateur($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone);
	}

	/**
	 * modifier l'utilisateur
     * @param $unUtilisateur  l'utilisateur
     *(Precondition: $unUtilisateur != null)
     *(Postcondition: $this->unUtilisateur == $unUtilisateur)
	*/
	public function setUnUtilisateur($unUtilisateur){
		$this->unUtilisateur = $unUtilisateur;
	}

	/**
     * Retourne l'utilisateur
     * (Precondition: $this->unUtilisateur != null)
     * (Postcondition: getUnUtilisateur() == $this->unUtilisateur)
	*/
	public function getUnUtilisateur(){
		return $this->unUtilisateur;
	}

    /**
     * retourne l'état de l'authentification (réussie, mauvais mdp, mauvais username)
     *
    */
    public function getEtat(){
        return $this->etat;
    }

    /**
     * Modifie l'état de l'authentification
     * @param $etat valeur a applique a l'état
     */
    public function setEtat($etat){
        $this->etat = $etat;
    }

    /**
     * Ajouter un utilisateur avec les informations de l'interface inscription à la BD.
     * (Precondition: $this->unUtilisateur != null)
     * (Postcondition: $this->unUtilisateur == BD)
    */
    public function ajouterUtilisateur(){

        $nom = $this->unUtilisateur->getNomUtilisateur();
        $mdp = $this->unUtilisateur->getMotDePasse();
        $email = $this->unUtilisateur->getEmail();
        $adresse = $this->unUtilisateur->getAdresse();
        $phone = $this->unUtilisateur->getTelephone();

        $query = "INSERT INTO client( nom_utilisateur, mot_de_passe, adresse_email, adresse, telephone)".
                         "VALUES ('$nom', '$mdp', '$email', '$adresse', $phone)";

        $this->connexion->execution($query);
    }

    /**
     * Connecte un utilisateur avec un nom et un mot de passe
     */
    public function authentification($nom_utilisateur, $mot_de_passe){

      $query  = "SELECT * FROM client WHERE nom_utilisateur = '$nom_utilisateur'";
      $result = $this->connexion->execution_avec_return($query);

      //si il y a un résultat
      if (sizeof($result) > 0) {
          foreach($result as $row){
              //si le mot de passe ne correspond pas au bon mot de passe
              if ($row["mot_de_passe"] != $mot_de_passe) {
                  $this->setEtat('Mauvais mot de passe');
              }
              //sinon les informations sont bonnes
              else {
                  $this->setEtat('Authentification réussie');

                  //ajoute les infos de l'utilisateur dans un objet Utilisateur
                  $this->utilisateur->setInfosUtilisateur($row["nom_utilisateur"], $row["mot_de_passe"],
                                            $row["adresse_email"], $row["adresse"], $row["telephone"]);
              }

          }
      }
      //s'il n'y a aucun résultat pour le nom d'utilisateur
      else {
          $this->setEtat('Mauvais nom d\'utilisateur');
      }
    }

    /**
     * Envoie un courriel a l'adresse indiquée, avec le mot de passe lier avec l'adresse
     */
    public function motDePasseOublie($email){

        $result = $this->connexion->execution_avec_return("SELECT * FROM client WHERE adresse_email = '$email'");
        if (sizeof($result) > 0) {
            foreach($result as $row) {

            $mdp = $row["mot_de_passe"];
            $msg = "Votre mot de passe est: ";
            $msg .= $mdp;
            $this->courriel->setType("mot de passe oublié");

            //à enlever plus tard, j'envoi tous les email à tamtaam pour les tests
            $email = "tamtaamsherbrooke@gmail.com";
            $this->courriel->sentMail("Tamtaam.com",$email, "Récupération de votre mot de passe (ne pas répondre à ce message)", $msg);
            $this->setEtat('Email envoyé');
          }
        }
        else {
           $this->setEtat('Adresse email non valide');
        }
        echo $this->getEtat();
    }

    /**
     * Envoie un courriel a l'adresse indiquée, avec le nom d'utilisateur lier avec l'adresse
     */
    public function nomUtilisateurOublie($email) {

        $result = $this->connexion->execution_avec_return("SELECT * FROM client WHERE adresse_email = '$email'");
        if (sizeof($result) > 0) {

        foreach($result as $row) {

          $username = $row["nom_utilisateur"];
          $msg = "Votre nom d'utilisateur est: ";
          $msg .= $username;
          $this->courriel->setType("nom d'utilisateur oublié");

          //à enlever plus tard, j'envoi tous les email à tamtaam pour les tests
          $email = "tamtaamsherbrooke@gmail.com";
          $this->courriel->sentMail("Tamtaam.com",$email, "Récupération de votre nom d'utilisateur (ne pas répondre à ce message)", $msg);
          $this->setEtat('Email envoyé');
          }
        }
        else {
           $this->setEtat('Adresse email non valide');
        }
    }
}
?>
