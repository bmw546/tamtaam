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
2018-04-23				Rémi			Modification de la classe.
										Ajout des instructions pour ajouter
										un utilisateur a la BD. (Erreur avec propriété résolue)

*********************************************************/
require_once 'utilisateur.php';
require_once 'connection.php';

/**
 * Class GestionnaireUtilisateur
 * fait le lien entre l'objet utilisateur et le controlleur et communique avec la bd
 */
class GestionnaireUtilisateur {

    /**
     * @var Utilisateur un utilisateur du systéme
     */
    private $unUtilisateur;
	
	/**
	 * Constructeur
     * @param $nom_utilisateur le nom de l'utilisateur
     * @param $mot_de_passe le mot de passe de l'utilisateur
     * @param $email l'adresse email de l'utilisateur
     * @param $adresse l'adresse de la maison de l'utilisateur
     * @param $telephone le téléphone de l'utilisateur
     * (Precondition: $nom_utilisateur != null && $mot_de_passe != null)
     * (Postcondition: $this->unUtilisateur != null)
	*/
	public function __construct($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){

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

        $connection = new Connexion();

        $query = "INSERT INTO client( nom_utilisateur, mot_de_passe, adresse_email, adresse, telephone)".
                         "VALUES ('$nom', '$mdp', '$email', '$adresse', $phone)";

        $connection->execution($query);
    }
}
?>