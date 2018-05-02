<!Doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ma page Web</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <script src="tamtam.js"></script>
</head>
<body onload="updateDate(dateAujourdhui())">
<nav class="entete col-12">
    <img  src="image/logo.png" alt="logo"/>
    <ul>
        <li class="menu col-2 col-t-2"><a href="#">Accueil</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nos produits</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">En savoir plus</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Points de ventes</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="#">Nous joindre</a></li>
    </ul>
</nav>

<form>
    <span> Bienvenue
        <?php
        require_once '../Utilisateur.php';
        session_start();


        if (isset($_SESSION['utilisateur'])){
            $usr = unserialize($_SESSION['utilisateur']);
            echo $usr->getNomUtilisateur();
        }
        ?>
    </span>
    <label class="labelDate" for="date"><b>Date :</b></label>
    <input type="text" name="date" id="date"  size="30" readonly/>

    <input type="hidden" name="date" id="id"  size="30" readonly />
    <input type="hidden" name="date" id="nom"  size="30" readonly />
</form>

<div class="container">
    <img class="container" src="https://tamtaam.com/wp-content/uploads/2017/05/wordpress-goole-optimisation-image-referencement_16.jpg" alt="image" />
</div>
<div>
    <ul>

        <?php

        if (isset($_SESSION['utilisateur'])){

            ?>
            <li class="mainMenu central col-3 col-t-4"><a href="../UI_gestCommandes.php"> Gestionnaire de commande </a></li>
            <li class="mainMenu central col-3 col-t-4"><a href="../UIgestCourrielNotification.html"> Notification par courriel </a></li>
            <li class="mainMenu central col-3 col-t-4"><a href="../suiviDeCommandes.html"> Suivi de commande </a></li>
            <li class="mainMenu central col-3 col-t-4"><a href="../UIgestSuggestions.php"> Envoyer un commentaire </a></li>
            <?php
        }
        else
        {
            ?>
            <li class="mainMenu central col-4 col-t-4"><a href="../UI_authentification.php"> Authentification </a></li>
            <li class="mainMenu central col-4 col-t-4"><a href="../UIgestSuggestions.php"> Envoyer un commentaire </a></li>
            <li class="mainMenu central col-4 col-t-4"><a href="../UI_Inscription.php"> Inscription </a></li>
            <?php
        }
        ?>

    </ul>
    <div class="container">
        <img class="container" width="100%" height="5%" src="https://tamtaam.com/wp-content/uploads/2017/05/wordpress-goole-optimisation-image-referencement_16.jpg" alt="image" />
    </div>
</div>
</body>
</html>