<!--****************************************
Fichier : UIgestCommandes.html
Auteur : Joel Lapointe
Fonctionnalité : Gestion des commandes
Date : 2018-04-23

Vérification :
Date                    Nom 		    Approuvé
=========================================================

Historique de modifications :
Date                    Nom                 Description
=========================================================
2018-04-25              Joel Lapointe       Enlever le numéro de commande
****************************************-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Gestion des commandes</title>
        <script src="tamtam.js"></script>
        <link rel="stylesheet" href="style.css" />
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <body style="margin:auto; width:950px;" onload="updateDate(dateAujourdhui()),valeur(),updateTotal(),commencer(7)">
        <header>
            <h1 style="text-align:center;"><i>Gestion des commandes</i></h1>
        </header>

        <form id="formUser" action="CtrlCommandes.php" method="post" style="padding:20px; border:solid black;">
            <br>
            <label for="nom" style="padding-right:37px;"><b>Nom :</b></label>
            <input type="text" name="nom" id="nom" size="30" required/>

            <label for="date" style="padding-left:188px;"><b>Date :</b></label>
            <input type="text" name="date" id="date"  size="30" readonly />
            <br><br>

            <label for="adresse"style="padding-right:17px;"><b>Adresse :</b></label>
            <input type="text" name="adresse" id="adresse" size="30" required/>
            <br><br>

            <input type="radio" name="livraison" checked<?php if (isset($livraison) && $livraison=="1");?> value = "1">   Livraison<br>
            <input type="radio" name="livraison" <?php if (isset($livraison) && $livraison=="2");?> value = "2"> Ramassage en magasin<br>
            <br><br>

            <table  style="width:60%">
                <tr>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Montant</th>
                </tr>
                <?php //Code php pour charger les produits de la BD
                require_once 'MoteurRequeteBD.php';

                $connection = new Connexion();
                $query  = "SELECT COUNT(*) FROM `produit`";
                $result = array();
                $result = $connection->execution_avec_return($query);
                $nbProduit = $result[0][0];

                $query2 = "SELECT * FROM `produit`";
                $result = $connection->execution_avec_return($query2);

                for ($x =0; $x < $nbProduit; $x++){
                    $produit = $result[$x];
                    $qty = "qty"."$x";
                    $nb = $qty."nb";
                    $mnt = "mnt"."$x";
                    //$price = number_format($produit[3],2);
                    echo "<tr>";
                        echo "<td>".$produit[0]."</td>";
                        echo "<td>" .$produit[1]. "</td>" ;
                        echo "<td align='center'>" . $produit[2]. "</td>" ;
                        echo "<td align='right' > <span class='argent'> <input name=$qty id='$nb' type=\"text\" maxlength=\"2\"  size=\"2\" value=$produit[3] readonly > $</span> </td>";
                        echo "<td align='center'> <input name=qty[] id='$qty' type=\"number\" min=\"0\"  max=\"99\" value=0> </td>";
                        echo "<td align='center'> <span class='argent'> <input name=$mnt id='$mnt' type=\"text\" maxlength=\"6\" size=\"6\"  readonly>$</span> </td>" ;
                    echo "</tr>";
                }
                ?>
            </table>
            <br><br>
            <label  style="padding-right:37px;"><b>Sous-Total :</b></label>
            <span class='argent'>
                <input  type="text" maxlength="6" size="6" id="sous_total" readonly"> </input>
            $</span>
            <br><br>

            <label  style="padding-right:42px;"><b>Livraison :</b></label>
            <span class='argent'>
                   <input  type="text" maxlength="6" size="6" id="livraison" readonly"> </input>
            $</span>
            <br><br>

            <label  style="padding-right:72px;"><b>Total :</b></label>
            <span class='argent'>
                <input  name="montant" id="total" type="text" maxlength="6" size="6" readonly"> </input>
            $</span>
            <br><br><br><br>

            <input  style="margin-left:80px; margin-right:80px; background-color:black; color:white; border-color:black;" name="commander" type="submit" value="Commander"/>
            <button style="background-color:black; color:white; border-color:black;" name="cancel" value="Annuler">Annuler</button>
        </form>
    </body>
</html>