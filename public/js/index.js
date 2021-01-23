if (document.getElementById("inputCity") != null) {
    var inputCity = document.getElementById("inputCity");
    var CitiesList = document.getElementById("CitiesList");
    inputCity.addEventListener('input', function () {
        if($(this).val().length > 1){ 
            $.post("index.php?action=isCity", { inputCity: $(this).val() }, function (data) {
                $("#CitiesList").fadeIn(function () {
                    CitiesList.innerHTML = data;                    
                });
                document.getElementById("inputRange").disabled = false;
            });
        }
        else{
            CitiesList.innerHTML = "";            
            document.getElementById("inputRange").disabled = true;
            $("#CitiesList").hide();
            document.getElementById("buttonSearchCity").disabled = true;
        }
    });
}

function resultCity(id){

    var inputCity = document.getElementById("inputCity");

    $.post("index.php?action=resultCity", { id: id }, function (data) {
        inputCity.innerHTML = data;
        inputCity.value = data;        
        $('#CitiesList').fadeOut(500);        
        document.getElementById("inputRange").disabled = false;
        document.getElementById("buttonSearchCity").disabled = false;
    });
}

if (document.getElementById('buttonSearchCity') != null ){
    $('#buttonSearchCity').on('click', function(){
        if($('#inputCity').val() == "" || $('#inputCity').val().length <= 1){
            $('#inputCity').addClass("shake-little shake-constant");
            $('#inputCity').css({
                "border": "2px solid red"
            });
            setTimeout(() => {
                $('#inputCity').removeClass("shake-little shake-constant");
                $('#inputCity').css({
                    "border": "1px solid white"
                });
            }, 400);
        }
        else{
            $.post("index.php?action=searchByCity", { city: $('#inputCity').val(), range: $('#inputRange').val() }, function (data) {
                ids = data.split(', ');
                $('.divTournament').hide();
                $('#noResultSearch').hide();
                $('#noResultSearchDate').hide();
                $('#noResultSearchName').hide();
                $('#tournamentList').show();
                if(ids.length == 1){
                    $('#noResultSearch').show();
                }
                for (let index = 0; index < ids.length; index++) {
                    if (ids[index] != "") {
                        $('#tournament' + ids[index]).fadeIn(500);
                    }                    
                }
            });
        }
    });
}


if (document.getElementById('buttonSearchDate') != null ){
    $('#buttonSearchDate').on('click', function(){
        if($('#inputStartingDate').val() == ""){
            $('#inputStartingDate').addClass("shake-little shake-constant");
            $('#inputStartingDate').css({
                "border": "2px solid red"
            });
            setTimeout(() => {
                $('#inputStartingDate').removeClass("shake-little shake-constant");
                $('#inputStartingDate').css({
                    "border": "1px solid white"
                });
            }, 400);
        }
        else if($('#inputEndDate').val() == ""){
            $('#inputEndDate').addClass("shake-little shake-constant");
            $('#inputEndDate').css({
                "border": "2px solid red"
            });
            setTimeout(() => {
                $('#inputEndDate').removeClass("shake-little shake-constant");
                $('#inputEndDate').css({
                    "border": "1px solid white"
                });
            }, 400);
        }
        else{
            $.post("index.php?action=searchByDate", { date1: $('#inputStartingDate').val(), date2: $('#inputEndDate').val() }, function (data) {
                ids = data.split(', ');
                $('.divTournament').hide();
                $('#noResultSearch').hide();
                $('#noResultSearchName').hide();
                $('#tournamentList').show();
                if(ids.length == 1){
                    $('#noResultSearchDate').show();
                }
                for (let index = 0; index < ids.length; index++) {
                    if (ids[index] != "") {
                        $('#noResultSearchDate').hide();
                        $('#tournament' + ids[index]).fadeIn(500);
                    }                    
                }
            });
        }
    })
}

if (document.getElementById('buttonSearchName') != null ){
    $('#buttonSearchName').on('click', function(){
        if($('#inputName').val() == ""){
            $('#inputName').addClass("shake-little shake-constant");
            $('#inputName').css({
                "border": "2px solid red"
            });
            setTimeout(() => {
                $('#inputName').removeClass("shake-little shake-constant");
                $('#inputName').css({
                    "border": "1px solid white"
                });
            }, 400);
        }
        else{
            $.post("index.php?action=searchByName", { name: $('#inputName').val() }, function (data) {
                ids = data.split(', ');
                $('.divTournament').hide();
                $('#noResultSearch').hide();
                $('#noResultSearchDate').hide();
                $('#noResultSearchName').hide();
                $('#tournamentList').show();
                if(ids.length == 1){
                    $('#noResultSearchName').show();
                }
                for (let index = 0; index < ids.length; index++) {
                    if (ids[index] != "") {
                        $('#tournament' + ids[index]).fadeIn(500);
                    }                    
                }
            });
        }
    })
}

if (document.getElementById('inputRange') != null ){
    var slider = document.getElementById("inputRange");
    var output = document.getElementById("rangeOut");
    output.innerHTML = "Rayon : " + slider.value + " km";

    slider.oninput = function() {
    output.innerHTML = "Rayon : " + this.value + " km";
    }
}

$('.buttonSearch').on('click', function(){
    $('#noResultSearch').hide();
    $('#noResultSearchDate').hide();
    $('#noResultSearchName').hide();
    $('.formatsList #noResultSearchFormat').hide();
    $('.searchResults').hide();
    $("#search" + this.id).fadeIn(500);
    $('#search' + this.id).css({
        "display": "flex"
    });
});

tinymce.init({
    selector: '#inputRewards',  // change this value according to your HTML
    width: '100%',
    height: 320
});

tinymce.init({
    selector: '#inputContent',  // change this value according to your HTML
    width: '100%',
    height: 354,
    plugins: "link lists searchreplace fullscreen hr print preview " + 
             "anchor code save emoticons directionality spellchecker " + 
             "N1ED BootstrapEditor",
    
    toolbar: "cut copy | undo redo | searchreplace formatselect link " + 
             "| bold italic underline strikethrough | forecolor backcolor " + 
             "| removeformat | alignleft aligncenter alignright alignjustify " + 
             "| bullist numlist outdent indent | removeformat | blockquote " + 
             "hr anchor print spellchecker | preview code save cancel " + 
             "| emoticons ltr rtl",
    
    widgetsList: [
             "Image", "FontAwesome" , 
             "Link", "Header" , 
             "IFrame", "HTML"
    ]
});