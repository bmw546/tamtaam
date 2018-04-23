<?php

/****************************************
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
  2018-04-23		Rémi Létourneau			changer la variable type pour typeUser
****************************************/

class Utilisateur {
	
   private $id;
   private $nom_utilisateur;
   private $mot_de_passe;
   private $email;
   private $adresse;
   private $telephone;
   private $typeUser;  //Si client est admin ou client

   public function setId($id){
     $this->id = $id;
   }
   public function getId(){
     return $this->id;
   }

   public function getTypeUser(){
   return $this->type;
   }
   public function setTypeUser($type){
    $this->type = $type;
   }

   public function setNomUtilisateur($nom){
     $this->nom_utilisateur = $nom;
   }
   public function getNomUtilisateur(){
    return $this->nom_utilisateur;
   }

   public function setMotDePasse($mdp){
     $this->mot_de_passe = $mdp;
   }
   public function getMotDePasse(){
    return $this->mot_de_passe;
   }

   public function setEmail($adresseEmail){
     $this->email = $adresseEmail;
   }
   public function getEmail(){
    return $this->email;
   }

   public function setAdresse($adresseMaison){
     $this->adresse =  $adresseMaison;
   }
   public function getAdresse(){
    return $this->adresse;
   }

   public function setTelephone($tel){
     $this->telephone =  $tel;
   }
   public function getTelephone(){
    return $this->telephone;
   }
}
 ?>
