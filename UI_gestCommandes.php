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
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <body style="margin:auto; width:950px;">
        <header>
            <h1 style="text-align:center;"><i>Gestion des commandes</i></h1>
        </header>

        <form id="formUser" action="CtrlCommandes.php" method="post" style="padding:20px; border:solid black;">
            <br>
            <label for="nom" style="padding-right:37px;"><b>Nom :</b></label>
            <input type="text" name="nom" id="nom" size="30" required/>

            <label for="date" style="padding-left:188px;"><b>Date :</b></label>
            <input type="text" name="date" id="date"  size="30" disabled/>
            <br><br>


            <label for="adresse"style="padding-right:17px;"><b>Adresse :</b></label>
            <input type="text" name="adresse" id="adresse" size="30" required/>
            <br><br>

            <input type="radio" name="livraison" value="Livraison" checked required> Livraison<br>
            <input type="radio" name="livraison" value="Ramassage"> Ramassage en magasin<br>
            <br><br>

            <table  style="width:60%">
                <tr>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Ajouter</th>
                </tr>
            </table>
            <br><br>

            <label  style="padding-right:37px;"><b>Livraison :</b></label>
            <br><br>

            <label  style="padding-right:37px;"><b>Total :</b></label>
            <br><br>

            <input  style="margin-left:80px; margin-right:80px; background-color:black; color:white; border-color:black;" name="commander" type="submit" value="Commander"/>
            <button style="background-color:black; color:white; border-color:black;" name="cancel" value="Annuler">Annuler</button>
        </form>
    </body>
</html>