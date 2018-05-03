<!Doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ma page Web</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <script src="tamtam.js"></script>
</head>
<body class="backgroudgrey" onload="updateDate(dateAujourdhui())">
<nav class="entete col-12">
    <img  src="image/logo.png" alt="logo"/>
    <ul>
        <li class="menu col-2 col-t-2"><a href="https://tamtaam.com/">Accueil</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nos-produits/">Nos produits</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/a-propos/">En savoir plus</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/points-de-ventes/">Points de ventes</a></li>
        <li class="pointMenu menu col-2 col-t-2"><a href="https://tamtaam.com/nous-joindre/">Nous joindre</a></li>
    </ul>
</nav>



    <div class="col-m-12">
        <ul class="col-m-12 left">
			<li class=" nav central"> <span> <h1 > Bienvenue
                <?php
                require_once '../Utilisateur.php';
                session_start();


                if (isset($_SESSION['utilisateur'])){
                    $usr = unserialize($_SESSION['utilisateur']);
                    echo $usr->getNomUtilisateur();
                }
                ?>
				</h1>
				</span>
				 <form >

					<label class="labelDate" for="date"><b>Date :</b></label>
					<input type="text" name="date" id="date"  size="30" readonly/>
					<input type="hidden" name="date" id="id"  size="30" readonly />
					<input type="hidden" name="date" id="nom"  size="30" readonly />
				</form>
			</li>
            <?php

            if (isset($_SESSION['utilisateur'])){

                ?>
                <li class="nav central"><a href="../UI_gestCommandes.php"> Gestionnaire de commande </a></li>
                <li class="nav central"><a href="../UIgestCourrielNotification.php"> Notification par courriel </a></li>
                <li class="nav central"><a href="../suiviDeCommandes.html"> Suivi de commande </a></li>
                <li class="nav central"><a href="../UIgestSuggestions.html"> Envoyer un commentaire </a></li>
                <?php
            }
            else
            {
                ?>
                <li class=" nav central"><a href="../UI_authentification.php"> Authentification </a></li>
                <li class=" nav central"><a href="../UIgestSuggestions.html"> Envoyer un commentaire </a></li>
                <li class=" nav central"><a href="../UI_Inscription.php"> Inscription </a></li>
                <?php
            }
            ?>

        </ul>
    </div>

    <div class="center">
        

    </div>
    <div class="right" >
       
    </div>
<div class="container">
    <img class="container" src="image/head.jpg" alt="image" />
</div>
</body>
</html>