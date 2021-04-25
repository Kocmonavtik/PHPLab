$( document ).ready(function() {
    $("#btn").click(
        function()
        {
            sendAjaxForm('result_form', 'ajax_form', 'model.php');
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url)
{
    var nameBox=new Array('Имя', 'Фамилия', 'Электронная почта', 'Номер телефона');
    var myTextboxElem=new Array();
    myTextboxElem[0]=document.getElementById("NameBox");
    myTextboxElem[1]=document.getElementById("SurnameBox");
    myTextboxElem[2]=document.getElementById("EmailBox");
    myTextboxElem[3]=document.getElementById("PhoneBox");
    for(let i=0;i<myTextboxElem.length;++i){
        document.getElementById(myTextboxElem[i].id).style.borderColor="";
        if(myTextboxElem[i].value ==""){
            alert('Заполните поле: '+ nameBox[i]);
            document.getElementById(myTextboxElem[i].id).style.borderColor="red";
            return false;
        }
    }

    var FormatEmail  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(FormatEmail.test(myTextboxElem[2].value) == false) {
        alert('Введите корректный e-mail');
        document.getElementById(myTextboxElem[2].id).style.borderColor="red";
        return false;
    }

    var FormatPhone= /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    if(FormatPhone.test(myTextboxElem[3].value) == false) {
        alert('Введите корректный номер телефона');
        document.getElementById(myTextboxElem[3].id).style.borderColor="red";
        return false;
    }


    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            if(result.Err !=1){
                $('#result_form').html(' <h2>'+result.Err+'</h2>');
            } else {
                $('#result_form').html(' Сообщение отправлено ' +
                    '<br> Имя: ' + result.NameBox +
                    '<br> Фамилия: ' + result.SurnameBox +
                    '<br>Отчество: ' + result.PatronymicBox +
                    '<br> Почта: ' + result.EmailBox +
                    '<br> Телефон: ' + result.PhoneBox +
                    '<br> С вами свяжутся после ' + result.DateTime);
            }
        },
        error: function(response)
        { // Данные не отправлены
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}