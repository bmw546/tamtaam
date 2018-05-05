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
    document.getElementById(('tblCommandes')).addEventListener("click", function(){
        ajouterLigne();
    });
//     var index;
//     for(i=0; i<=nb;i++){
//         (function(){
//             var index = i;
//             console.log(index);
//             document.getElementById(("qty"+index)).addEventListener("click", function(){
//                 clic((index));
//             });
//             document.getElementById(("qty"+index)).addEventListener("change", function(){
//                 clic((index));
//             });
//
//             // Ajouter un EventListener sur chaque case qui appel la méthode clic et lui passe en paramètre l'index de la case
//         }());
//     }
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

function loadFormat(obj){
    var produit = obj.options[obj.selectedIndex].text;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","getFormat.php",true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState ==4 && xhr.status==200){
            var text = xhr.responseText;
            var target = document.getElementById("format");
            target.innerHTML = text;
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www.-form-urlencoded");
    xhr.send("produit");
}

function ajouterLigne(tblCommandes,array_produit){
    var table = document.getElementById(tblCommandes);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    //Produit
    var cell1 = row.insertCell(0);
    var element1 = document.createElement("select");
    element1.setAttribute("id","listeProduit"+rowCount);
    var option1 = document.createElement("option");
    option1.innerHTML= "--Choisir un produit--";
    option1.selected;
    option1.disabled;
    element1.appendChild(option1);

    for (var i = 0;i < array_produit.length;i++){
        var option2 = document.createElement("option");
        option2.value='i';
        option2.innerHTML = array_produit[i][0];
        element1.appendChild(option2);
    }
    cell1.appendChild(element1);

    //Format
    var cell2 = row.insertCell(1);
    var element2 = document.createElement("select");
    var option1 = document.createElement("option");
    option1.value="1";
    option1.innerHTML= "--Choisir un format--";
    option1.selected;
    option1.disabled;
    element2.appendChild(option1);
    cell2.appendChild(element2);

    //Prix Unitaire
    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.type="text";
    element3.maxLength="4";
    element3.size="4";
    element3.value=0;
    element3.readOnly = true;
    cell3.appendChild(element3);

    //Quantite
    var cell4 = row.insertCell(3);
    var element4 = document.createElement("input");
    element4.type="number";
    element4.min="0";
    element4.max="99";
    element4.value=0;
    cell4.appendChild(element4);

    //Montant
    var cell5 = row.insertCell(4);
    var element5 = document.createElement("input");
    element5.type="text";
    element5.maxLength="7";
    element5.size="7";
    element5.readOnly = true;
    cell5.appendChild(element5);

    //Bouton Supprimer
    var cell6 = row.insertCell(5);
    var element6 = document.createElement("input");
    element6.type="button";
    element6.value= "Supprimer";
    cell6.appendChild(element6);
}


function check(who, label, myRegex){

    var value;
    value = document.getElementById((who)).value;
    if(!myRegex.test(value)){
        document.getElementById(label).style.color = 'red';
        document.getElementById(who).select();
        //alert("ERREUR l'adresse contient des information invalide :"+ value +" veuillez faire comme ceci ex: 475 Rue du Cegep, Sherbrooke, QC J1A 4K1 ");
    }
    else{
        document.getElementById(label).style.color = 'black';
    }
}

$(document).on('change',('[id^=listeProduit]'),function(){
    var prod = this.options[this.selectedIndex].text;
    $.ajax({
        type: 'POST',
        url: 'getFormat.php',
        data: {produit:prod},
        success:function(data){
            console.log(data);
            var str_away = data.split(',');
            str_away[0] = str_away[0].replace(/^\s*/, "").replace(/\s*$/, "");
            str_away.pop(); //efface la derniere position qui est vide
            console.log(str_away);

            var element = document.getElementById('0');
            removeOptions(document.getElementById('0'));

            str_away.forEach(function(entry){
                var option2 = document.createElement("option");
                option2.value='entry';
                option2.innerHTML = entry;
                element.appendChild(option2);
            });
        }
    });


});

$(document).on('change',('[name^=format]'),function(){
    var format = this.options[this.selectedIndex].text;
    console.log(format);
    var listeId = "listeProduit"+this.id;
    console.log(listeId);
    var prod = document.getElementById(listeId).value;
    var zoneId = "prix"+this.id;
    $.ajax({
        type: 'POST',
        url: 'getPrixUnitaire.php',
        data: {produit:prod,qty:format},
        success:function(data){
            console.log(data);
            document.getElementById(zoneId).value = data;
        }
    });

});

function removeOptions(selectbox) {
    var i;
    for (i = selectbox.options.length - 1; i > 0; i--) {
        selectbox.remove(i);
    }
}