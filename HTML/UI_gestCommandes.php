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
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/pageTransition.css" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
        <title>Placer une commande</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="tamtam.js"></script>
    </head>
    <body class="inscriptionBody" onload="updateDate(dateAujourdhui())">

    <nav class="entete col-12">
        <img src="image/logo.png" alt="logo"/>
        <ul>
            <li class="menu col-2 col-t-2"><a href="https://tamtaam.com/">Accueil</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
            <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
        </ul>
    </nav>

    <section class="sectionInscription col-12">
        <div class="inscriptionheader"><i>Placer une commande</i></div>
        <!-- ------------------------- section pour shadow box -------------------------->
        <?php
        require_once 'MoteurRequeteBD.php';
        $connection = new Connexion();
        $query  = "SELECT image, nom FROM produit";
        $result = $connection->execution_avec_return($query);

        ##$nbimage = mysqli_num_rows($result);
        ##<?php echo $nbimage
        ?>
        <div id="lightBoxBg" class="lightBoxBg" onclick="stop()">
        </div>
        <?php
        foreach ($result as $row){
            echo '<div id='.$row['nom'].' class="lightBox"> 
                <img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>
                </div>';
        }

        ?>
<!-- ------------------- FIN DE LA SECTION SHADOW BOX --------------------------->

            <form class="centerForm formInscription" id="_Commandes" action="CtrlCommandes.php" method="post">

                <label class="label" for="date" ><b>Date :</b></label>
                <input type="text" name="date" id="date"  size="30" readonly />
                <br><br>

                <label class="label" for="nom" ><b>Nom :</b></label>
                <input type="text" name="nom" id="nom" size="30" required/>
                <br><br>

                <label class="label" id="_adresse"for="_txtAdresse"><b>Adresse :</b></label>
                <?php
                session_start();
                require_once 'utilisateur.php';
                if (isset($_SESSION['utilisateur'])) {
                $usr = unserialize($_SESSION['utilisateur']);
                $adr = $usr->getAdresse();
                ?> <input type="text" id="_txtAdresse" name="adresse" value="<?php echo $adr?>" readonly size="40" required />       <?php
                }else{

                    ?>
                    <input type="text" id="_txtAdresse" name="adresse" placeholder="32 rue du cegep, Sherbrooke, Qc, J1E 4E2" size="36" required
                     onblur="check('_txtAdresse', '_adresse', /((([0-9]+))(\w+(\s\w+){2,})(,)?(\s{0,})([a-z]{0,})(\s{0,})(,)?(\s{0,})([a-z]{0,})(,)?(\s)([a-z][0-9][a-z] ?[0-9][a-z][0-9])|(([a-z][0-9][a-z])-([0-9][a-z][0-9]))|([a-z][0-9][a-z][0-9][a-z][0-9]))/i)"/>
                    <?php
                } ?>
                <br><br>

                <input type="radio" id="livrer" name="livraison" required<?php if (isset($livraison) && $livraison=="1");?> value = "1">
                <label for="livrer">Livraison</label><br>
                <input type="radio" id="magasin" name="livraison" <?php if (isset($livraison) && $livraison=="2");?> value = "2">
                <label for="magasin">Ramassage en magasin</label><br>
                <br><br>

                <table class="tbl" id='tblCommandes' style="width:60%">
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
                echo "<td align='center'><input id='i1' style='width:100%;'type='button'value='Image' \"/>   </input></td>";
                $query = ""
                ?>
                </table>

                <input class="btnInscrire btnStyle" type="button" id="nouvProduit" value="Ajouter un produit" onclick="ajouterLigne('tblCommandes',array_produit)">

                <br><br>
                <label for="_soustotal" class="label" ><b>Sous-Total :</b></label>
                <input id="_soustotal" type="text" maxlength="6" size="6" readonly>
                <br><br>

                <label for="livraison" class="label"><b>Livraison :</b></label>
                <input  type="text" maxlength="6" size="6" name="livraison" id="livraison" readonly>
                <br><br>

                <label  for="_total" class="label"><b>Total :</b></label>
                <input  id='_total' name='total' type="text"  maxlength="6" size="6" readonly>
                <br><br><br><br>

                <input  class="btnInscrire btnStyle" name="commander" id="_btnCommander" type="submit" value="Commander" disabled/>
                <button class="btnInscrire btnStyle" type='reset' name="cancel" value="Annuler">Effacer</button>
                <button class="btnInscrire btnStyle" onclick="location.href='menu.php'" type="button">Retour au menu</button>

                <!-- message qui indique l'état de la commande -->
                <div class="inscrireFooter">
                    <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "commande") == true) {
                        echo "<p class='greenText'>". "La commande a été envoyé avec succès."."</p>";
                    }

                    ?>
                </div>

                <script src="http://code.jquery.com/jquery-3.3.1.js"> </script>
                <script src="tamtam.js"> </script>
            </form>
        </section>
    </body>
</html>

