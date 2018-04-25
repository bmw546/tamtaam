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

/**
 * Class GestionnaireUtilisateur
 * fait le lien entre l'objet utilisateur et le controlleur et communique avec la bd
 */
class GestionnaireUtilisateur {

	private $unUtilisateur;
	
	/**
	* Constructeur
	*/
	public function __construct($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){

        $this->unUtilisateur = new Utilisateur($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone);
    }
	
	/**
	* modifier l'utilisateur
	*/
	public function setUnUtilisateur($unUtilisateur){
		$this->unUtilisateur = $unUtilisateur;
	}
	
	/**
	* retourne l'utilisateur
	*/
	public function getUnUtilisateur(){
		return $this->unUtilisateur;
	}
	
	/**
	* Ajouter un utilisateur avec les informations de l'interface inscription à la BD.
	*/
	public function ajouterUtilisateur(){

	    $nom = $this->unUtilisateur->getNomUtilisateur();
        $mdp = $this->unUtilisateur->getMotDePasse();
        $email = $this->unUtilisateur->getEmail();
        $adresse = $this->unUtilisateur->getAdresse();
        $phone = $this->unUtilisateur->getTelephone();

        $connection = new Connexion();

        $query = "INSERT INTO client( nom_utilisateur, mot_de_passe, adresse_email, adresse, telephone)".
                         "VALUES ('$nom', '$mdp', '$email', '$adresse', $phone)";

        $connection->execution($query);
    }
}
?>