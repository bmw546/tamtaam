<?php
class mail{
    function sentMail($nom,$courriel,$sujet,$question){
        $header="MIME-Version: 1.0\r\n";
		$header.='From:"'.$nom.'"<'.$courriel.'>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		//$sujet .= "  provient de :  ".$nom;
		$question .= " provient de l'adresse email suivant : " . $courriel;
		mail("marc-etienne-pepin@hotmail.com",$sujet,$question,$header);
		echo "bravo 33";
    }
	

}
?>