$('.buttonEvents').on('click', function(){
    $('.divEvents').hide();
    $('#div'+this.id).fadeIn();
    $('#errorContentMyEvent').fadeOut();
});

$('#addPng').on('click', function(){
    $('#addAdresseDiv').fadeIn();
});

function addNewAdress() {
    name = document.getElementById("nameAddAdress").value;
    localisation = document.getElementById("locationAddAdress").value;
    city = document.getElementById("cityAddAdress").value;
    cp = document.getElementById("cpAddAdress").value;

    if(city == "" || name == "" || localisation == "" || cp == "")
    {
        alert('Données adresse incomplète');
    }
    else
    {
        $.post("addNewAdress", { name: name, localisation: localisation, cp: cp, city: city}, function (data) {
            if(data == "Votre adresse a bien été ajoutée")
            {
                $('#addAdresseDiv').fadeOut();
                $('#errorAddAdress').fadeOut();
                $('#addedAddAdress').fadeIn();
                document.getElementById('inputAddress').value = localisation;
                document.getElementById('inputCityForm').value = city;
                document.getElementById('inputCp').value = cp;
                document.getElementById('addedAddAdress').innerHTML = "Adresse bien ajoutée";
            }
            else
            {
                $('#addedAddAdress').fadeOut();
                $('#errorAddAdress').fadeIn();
                document.getElementById('errorAddAdress').innerHTML = "Nom déjà utilisé";
            }
        });
    }
}

if (document.getElementById('adressList') != null ){
    document.getElementById("adressList").onchange = function(){
        id = $(this).val().substr(7);
        $.post("changeAdressDefault", {id: id}, function (data) {
            array = JSON.parse(data);
            
            document.getElementById('inputAddress').value = array['location'];
            document.getElementById('inputCityForm').value = array['city'];
            document.getElementById('inputCp').value = array['cp'];
        });
    }
}

/* ----------------- */
/* Tournois en cours */
/* ----------------- */

$('#containerEventCreated tr').on('click', function(){
    document.location.href = 'details'+this.id;
})

$('#containerEventFinished tr').on('click', function(){
    document.location.href = 'details'+this.id;
})