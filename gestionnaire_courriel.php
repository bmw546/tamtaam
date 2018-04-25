<?php
/****************************************
Fichier : gestionnaire_courriel.php
Auteur : Marc-Étienne Pépin
Fonctionnalité : Sert Recupérer les information du forumlaire HTML
 * et de les formatter et envoyer a la fonction envoyer une email

Date : 2018-04-23

Vérification :
Date               Nom                   Approuvé
===========================================================



Historique de modifications :
Date               Nom                   Description
===========================================================
2018-04-24	Marc-Étienne		Tout a été refait. (il marche finalement)
2018-04-25      Marc-Étienne            Ajoute de commentaire, Changement de nom.
 *
 *
 *
 *
 *
 *
 ****************************************/
class mail{

    /**
     * @param $nom          Le nom de qui le courriel vient
     * @param $courriel     Le courriel de qui le courriel provient
     * @param $sujet        Le sujet du courriel
     * @param $corps        Le body du email
     * précondition: $nom,$courriel,$sujet et $question doivent être non null.
     * (le programme peut runner correctement sans $nom et $ courriel mais il sera bizarre)
     */
    function sentMail($nom, $courriel, $sujet, $corps){
        $header="MIME-Version: 1.0\r\n";
		$header.='From:"'.$nom.'"<'.$courriel.'>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		//$sujet .= "  provient de :  ".$nom;
        $corps .= " provient de l'adresse email suivant : " . $courriel;
		mail("marc-etienne-pepin@hotmail.com",$sujet,$corps,$header);
		echo "bravo 33";
    }
	

}
?>