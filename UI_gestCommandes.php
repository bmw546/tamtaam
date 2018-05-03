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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="tamtam.js"></script>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <body style="margin:auto; width:950px;" onload="updateDate(dateAujourdhui()),test()">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="tamtam.js"></script>
    <header>
            <h1 style="text-align:center;"><i>Placer une commande</i></h1>
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



            <table  id='tblCommandes' style="width:60%">
                <tr>
                    <th>Nom</th>
                    <th>Format</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Montant</th>
                    <th></th>
                </tr>

                <?php
                require_once 'MoteurRequeteBD.php';
                    echo "<tr>
                        <td><select name=listeProduit id=listeProduit onchange='loadFormat()'>
                        <option disabled selected>--Choisir un produit--</option>";

                    $connection = new Connexion();
                    $query  = "SELECT DISTINCT  nom FROM `produit` ORDER BY nom";
                    $result = $connection->execution_avec_return($query);

                    $i=0;
                    foreach ($result as $rs){
                        echo "<option value='$i'>$rs[0]</option>";
                    }
                    echo "</select></td>";


                    echo "<td><select name=format id='format'>
                              <option disabled selected>--Choisir un format-- </option></select>";





                    echo "<td align='right' ><input type=\"text\" maxlength=\"2\"  size=\"2\" value=0 readonly>$"."</td>";
                    echo "<td align='center'><input type=\"number\" min=\"0\"  max=\"99\" value=0>  "."</td>";
                    echo "<td align='center'><input type=\"text\" maxlength=\"6\" size=\"6\"  readonly>". "</td>" ;
                    echo "<td align='center'> <button>Supprimer</button>";
                $query = ""
                ?>
            </table>
                <div class="control-group">
                    <div id="produit"class="controls">
                        <input type="combobox" name="produit[]">
                    </div>
                    <button id="nouvProduit" href="#" id="addScnt" onclick="ajouterLigne(tblCommandes)">Ajouter un produit</button>
                </div>

<!--                --><?php ////Code php pour charger les produits de la BD
//                require_once 'MoteurRequeteBD.php';
//
//                $connection = new Connexion();
//                $query  = "SELECT COUNT(*) FROM `produit`";
//                $result = array();
//                $result = $connection->execution_avec_return($query);
//                $nbProduit = $result[0][0];
//
//                $query2 = "SELECT * FROM `produit`";
//                $result = $connection->execution_avec_return($query2);
//
//                for ($x =0; $x < $nbProduit; $x++){
//                    $produit = $result[$x];
//                    $qty = "qty"."$x";
//                    $nb = $qty."nb";
//                    $mnt = "mnt"."$x";
//                    $price = number_format($produit[3],2);
//                    echo "<tr>";
//                        echo "<td>" .$produit[1]. "</td>" ;
//                        echo "<td align='center'>" . $produit[2]. "</td>" ;
//                        echo "<td align='right' >"."<input name=$qty id='$nb' type=\"text\" maxlength=\"2\"  size=\"2\" value=$price readonly >  "." $"."</td>"    ;
//                        echo "<td align='center'>"."<input name=qty[] id='$qty' type=\"number\" min=\"0\"  max=\"99\" value=0>  "."</td>";
//                        echo "<td align='center'>" ."<input name=$mnt id='$mnt' type=\"text\" maxlength=\"6\" size=\"6\"  readonly>". "</td>" ;
//                    echo "</tr>";
//                }
//                ?>
            </table>
            <br><br>
            <label  style="padding-right:37px;"><b>Sous-Total :</b></label>
            <input  type="text" maxlength="6" size="6" id="sous_total" readonly"> </input>
            <br><br>

            <label  style="padding-right:42px;"><b>Livraison :</b></label>
            <input  type="text" maxlength="6" size="6" id="livraison" readonly"> </input>
            <br><br>

            <label  style="padding-right:72px;"><b>Total :</b></label>
            <input  name="montant" id="total" type="text" maxlength="6" size="6" readonly"> </input>
            <br><br><br><br>

            <input  style="margin-left:80px; margin-right:80px; background-color:black; color:white; border-color:black;" name="commander" type="submit" value="Commander"/>
            <button style="background-color:black; color:white; border-color:black;" name="cancel" value="Annuler">Annuler</button>
        </form>
    </body>
</html>