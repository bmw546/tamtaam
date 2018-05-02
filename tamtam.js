var total;
function valeur(){
    total = 0;

}
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
    var index;
    for(i=0; i<=nb;i++){
        (function(){
            var index = i;
            console.log(index);
            document.getElementById(("qty"+index)).addEventListener("click", function(){
                clic((index));
            });
            document.getElementById(("qty"+index)).addEventListener("change", function(){
                clic((index));
            });
            // Ajouter un EventListener sur chaque case qui appel la méthode clic et lui passe en paramètre l'index de la case
        }());
    }
}

function clic (n) {

        remove(n);

    var w = ("qty" + n);
    var b = (w + "nb");
    prix = document.getElementById((b)).value;
    qt = document.getElementById((w)).value;
    if (qt==null||qt==""){
        qt=0;
    }

    price = parseFloat(prix);
    quantite = parseFloat(qt);
    var resultat = (price*quantite);
    //console.log(resultat);
    chercher = "mnt" + n;
    document.getElementById(chercher).value = resultat;

        addbox(n);
}

function addbox(index){
    var temp =  (document.getElementById(("mnt"+index)).value);
    if (temp==null||temp==""){
        temp=0;
    }
    var newtotal = parseFloat(temp);
    total += newtotal;
    console.log(total);
    updateTotal();
}
function remove(index){
    var temp =  (document.getElementById(("mnt"+index)).value);
    if (temp==null||temp==""){
        temp=0;
    }
    var newtotal = parseFloat(temp);
    total -= newtotal;

    //var newtotal = (total - parseFloat(document.getElementById(("mnt"+index)).value));
    //total = newtotal;
    console.log(total);
    updateTotal();
}
function updateTotal(){
    document.getElementById("sous_total").value = total;
    var grandtotal = (total + 0 )
    //var grandtotal = (total + parseFloat(document.getElementById(("livraison")).value) )
    document.getElementById("total").value = grandtotal;
}
function test(){
    $("#nouvProduit").click(function(){
        var elem = $("<select/>",{
            value: "hisbicuss",
            name: "produit[]"
        });

        var removeLink = $("<span/>").html("Supprimer").click(function(){
            $(elem).remove();
            $(this).remove();
        });

        $("#nouvProduit").append(elem).append(removeLink);
    });
}
