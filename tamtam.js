function dateAujourdhui(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = mm + '/' + dd + '/' + yyyy;
    return today;
}
function updateDate(valeur){
    document.getElementById("date").value = valeur;
}

function updateMontant(prix, idQty,idMnt) {
    var montant;
    montant = document.getElementById(idQty).value;
    document.getElementById("idMnt").value = montant;
}



function commencer(nb){
    for(i=0; i<=nb;i++){
        (function(){
            var index = i;
            console.log(index);
            document.getElementById(("qty"+index)).addEventListener("change", function(){
                clic((index));
            });
            // Ajouter un EventListener sur chaque case qui appel la méthode clic et lui passe en paramètre l'index de la case
        }());
    }
}


function clic (n) {
    var w = ("qty" + n);
    var b = (w + "nb");
    prix = document.getElementById((b)).value;
    qt = document.getElementById((w)).value;
    price = parseInt(prix);
    quantite = parseInt(qt);
    var resultat = (price*quantite);
    console.log(resultat);
    chercher = "mnt" + n;
    document.getElementById(chercher).value = resultat;

}

function updateTotal(valeur){
    document.getElementById("total").value = valeur;
}
function Montant(){
    return 5;
}