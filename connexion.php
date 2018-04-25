<?php

class Connexion
{
  private $conn;
  private $nom_serveur;
  private $nom_utilisateur_bd;
  private $mot_de_passe_bd ;
  private $nom_bd;

  public function __construct()
  {
    $this->nom_serveur = "localhost";
    $this->nom_utilisateur_bd = "root";
    $this->mot_de_passe_bd = "";
    $this->nom_bd = "php1";
  }

  public function connexion(){

    // Créer connexion
    $this->conn = new mysqli($this->nom_serveur, $this->nom_utilisateur_bd, $this->mot_de_passe_bd, $this->nom_bd);

    // Vérifier connexion
    if ($this->conn->connect_error) {
        die("La connexion vers la bd a échouée: " . $this->conn->connect_error);
        echo "<br>";
    }
    else {
      echo "La connexion vers la bd a réussie";
      echo "<br>";
    }
  }

  public function getConn(){
		return $this->conn;
	}

	public function setConn($conn){
		$this->conn = $conn;
	}

	public function getNom_serveur(){
		return $this->nom_serveur;
	}

	public function setNom_serveur($nom_serveur){
		$this->nom_serveur = $nom_serveur;
	}

	public function getNom_utilisateur_bd(){
		return $this->nom_utilisateur_bd;
	}

	public function setNom_utilisateur_bd($nom_utilisateur_bd){
		$this->nom_utilisateur_bd = $nom_utilisateur_bd;
	}

	public function getMot_de_passe_bd(){
		return $this->mot_de_passe_bd;
	}

	public function setMot_de_passe_bd($mot_de_passe_bd){
		$this->mot_de_passe_bd = $mot_de_passe_bd;
	}

	public function getNom_bd(){
		return $this->nom_bd;
	}

	public function setNom_bd($nom_bd){
		$this->nom_bd = $nom_bd;
	}

  public function deconnexion(){

    $this->conn->close();
  }
}
?>
