<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
          crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
<div class="container">
    <h2 class="text-center">Получение данных</h2>
    <h4 class="text-center"> Безопасное получение данных</h4>
    <form action="" id="ProtectForm">
        <div class="form-group d-flex justify-content-center">
            <input type="text"
                   name="ProtectQuery"
                   id="ProtectQuery"
                   class="form-control w-50 p-3 text-center"
                   placeholder="Введите id пользователя">
            <button type="button" id="ProtectSend" class="btn btn-info">Получить данные</button>
        </div>
    </form>
    <h4 class="text-center">Небезопасное получение данных</h4>
    <form action="" id="NoProtectForm">
        <div class="form-group d-flex justify-content-center">
            <input type="text"
                   name="NoProtectQuery"
                   id="NoProtectQuery"
                   class="form-control w-50 p-3 text-center"
                   placeholder="Введите id пользователя">
            <br><button type="button" id="NoProtectSend" class="btn btn-info">Получить данные</button>
        </div>
    </form>
    <div class="text-center">
        <h4>Результат</h4>
        <p><div id="result_form">

        </div></p>
    </div>

</div>
</body>
</html>