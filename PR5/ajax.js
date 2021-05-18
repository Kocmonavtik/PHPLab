$( document ).ready(function() {
    $("#ProtectSend").click(
        function()
        {
            sendAjaxFormProtect('ProtectForm', 'model.php');
            return false;
        }
    );
    $("#NoProtectSend").click(
        function () {
            sendAjaxFormNoProtect('NoProtectForm', 'model.php');
            return false;
        }
    )



});

function sendAjaxFormProtect(ajax_form, url)
{
    $.ajax({
        url:     url, //url страницы
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            let tmpInfo='';
            for(let i=0;i<result.length;++i){
                tmpInfo=tmpInfo+'<br> Запись №'+(i+1)+
                    '<br> id: ' + result[i].id +
                    '<br> Имя: ' + result[i].name +
                    '<br> Почта: ' + result[i].email +
                    '<br> Пароль: ' + result[i].pass;
            }
            $('#result_form').html('Получены данные:'+tmpInfo);
        },
        error: function(response)
        { 
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}
function sendAjaxFormNoProtect(ajax_form,url){
    $.ajax({
        url:     url, //url страницы
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            let tmpInfo='';
            for(let i=0;i<result.length;++i){
                tmpInfo=tmpInfo+'<br> Запись №'+(i+1)+
                    '<br> id: ' + result[i].id +
                    '<br> Имя: ' + result[i].name +
                    '<br> Почта: ' + result[i].email +
                    '<br> Пароль: ' + result[i].pass;
            }
            $('#result_form').html('Получены данные:'+tmpInfo);
        },
        error: function(response)
        {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}