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
2018-04-23				Rémi			Modification de la classe, 
										ajout des instructions pour ajouter 
										un utilisateur a la BD. (Erreur avec propriété)

*********************************************************/
require_once 'utilisateur.php';
require_once 'connection.php';

class GestionnaireUtilisateur {

	private $unUtilisateur;
	
	/**
	* Constructeur
	*/
	public function __construct($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){		
	
		$unUtilisateur = new Utilisateur($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone);
    }
	
	/**
	* modifier l'utilisateur
	*/
	public function setUtilisateur($utilisateur){
		$this->unUtilisateur = $utilisateur;
	}
	
	/**
	* retourne l'utilisateur
	*/
	public function getUtilisateur(){
		return $this->unUtilisateur;
	}
	
	/**
	* Ajouter un utilisateur avec les informations de l'interface inscription à la BD.
	*/
	public function ajouterUtilisateur(){		
		
		// $connection = new Connexion();

		// $query = "INSERT INTO client( nom_utilisateur, mot_de_passe, adresse_email, adresse, telephone)".
							// "VALUES (".$this->unUtilisateur->getNomUtilisateur() .", 
									// ". $this->unUtilisateur->getMotDePasse() .", 
									// ". $this->unUtilisateur->getEmail() .", 
									// ". $this->unUtilisateur->getAdresse() .", 
									// ". $this->unUtilisateur->getTelephone() .")";
		
		// $connection->execution($query);
    }
}
?>