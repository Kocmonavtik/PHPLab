$( document ).ready(function() {
    $("#SendAddress").click(
        function () {
            sendAjaxFormProtect('InfoAddress', 'model.php');
            return false;
        }
    );
});

function sendAjaxFormProtect(ajax_form, url) {
    $.ajax({
        url: url, //url страницы
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сериализуем объект
        success: function (response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            $('#result_form').html('Получен ответ:'+
                '<br> Индекс: ' + result.index +
                '<br> Страна: ' + result.country +
                '<br>Регион: ' + result.region +
                '<br> Населенный пункт: ' + result.local +
                '<br> Улица: ' + result.street +
                '<br> Дом: ' + result.house +
                '<br> Координаты: ' + result.firstCord+' '+result.secondCord +
                '<br> Ближайшее метро: ' + result.metro
            )

        },
        error: function (response) {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}