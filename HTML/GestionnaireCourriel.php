<?php
/*******************************************************************************
Fichier : GestionnaireCourriel.php
Auteur : Marc-Étienne Pépin, Roméo Tsarafodiana-Bugeaud
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
                 et de les formatter et envoyer a la fonction
                 envoyer une email.
Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
===========================================================
2018-04-29         Rémi Létourneau       Oui

Historique de modifications :
Date            Nom                   Description
===========================================================
2018-04-24      Marc-Étienne	       Tout a été refait. (il marche finalement)
2018-04-25      Marc-Étienne          Ajoute de commentaire, Changement de nom.
2018-04-25      Roméo                 Rajouté le type de mail
 *******************************************************************************/
class GestionnaireCourriel {

    private $type;

    public function __construct(){
      $this->type = "commentaire";
    }

    /**
     * @param $type    String Le type de courriel qu'on veut envoyer
     */
    public function setType($type){
      $this->type = $type;
    }

    /**
     * @param $nom       String Le nom de qui le courriel vient
     * @param $courriel  String Le courriel de qui le courriel provient
     * @param $sujet     String Le sujet du courriel
     * @param $corps     String Le body du email
     * (Precondition: $nom != null && $courriel != null && $sujet != null && $question != null)
     */
    function sentMail($nom, $courriel, $sujet, $corps){
    $header="MIME-Version: 1.0\r\n";
		$header.='From:"'.$nom.'"<'.$courriel.'>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		//$sujet .= "  provient de :  ".$nom;

     if ($this->type == "commentaire"){
      $corps .= " provient de l'adresse email suivant : " . $courriel;
      $courriel = "tamtaamsherbrooke@gmail.com";
     }

		 mail($courriel,$sujet,$corps,$header);
     }
}
?>
