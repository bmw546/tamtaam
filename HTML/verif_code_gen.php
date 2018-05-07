<?php
/*************************************************************************
Fichier : verif_code_gen.php
Auteur :  Rémi Létourneau
But : Créer l'image pour le captcha (nouvelle fonctionnalité)
Date : 2018-05-02

Vérification :
Date                    Nom 		    Approuvé
=========================================================

 *************************************************************************/
session_start();

$nbr_chiffres = 6;

header("Content-type: image/png");

$_img = imagecreatefrompng('image/fond_verif_img.png');

$arriere_plan = imagecolorallocate($_img, 0,0,0);

$avant_plan = imagecolorallocate($_img, 255,255,255);

### Ici création variable contenant le nombre aléatoire
$i = 0;
while($i < $nbr_chiffres){
    $chiffre = mt_rand(0,9); //on genere le nombre aléatoire
    $chiffres[$i] = $chiffre;
    $i++;
}
$nombre = null;

//pour chaque chiffre dans le tableau , on concatene dans une variable
foreach ($chiffres as $caractere){
    $nombre .= $caractere;
}

#### fini de creér nombre aletoire, on rentre dans variable session
$_SESSION['aleat_nbr'] = $nombre;

//destruction des variable inutile :
unset($chiffre);
unset($i);
unset($caractere);
unset($chiffres);

#### envoie le nombre dans l'image
imagestring($_img, 5, 18, 8, $nombre, $avant_plan);
imagepng($_img);
?>