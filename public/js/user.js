if(document.getElementById('signUpUsername'))
{
    user = document.getElementById('signUpUsername');
    submit = document.getElementById('signUpSubmit');
    user.addEventListener('input',function () {
        if (user.value.length < 3) 
        {
            user.style.color = 'red';
            submit.disabled = true;
            submit.value = "Nom trop court";
        }
        else
        {
            $.post("userExist", {name: $(this).val()}, function (data){
                if (data == 'ok') {
                    user.style.color = 'green';
                    submit.disabled = false;
                    submit.value = "M'enregistrer";
                }
                else{
                    user.style.color = 'red';
                    submit.disabled = true;
                    submit.value = "Nom déjà utilisé";
                }
            });
        }
    });
}