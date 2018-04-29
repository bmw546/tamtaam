<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Gestion des rabais</title>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <body style="margin:auto; width:950px;">
        <header>
            <h1 style="text-align:center;"><i>Gestion des rabais</i></h1>
        </header>

            <p>
                <label >Produit: </label >

                    <?php
                    echo '<form name="form1" method="post" action="ui_rabais_.php" onselect="this.submit();">';
                    $value1 = 0;
                    echo '<select  name="select1" onchange="form1.submit()">';
                    include("MoteurRequeteBD.php");
                    $connect = new Connexion();
                    $sql = "SELECT * FROM `produit`";
                    $result = array();
                    $result = $connect->execution_avec_return($sql);
                    $i = 0;
                    foreach($result as $value){

                        echo "<option value=$i>" . $value[1] . "</option>";
                        $i +=1 ;
                    }
                    echo '</select>';
                    echo '</form>';
                    $w = $_POST['select1'];
                    $produit = $result[$w][1];
                    $prix = $result[$w][3];
                    ?>
            </p>
                <label for="Produit">Prix original: </label>
                <label> <?php echo $prix; ?> </label>
                <form action="CtrlSuggestions.php" method="post">
                     <p>
                         <label for="code">Code: </label>
                         <input type="text" name="code" id="code" required/>
                     </p>
                    <p>
                        <label for="Rabais">Rabais: </label>
                        <input type="text" name="Rabais" id="Rabais" required/>
                        <input type="radio" name="rabais" id="rabais1" value="%" required/>
                        <label for="rabais1">%  </label>
                        <input type="radio" name="rabais" id="rabais2" value="$" required/>
                        <label for="rabais2">$  </label>
                    </p>
                    <p>
                        <label for="Date">Date: </label>
                        <input type="text" name="Date" id="Date" required/>
                    </p>
                    <p>
                        <label for="Prix après rabais">Prix après rabais </label>
                        <label> <?php echo $prix; ?> </label>
                    </p>
                    <p>
                        <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="Ajouter" type="submit" value="Ajouter"/>
                        <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="Modifier" type="submit" value="Modifier"/>
                        <input  style="margin-left:80px; margin-right:30%; background-color:black; color:white; border-color:black;" name="supprimer" type="submit" value="supprimer"/>
                    </p>
                </form>
    </body>
</html>