var count = 1; //Pour avoir des id unique

//Affiche la date du jour
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

//Ajoute une ligne dans la table
function ajouterLigne(tblCommandes,array_produit){
    count++;
    var table = document.getElementById(tblCommandes);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.setAttribute("id", "r"+count);

    //Produit
    var cell1 = row.insertCell(0);
    var element1 = document.createElement("select");
    element1.setAttribute("id","l"+count);
    element1.setAttribute("name","listeProduit[]");
    var option1 = document.createElement("option");
    option1.innerHTML= "--Choisir un produit--";
    option1.selected = true;
    option1.disabled = true;
    element1.appendChild(option1);
    cell1.appendChild(element1);

    var value = 1;
    for (var i = 0;i < array_produit.length;i++){
        var option2 = document.createElement("option");
        option2.value = array_produit[i][0];
        option2.innerHTML = array_produit[i][0];
        element1.appendChild(option2);
        value++;
    }

    //Format
    var cell2 = row.insertCell(1);
    var element2 = document.createElement("select");
    var option1 = document.createElement("option");
    element2.setAttribute("id","f"+count);
    element2.setAttribute("name","format[]");
    option1.value="1";
    option1.innerHTML= "--Choisir un format--";
    option1.selected = true;
    option1.disabled = true;
    element2.appendChild(option1);
    cell2.appendChild(element2);

    //Prix Unitaire
    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.setAttribute("id","p"+count);
    element3.type="text";
    element3.maxLength=4;
    element3.size=4;
    element3.value='0';
    element3.readOnly = true;
    cell3.appendChild(element3);

    //Quantite
    var cell4 = row.insertCell(3);
    var element4 = document.createElement("input");
    element4.setAttribute("id","q"+count);
    element4.setAttribute("name","qty[]");
    element4.disabled = true;
    element4.type="number";
    element4.min="0";
    element4.max="99";
    element4.value='0';
    cell4.appendChild(element4);

    //Montant
    var cell5 = row.insertCell(4);
    var element5 = document.createElement("input");
    element5.setAttribute("id","m"+count);
    element5.type="text";
    element5.maxLength="7";
    element5.size="7";
    element5.readOnly = true;
    cell5.appendChild(element5);

    //Bouton Supprimer
    var cell6 = row.insertCell(5);
    var element6 = document.createElement("input");
    element6.setAttribute("id","s"+count);
    element6.type="button";
    element6.value= "Supprimer";
    cell6.appendChild(element6);

    //Bouton Image
    var cell7 = row.insertCell(6);
    var element7 = document.createElement("input");
    element7.setAttribute("id","i"+count);
    element7.type="button";
    element7.value = "Image";
    cell7.appendChild(element7);
}

/**
 * valide les informations des champs d'un formulaire (REGEX)
 * @param who string  le nom de l'id du champ
 * @param label l'étiquette associé au champs
 * @param myRegex l'expression regex pour valider un champ
 */
function check(who, label, myRegex){
    var value;
    value = document.getElementById((who)).value;
    if(!myRegex.test(value)){
        document.getElementById(label).style.color = 'red';
    }
    else{
        document.getElementById(label).style.color = 'black';
    }
}

/**
 * Compare les deux champs pour le mot de passe et vérifie s'il sont semblable
 * @param pwd le mot de passe entrer
 * @param pwdConfirmer la confirmation du mot de passe
 * @param label l'étiquette du champs confirmation
 */
function comparePassword(pwd, pwdConfirmer, label){

    var password;
    var confirme;
    password = document.getElementById((pwd)).value;
    confirme = document.getElementById((pwdConfirmer)).value;

    if(password !== confirme){
        document.getElementById(label).style.color = 'red';
        document.getElementById(pwdConfirmer).select();
    }
    else{
        document.getElementById(label).style.color = 'black';
    }
}

//Enleve les options d'un combobox
function removeOptions(selectbox) {
    var i;
    for (i = selectbox.options.length - 1; i > 0; i--) {
        selectbox.remove(i);
    }
}

//Reset le formulaire commandes
function resetForms() {
    document.forms['_Commandes'].reset();
}
// -------------------------- LIGHT BOX ------------------------------------------
// pour les lightbox( aka "shadowbox")
function lightbox(who){
    document.getElementById(who).style.display = "block";
    document.getElementById('lightBoxBg').style.display = "block";

}
// tour de passe passe pour que l'image soit au dessus. (si on le fait direct javascript vérifier les class name avant
// que le reste du code php soit executer for some reason)
function stop(){
    stop2();
}
function stop2(){
    var elements = document.getElementsByClassName('lightBox');
    for(var i=0; i<elements.length; i++) {
        elements[i].style.display='none';
    }
    document.getElementById('lightBoxBg').style.display = "none";
}
//Format les chifrre en dollars
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,') + " $";
};


// ----------JQUERY + AJAX-------------

//A faire au démarrage de la page
$(document).ready(function () {
    resetForms();
});

//Verifie les changement sur le produit selectionné
$(document).on('change','[id^=l]',function(){
    var prod = this.options[this.selectedIndex].text;
    var format = "f"+this.id.substr(1);

    //Requete des format disponible pour l'objet selectionné
    $.ajax({
        type: 'POST',
        url: 'getFormat.php',
        data: {produit:prod},
        success:function(data){
            var str_away = data.split(',');
            str_away[0] = str_away[0].replace(/^\s*/, "").replace(/\s*$/, "");
            str_away.pop(); //efface la derniere position qui est vide

            var element = document.getElementById(format);
            removeOptions(document.getElementById(format));

            str_away.forEach(function(entry){
                var option2 = document.createElement("option");
                option2.value=entry;
                option2.innerHTML = entry;
                element.appendChild(option2);
            });
            $("#q1").trigger("input");
        }
    });


});

//Vérifie les changement sur le format
$(document).on('change','[id^=f]',function(){
    var format = this.options[this.selectedIndex].text;
    var listeId = "l"+this.id.substr(1);
    var prod = document.getElementById(listeId);
    prod = prod.options[prod.selectedIndex].text;
    var prixId = "p"+this.id.substr(1);
    var qty = "q"+this.id.substr(1);

    //Requete pour trouver le prix unitaire
    $.ajax({
        type: 'POST',
        url: 'getPrixUnitaire.php',
        data: {produit:prod,qty:format},
        success:function(data){
            var n = Number(data);
            document.getElementById(prixId).value = n.format(2);
            var q = document.getElementById(qty);
            q.removeAttribute("disabled");
            $("#q1").trigger("input");
        }
    });
});


//Vérifie les changement sur la quantité
$(document).on('input','[id^=q]',function(){
    var idPrix = "p"+this.id.substr(1);
    var prixUni = document.getElementById(idPrix).value.slice(0,-1);
    var idMontant = "m"+this.id.substr(1);
    var montant = prixUni * this.value;

    document.getElementById(idMontant).value = montant.format(2);
    $("#m1").trigger("change");

    //Disable le bouton commander si la quantité est 0
    var btn = document.getElementById('_btnCommander');
    if (this.value > 0){
       btn.removeAttribute("disabled");
    }
    else{
        btn.disabled = true;
    }
 });

//Vérifie les click sur supprimer
$(document).on('click','[id^=s]',function(){
    var rowId = "r" +this.id.substr(1);
    var row = document.getElementById(rowId);
    row.parentNode.removeChild(row);
    $("#q1").trigger("input");
});

//Vérifie les click sur image
$(document).on('click','[id^=i]',function(){
    var prodId = "l" +this.id.substr(1);
    var prod = document.getElementById(prodId);
    var string = prod.options[prod.selectedIndex].text;
    lightbox(string);
});

//Vérifie les changement sur le montant
$(document).on('change','[id^=m]',function(){
    var val = 0;
    $('[id^="m"]').each(function(){
        val +=  Number(this.value.slice(0,-1));

    })

    var sousTotal = document.getElementById('_soustotal');
    sousTotal.value = val.format(2);
    //Total temporaire (pas de livraison)
    var total = document.getElementById('_total');
    total.value = val.format(2);
});






