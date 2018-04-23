<?php

class Connexion
{
  private $conn;
  private $nom_serveur = "localhost";
  private $nom_utilisateur_bd ="root";
  private $mot_de_passe_bd ="";
  private $nom_bd ="tamtaam";
/* shall we destroy this ?
  public function __construct()
  {
    $this->nom_serveur =
    $this->nom_utilisateur_bd = "root";
    $this->mot_de_passe_bd = "";
    $this->nom_bd = "tamtaam";
  }
*/

// setteur et getteur ==================================================================================================
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
// setteur et getteur ==================================================================================================
// function pour operer cette class ====================================================================================
// connection
    private function connect(){

        // Créer connexion
        $this->conn = new mysqli($this->nom_serveur, $this->nom_utilisateur_bd, $this->mot_de_passe_bd, $this->nom_bd);

        // Vérifier connexion
        if ($this->conn->connect_error) {
            die("La connexion a échouée: " . $this->conn->connect_error);
        }
        else {
            echo "La connexion a réussi";
        }
    }

	// deconnection
  private function disconnect(){
  	echo "Déconnexion";
    $this->conn->close();
  }

  // executeur de code SQL
	public function executewithresult($sql){
  	$this->connect();
  	$response = array();
  	$result = mysqli_query($this->conn,$sql);
        while($row = mysqli_fetch_array($result))
        {
            echo "one more line of result done ";
            $response[] = $row;
        }
  	$this->disconnect();
    print_r($response);
    }
    // executeur de code SQL
    public function execute($sql){
        $this->connect();
        mysqli_query($this->conn,$sql);
        $this->disconnect();
    }
}
?>
