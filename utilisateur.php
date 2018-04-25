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
  2018-04-24		Rémi Létourneau			Ajouter des commentaires et retirer l'id
  2018-04-25		Rémi Létourneau			Ajout des préconditions et postconditions
********************************************************************************/

class Utilisateur {
	
	private $nom_utilisateur;
	private $mot_de_passe;
	private $email;
	private $adresse;
	private $telephone;
	
	/**
	 * Constructeur
     * @param $nom_utilisateur le nom de l'utilisateur
     * @param $mot_de_passe le mot de passe de l'utilisateur
     * @param $email l'adresse email de l'utilisateur
     * @param $adresse l'adresse de la maison de l'utilisateur
     * @param $telephone le téléphone de l'utilisateur
	*/
	public function __construct($nom_utilisateur, $mot_de_passe, $email, $adresse, $telephone){		
    
        $this->nom_utilisateur = $nom_utilisateur;
        $this->mot_de_passe = $mot_de_passe;
        $this->email = $email;
		$this->adresse = $adresse;
		$this->telephone = $telephone;
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
