if (document.getElementById("ibanInput") != null) {
    var iban = document.getElementById("ibanInput");
    var bic = document.getElementById("bicInput");

    iban.addEventListener('input', function () {
        $.post("index.php?action=checkIban", { iban: $(this).val() }, function (data) {
            if(data == "valid")
            {
                iban.style.color = "green";
            }
            else
            {
                iban.style.color = "black";
            }
        });
    });

    bic.addEventListener('input', function () {
        const regex = RegExp('([a-zA-Z]{4})([a-zA-Z]{2})(([2-9a-zA-Z]{1})([0-9a-np-zA-NP-Z]{1}))((([0-9a-wy-zA-WY-Z]{1})([0-9a-zA-Z]{2}))|([xX]{3})|)');
        if(regex.test($('#bicInput').val()))
        {
            bic.style.color = "green";
        }
        else
        {
            bic.style.color = "black";
        }
    });


}