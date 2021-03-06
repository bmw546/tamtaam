<?php
/********************************************************************************
 Fichier : Utilisateur.php
 Auteur : Roméo Tsarafodiana-Bugeaud
 Fonctionnalité : Informations de l'utilisateur
 Date : 2018-04-23

 Vérification :
 Date 				Nom 					Approuvé
 =========================================================
 2018-04-23			Rémi 			        Oui

 Historique de modifications :
 Date 				Nom 					Description
 =========================================================
  2018-04-23		Rémi Létourneau			Enlever la variable type utilisateur
  2018-04-24		Rémi Létourneau			Ajouter des commentaires et retirer l'id
  2018-04-25		Rémi Létourneau			Ajout des préconditions et postconditions
	2018-04-25	  Roméo 							Ajout de constructeur avec et sans paramètre
********************************************************************************/

class Utilisateur {

	private $id;
	private $nom_utilisateur;
	private $mot_de_passe;
	private $email;
	private $adresse;
	private $telephone;
	private $siCommande;

	/**
	 * Constructeur
     * @param $nom_utilisateur le nom de l'utilisateur
     * @param $mot_de_passe le mot de passe de l'utilisateur
     * @param $email l'adresse email de l'utilisateur
     * @param $adresse l'adresse de la maison de l'utilisateur
     * @param $telephone le téléphone de l'utilisateur
	 * @param $siCommande si l'utilisateur a au moins 1 commande en cours
	*/
	public function __construct(){

			$argv = func_get_args();

			//s'il y a 5 paramètres
			if (func_num_args() == 5) {
			 	 self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4] );
			}
  }

	public function __construct2($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){

		$this->setNomUtilisateur($nom_utilisateur);
		$this->setMotDePasse($mot_de_passe);
		$this->setEmail($email);
		$this->setAdresse($adresse);
		$this->setTelephone($telephone);
	}



    /**
     * modifier l'id de l'utilisateur
     * @param $id
     *(Precondition: $id > 0)
     *(Postcondition: $this->id == $id)
     */
    public  function setId($id){

        $this->id = $id;
    }

    /**
     * Retourne l'id
     * (Precondition: $this->id > 0)
     * (Postcondition: getId() == $this->id)
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * modifier si l'utilisateur à 1 commande
     * @param $siCommande
     *(Precondition: $id > 0)
     *(Postcondition: $this->$siCommande == $siCommande)
     */
    public function setSiCommande($siCommande){
        $this->siCommande = $siCommande;
    }


    /**
     * Retourne si l'utilisateur a une commande
     * (Precondition: $this->siCommande == true  , $this->siCommande == false)
     * (Postcondition: getSiCommande() == $this->siCommande)
     */
    public function getSiCommande(){
        return $this->siCommande;
    }


	/**
	 * Modifie les infos d'un utilisateur
     * @param $nom_utilisateur le nom de l'utilisateur
     * @param $mot_de_passe le mot de passe de l'utilisateur
     * @param $email l'adresse email de l'utilisateur
     * @param $adresse l'adresse de la maison de l'utilisateur
     * @param $telephone le téléphone de l'utilisateur
	*/
	public function setInfosUtilisateur($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){

		$this->setNomUtilisateur($nom_utilisateur);
		$this->setMotDePasse($mot_de_passe);
		$this->setEmail($email);
		$this->setAdresse($adresse);
		$this->setTelephone($telephone);
	}

	/**
	 * Modifie le nom de l'utilisateur
	 * @param $nom le nom de l'utilisateur
     * (Precondition: $nom != null)
     * (Postcondition: $this->nom_utilisateur == $nom)
	*/
	public function setNomUtilisateur($nom){
		$this->nom_utilisateur = $nom;
	}

	/**
	 * Obtiens le nom de l'utilisateur
     * (Precondition: $this->nom_utilisateur != null)
     * (Postcondition: getNomUtilisateur() == $this->nom_utilisateur)
	*/
	public function getNomUtilisateur(){
		return $this->nom_utilisateur;
	}

	/**
	 * Modifier le mot de passe
	 * @param $mdp le mot de passe de l'utilisateur
     * (Precondition: $mdp != null)
     * (Postcondition: $this->mot_de_passe == $mdp)
	*/
	public function setMotDePasse($mdp){
		$this->mot_de_passe = $mdp;
	}

	/**
	 * Obtiens le mot de passe
     * (Precondition: $this->mot_de_passe != null)
     * (Postcondition: getMotDePasse() == $this->mot_de_passe)
	*/
	public function getMotDePasse(){
		return $this->mot_de_passe;
	}

	/**
	 * Modifie l'adresse email
	 * @param $adresseEmail l'adresse email de l'utilisateur
     * (Precondition: $adresseEmail != null)
     * (Postcondition: $this->email == $adresseEmail)
	*/
	public function setEmail($adresseEmail){
		$this->email = $adresseEmail;
	}

	/**
	 * Obtiens l'adresse email
     * (Precondition: $this->email != null)
     * (Postcondition: getEmail() == $this->email)
	*/
	public function getEmail(){
		return $this->email;
	}

	/**
	 * Modifie l'adresse de l'utilisateur
	 * @param $adresseMaison l'adresse maison de l'utilisateur
     * (Precondition: $adresseMaison != null)
     * (Postcondition: $this->adresse == $adresseMaison)
	*/
	public function setAdresse($adresseMaison){
	 $this->adresse =  $adresseMaison;
	}

	/**
	 * Obtiens l'adresse de l'utilisateur
     * (Precondition: $this->adresse != null)
     * (Postcondition: getAdresse() == $this->adresse)
	*/
	public function getAdresse(){
		return $this->adresse;
	}

	/**
	 * Modifie le numéro de téléphone
	 * @param $tel  numéro de téléphone de l'utilisateur
     * (Precondition: $tel != null)
     * (Postcondition: $this->telephone == $tel)
	*/
	public function setTelephone($tel){
	 $this->telephone =  $tel;
	}

	/**
	 * Obtiens le numéro de téléphone
     * (Precondition: $this->telephone != null)
     * (Postcondition: getTelephone() == $this->telephone)
	*/
	public function getTelephone(){
		return $this->telephone;
	}
}
 ?>
