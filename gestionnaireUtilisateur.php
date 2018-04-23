<?php
/********************************************************
Fichier : gestionnaireUtilisateur.php
Auteur :  Rémi Létourneau
Fonctionnalité : Gestion des comptes utilisateurs
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================

Historique de modifications :
Date                    Nom             Description
=========================================================

*********************************************************/
require_once 'utilisateur.php';

class GestionnaireUtilisateur {

	private $nom_utilisateur;
	private $mot_de_passe;
	private $email;
	private $adresse;
	private $telephone;
	
	/**
	* Constructeur
	*/
	public function __construct($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){		
        $this->nom_utilisateur = $nom_utilisateur;
        $this->mot_de_passe = $mot_de_passe;
        $this->email = $email;
		$this->adresse = $adresse;
		$this->telephone = $telephone;
    }
	
	/**
	* modifier le nom d'utilisateur
	*/
	public function setNomUtilisateur($nom){
		$this->nom_utilisateur = $nom;
	}
	
	/**
	* retourne le nom d'utilisateur
	*/
	public function getNomUtilisateur(){
		return $this->nom_utilisateur;
	}

	/**
	* modifie le mot de passe
	*/
	public function setMotDePasse($mdp){
		$this->mot_de_passe = $mdp;
	}
	
	/**
	* Retourne le mot de passe
	*/
	public function getMotDePasse(){
		return $this->mot_de_passe;
	}
	
	/**
	* Modifie l'email
	*/
	public function setEmail($adresseEmail){
		$this->email = $adresseEmail;
	}
	
	/**
	* retourne l'email
	*/
	public function getEmail(){
		return $this->email;
	}

	/**
	* modifie l'adresse
	*/
	public function setAdresse($adresseMaison){
		$this->adresse =  $adresseMaison;
	}
	
	/**
	* retourne l'adresse
	*/
	public function getAdresse(){
		return $this->adresse;
	}

	/**
	* modifie le numéro de telephone
	*/
	public function setTelephone($tel){
		$this->telephone =  $tel;
	}
	
	/**
	* retourne le numéro de téléphone
	*/
	public function getTelephone(){
		return $this->telephone;
	}
	
	/**
	* Ajouter un utilisateur avec les informations de l'interface inscription
	*/
	public function ajouterUtilisateur(){		
	
        $aUser = new Utilisateur(0, $this->nom_utilisateur, $this->mot_de_passe, $this->email, $this->adresse, $this->telephone);
		
		//ajoute un utilisateur à la base de donnée
    }
}
?>