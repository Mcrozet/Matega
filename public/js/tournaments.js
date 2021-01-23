
if (document.getElementById('inputSendForm') != null ){
    $('#inputSendForm').on('click', function(){
        for (let i = 0; i < 9; i++) {
            if($('#formCreateTournament')[0][i].value == ""){
                $('#formCreateTournament')[0][i].classList.add("shake-little");
                $('#formCreateTournament')[0][i].classList.add("shake-constant");
                $('#formCreateTournament')[0][i].style.border = "2px solid red";
                setTimeout(() => {
                    $('#formCreateTournament')[0][i].classList.remove("shake-little");
                    $('#formCreateTournament')[0][i].classList.remove("shake-constant");
                    $('#formCreateTournament')[0][i].style.border ="1px solid white";
                }, 400);
                break;
            }
        }
    });
}

$('.buttonFormat').on('click', function(){    
    var id = this.id.substr(6);
    id = id.toLowerCase();
    $('.formatsList #noResultSearchFormat').show();
    $('#noResultSearch').hide();
    $('.divTournament').show();
    $('#tournamentList').hide();
    $('#pages').hide();
    $('.formatsList').hide();
    $('#formats'+id).fadeIn(500);
    $('#formats'+id).css({
        "display": "flex",
        "flex-wrap": "wrap"
    });
});

$('#registerTournament').on('click', function(){
    $('#registerDetail').fadeIn();
    $("html, body").stop().animate( { scrollTop: $('#registerDetail').offset().top }, 1500);
});

$('#inputDatePicker').change(function(){
    if($("#inputDatePicker").is(":checked")){
        $('#tournamentDate').hide();
        $('#inputLastRegister').css({
            "visibility": "hidden"
        });
        $('#labelLastRegister').hide();
        $('#datePicker').fadeIn();
    }
    else{
        $('#tournamentDate').fadeIn();
        $('#inputLastRegister').css({
            "visibility": "visible"
        });
        $('#labelLastRegister').fadeIn();
        $('#datePicker').hide();
    }
})

$('#checkboxLink').change(function(){
    if($("#checkboxLink").is(":checked")){
        $('#inputLink').fadeIn();
    }
    else{
        $('#inputLink').fadeOut();
    }
})

$('.date').datepicker({
    multidate: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        weekStart: 1,
        language: 'fr'
});