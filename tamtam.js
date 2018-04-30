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