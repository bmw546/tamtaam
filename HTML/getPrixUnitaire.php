
<?php
require_once 'MoteurRequeteBD.php';

$nomProduit = $_POST['produit'];
$description = $_POST['qty'];
$connection = new Connexion();
$query  = "SELECT prix FROM produit WHERE nom = '$nomProduit' AND description ='$description'";
$result = $connection->execution_avec_return($query);

echo $result[0][0];

?>