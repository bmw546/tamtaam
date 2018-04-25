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

include_once 'connection.php';
require_once 'gestionnaire_courriel.php';
include_once 'Utilisateur.php';


class Authentification{

  private $utilisateur;
  private $connexion;
  private $etat;
  private $courriel;

  //constructeur sans paramètre
  public function __construct(){
    $this->courriel    = new mail();
    $this->utilisateur = new Utilisateur("", "", "", "", "");
    $this->connexion   = new Connexion;
    $this->etat        = "";
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
  public function validationAuthentification($nom_utilisateur, $mot_de_passe)
  {
    //DANS connect.php, je vais surement devoir utiliser la fonction executewithresult.
    //Pour le moment, j'utilise execute que j'ai modifié comme celle d'en bas pour
    //pas me casser la tête for now et passer à autre chose


  /*  // executeur de code SQL
    public function execute($sql){
        $this->connect();
        $result = mysqli_query($this->conn,$sql);
        $this->disconnect();

        return $result;
    }*/

    //2.marche pas quand je mets directement "$this->utilisateur->getNomUtilisateur()" dans le WHERE
    $result = $this->connexion->execute("SELECT * FROM client WHERE nom_utilisateur = '$nom_utilisateur'");

    //si il y a un résultat
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id_client"]. " - Username: " . $row["nom_utilisateur"]. " Password: " . $row["mot_de_passe"]. "<br>";

          //si le mot de passe ne correspond pas au bon mot de passe
          if ($row["mot_de_passe"] != $mot_de_passe) {
            $this->setEtat('Mauvais mot de passe');
          }
          //sinon les informations sont bonnes
          else {
            $this->setEtat('Authentification réussie');
            $this->utilisateur->setNomUtilisateur($row["nom_utilisateur"]);
            $this->utilisateur->setMotDePasse($row["mot_de_passe"]);
            $this->utilisateur->setEmail($row["adresse_email"]);
            $this->utilisateur->setAdresse($row["adresse"]);
            $this->utilisateur->setTelephone($row["telephone"]);
          }
      }

    }
    //s'il n'y a aucun résultat pour le nom d'utilisateur
    else {
      $this->setEtat('Mauvais nom d\'utilisateur');
    }
  }

  public function motDePasseOublie($email)
  {

    $result = $this->connexion->execute("SELECT * FROM client WHERE adresse_email = '$email'");
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

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

  public function nomUtilisateurOublie($email)
  {
    $result = $this->connexion->execute("SELECT * FROM client WHERE adresse_email = '$email'");
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

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
