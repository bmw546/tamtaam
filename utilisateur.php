<?php
/********************************************************************************
 Fichier : utilisateur.php
 Auteur : Roméo Tsarafodiana-Bugeaud
 Fonctionnalité : Informations de l'utilisateur
 Date : 2018-04-23
 
 Vérification :
 Date 				Nom 					Approuvé
 =========================================================
 2018-04-23			Rémi Létourneau			Oui
 
 Historique de modifications :
 Date 				Nom 					Description
 =========================================================
  2018-04-23		Rémi Létourneau			Enlever la variable type utilisateur
  2018-04-24		Rémi Létourneau			Ajouter des commentaires
********************************************************************************/

class Utilisateur {
	
	private $id;
	private $nom_utilisateur;
	private $mot_de_passe;
	private $email;
	private $adresse;
	private $telephone;
	
	/**
	* Constructeur
	*/
	public function __construct($id, $nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){		
        $this->id = $id;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->mot_de_passe = $mot_de_passe;
        $this->email = $email;
		$this->adresse = $adresse;
		$this->telephone = $telephone;
    }
	
	/**
	* Modifie l'id de l'utilisateur
	*/
	public function setId($id){
		$this->id = $id;
	}
	
	/**
	* Obtiens l'id de l'utilisateur
	*/
	public function getId(){
		return $this->id;
	}
	
	/**
	* Modifie le nom de l'utilisateur
	*/
	public function setNomUtilisateur($nom){
		$this->nom_utilisateur = $nom;
	}
	
	/**
	* Obtiens le nom de l'utilisateur
	*/
	public function getNomUtilisateur(){
		return $this->nom_utilisateur;
	}

	/**
	* Modifier le mot de passe
	*/
	public function setMotDePasse($mdp){
		$this->mot_de_passe = $mdp;
	}
	
	/**
	* Obtiens le mot de passe
	*/
	public function getMotDePasse(){
		return $this->mot_de_passe;
	}

	/**
	* Modifie l'adresse email
	*/
	public function setEmail($adresseEmail){
		$this->email = $adresseEmail;
	}
	
	/**
	* Obtiens l'adresse email
	*/
	public function getEmail(){
		return $this->email;
	}

	/**
	* Modifie l'adresse de l'utilisateur
	*/
	public function setAdresse($adresseMaison){
	 $this->adresse =  $adresseMaison;
	}
	
	/**
	* Obtiens l'adresse de l'utilisateur
	*/
	public function getAdresse(){
		return $this->adresse;
	}

	/**
	* Modifie le numéro de téléphone
	*/
	public function setTelephone($tel){
	 $this->telephone =  $tel;
	}
	
	/**
	* Obtiens le numéro de téléphone
	*/
	public function getTelephone(){
		return $this->telephone;
	}
}
 ?>
