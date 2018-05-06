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
    <body style="margin:auto; width:950px;" onload="updateDate(dateAujourdhui())">
    <nav class="entete col-12">
        <img src="HTML/image/logo.png" alt="logo"/>
        <ul>
            <li class="menu col-2 col-t-2"><a href="https://tamtaam.com/">Accueil</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
        </ul>
    </nav>
    <header>
            <h1 style="text-align:center;"><i>Placer une commande</i></h1>
        </header>
    <!-- ------------------------- section pour shadow box -------------------------->
    <div id="lightBoxBg" class="lightBoxBg" onclick="stop()">
    </div>
    <div id="Gingembre" class="lightBox">
        <img src="image/gimger.jpg"/>
    </div>
    <div id="Hibiscus" class="lightBox">
        <img src="image/HIBISCUS.jpg"/>
    </div>
    <!-- ------------------- FIN DE LA SECTION SHADOW BOX --------------------------->

        <form id="_Commandes" action="CtrlCommandes.php" method="post" style="padding:20px; border:solid black;">
            <br>
            <label for="nom" style="padding-right:37px;"><b>Nom :</b></label>
            <input type="text" name="nom" id="nom" size="30" required/>

            <label for="date" style="padding-left:188px;"><b>Date :</b></label>
            <input type="text" name="date" id="date"  size="30" readonly />
            <br><br>

            <label for="adresse"style="padding-right:17px;"><b>Adresse :</b></label>
            <input type="text" name="adresse" id="adresse" size="50" required/>
            <br><br>

            <input type="radio" name="livraison" required<?php if (isset($livraison) && $livraison=="1");?> value = "1">   Livraison<br>
            <input type="radio" name="livraison" <?php if (isset($livraison) && $livraison=="2");?> value = "2"> Ramassage en magasin<br>
            <br><br>



            <table  id='tblCommandes' style="width:60%">
                <tr>
                    <th>Nom</th>
                    <th>Format</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Montant</th>
                    <th>Action</th>
                    <th> Image du produit </th>
                </tr>

                <?php
                require_once 'MoteurRequeteBD.php';
                    echo "<tr id='r1'>
                        <td><select name=listeProduit[] id='l1'>
                        <option disabled selected>--Choisir un produit--</option>";

                    $connection = new Connexion();
                    $query  = "SELECT DISTINCT  nom FROM `produit` ORDER BY nom";
                    $result = $connection->execution_avec_return($query);
                    $i=0;
                    foreach ($result as $rs) {
                        echo "<option value='$rs[0]'>$rs[0]</option>";
                    }
                       ?>

                  <script> var array_produit = <?php echo json_encode($result);?>;</script>

                <?php
                    echo "</select></td>";
                    echo "<td><select name='format[]' id='f1'>
                              <option disabled selected>--Choisir un format-- </option></select>";
                    echo "<td align='right' ><input name='prix[]' id ='p1' type=\"text\" maxlength=\"4\"  size=\"4\" value=0 readonly>"."</td>";
                    echo "<td align='center'><input name ='qty[]' id ='q1' type=\"number\" min=\"0\"  max=\"99\" value=0 disabled>  "."</td>";
                    echo "<td align='center'><input  name='montant[]' id ='m1' type=\"text\" maxlength=\"6\" size=\"6\" readonly>". "</td>" ;
                    echo "<td><input id='s1' type='button' value='Supprimer' disabled hidden  ></td>";
                    echo "<td align='center'><input id='i1' style='width:100%;'type='button'value='Image' onclick=\"lightbox()\"/>   </input></td>";
                $query = ""
                ?>
            </table>

            <input type="button" id="nouvProduit" href="#" id="addScnt" value="Ajouter un produit " onclick="ajouterLigne('tblCommandes',array_produit)"> </input>


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
            <input id="_soustotal" type="text" maxlength="6" size="6" readonly"> </input>
            <br><br>

            <label  style="padding-right:42px;"><b>Livraison :</b></label>
            <input  type="text" maxlength="6" size="6" id="livraison" readonly"> </input>
            <br><br>

            <label  style="padding-right:72px;"><b>Total :</b></label>
            <input  id='_total' type="text"  maxlength="6" size="6" readonly"> </input>
            <br><br><br><br>

            <input  style="margin-left:80px; margin-right:80px; background-color:black; color:white; border-color:black;" name="commander" type="submit" value="Commander"/>
            <button style="background-color:black; color:white; border-color:black;" type='reset' name="cancel" value="Annuler">Annuler</button>

            <script src="http://code.jquery.com/jquery-3.3.1.js"> </script>
            <script src="tamtam.js"> </script>
        </form>
    </body>
</html>

