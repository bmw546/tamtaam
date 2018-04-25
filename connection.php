<?php
/*************************************************************
Fichier : connection.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert à ce connecter à la base de donnée,
				 execute un code sql qui retourne un resultset
				 ou pas et finalement se déconnecter de la BD.
Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
===========================================================



Historique de modifications :
Date               Nom                   Description
===========================================================
2018-04-23			Roméo                Version Pre- 1.0

************************************************************/

/*
  / ____/ __ \| \ | | \ | |  ____/ ____|__   __|  ____|  |  __ \| |  | |  __ \
 | |   | |  | |  \| |  \| | |__ | |       | |  | |__     | |__) | |__| | |__) |
 | |   | |  | | . ` | . ` |  __|| |       | |  |  __|    |  ___/|  __  |  ___/
 | |___| |__| | |\  | |\  | |___| |____   | |  | |____   | |    | |  | | |
  \_____\____/|_| \_|_| \_|______\_____|  |_|  |______|  |_|    |_|  |_|_|
*/
class Connexion
{
    private $conn;
    private $nom_serveur;
    private $nom_utilisateur_bd;
    private $mot_de_passe_bd;
    private $nom_bd;

	public function __construct()
	{
		$this->nom_serveur  = "localhost";
		$this->nom_utilisateur_bd = "root";
		$this->mot_de_passe_bd = "";
		$this->nom_bd = "tamtaam";
	}


//=============== setteur et getteur =====================
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

// ============================== Méthode de la classe ==============================

	/**
	* Connecte à la base de donnée
	*/
    private function connexion(){

        // Créer connexion
        $this->conn = new mysqli($this->nom_serveur, $this->nom_utilisateur_bd, $this->mot_de_passe_bd, $this->nom_bd);

        // Vérifier connexion
        if ($this->conn->connect_error) {
            die(" La connexion a échouée: " . $this->conn->connect_error);
        }
        else {
            echo " La connexion a réussi ";
        }
    }

	/**
	* Déconnecte de la base de donnée
	*/
    private function deconnexion(){

        echo " Déconnexion ";
        $this->conn->close();
    }

    /**
	*  Execute du code SQL et retourne une array d'array de réponse
	*/
    public function execution_avec_return($sql){

        $this->connexion();
        $response = array();
        // test
        //$sql = "SELECT * FROM `client` WHERE 1";
        $result = mysqli_query($this->conn,$sql);
			/*
			 ________  ________  ________     
			|\   __  \|\   __  \|\   __  \    
			\ \  \|\ /\ \  \|\  \ \  \|\  \   
			 \ \   __  \ \  \\\  \ \  \\\  \  
			  \ \  \|\  \ \  \\\  \ \  \\\  \ 
			   \ \_______\ \_______\ \_______\
				\|_______|\|_______|\|_______|
			*/
        if ($result){


            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
        }
		else {
           $result = null;

        }
        $this->deconnexion();
        //print_r($response);
        return $response;
         // ligne à enlever si vous voulez pas que cela print (mais utile pour les test)

    }


	  //Execute du code SQL sans retour
    public function execution($sql){

        $this->connexion();
        mysqli_query($this->conn,$sql);
        $this->deconnexion();
    }
    /*
    //temporaire
    public function execute($sql){
        $this->connexion();
        $result = mysqli_query($this->conn,$sql);
        $this->deconnexion();

        return $result;
    }
    */
}
?>
