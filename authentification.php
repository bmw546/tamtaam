<?php

/****************************************
 Fichier : authentification.php
 Auteur : Roméo Tsarafodiana-Bugeaud
 Fonctionnalité : authentification du client vers la base de donnée
 Date : 2018-04-23
 Vérification :
 Date Nom Approuvé
 =========================================================
 Historique de modifications :
 Date Nom Description
 =========================================================
****************************************/

include_once 'connexion.php';
include_once 'utilisateur.php';

class Authentification{

  private $utilisateur;
  private $connexion;
  private $etat;

  //constructeur sans paramètre
  public function __construct(){

    $this->utilisateur = new Utilisateur;
    $this->connexion = new Connexion;
    $this->etat = "";
  }

  //modifier l'utilisateur qu'on veut connecter
  public function setUtilisateur($u){
    $this->utilisateur = $u;
  }
  //retourner l'utilisateur qu'on veut connecter
  public function getUtilisateur(){
    return $this->utilisateur;
  }

  //retourne l'état de l'authentification (réussie, mauvais mdp, mauvais username)
  public function getEtat(){
		return $this->etat;
	}
	public function setEtat($etat){
		$this->etat = $etat;
	}

  //retourne vrai si les infos d'authentification sont bonnes
  public function validationAuthentification()
  {
    //1.va manquer a prendre le username/password dans les variables de la classe a partir du formulaire
    //2.marche pas quand je mets directement "$this->utilisateur->getNomUtilisateur()" dans le WHERE
    //3.le code marche sur une vielle bd, va manquer à l'adapter à la nouvelle bd quand elle sera crée (pas long)

    $this->connexion->connexion();

    $nom =  $this->utilisateur->getNomUtilisateur();
    $sql = "SELECT * FROM client WHERE nom = '$nom'";
    $result = $this->connexion->getConn()->query($sql);

    //si il y a un résultat
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id"]. " - Name: " . $row["nom"]. " " . $row["prenom"]. "<br>";

          //si le mot de passe ne correspond pas au bon mot de passe
          if ($row["prenom"] != $this->utilisateur->getMotDePasse()) {
            $this->setEtat('Mauvais mot de passe');
          }
          //sinon les informations sont bonnes
          else {
            $this->setEtat('Authentification réussie');
          }
      }
    }

    //s'il n'y a aucun résultat pour le nom d'utilisateur
    else {
      $this->setEtat('Mauvais nom d\'utilisateur');
    }

    $this->connexion->getConn()->close();
  }
}
?>
