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
    <h4 class="text-center"> Введите адрес</h4>
    <form action="" id="InfoAddress">
        <div class="form-group d-flex justify-content-center">
            <input type="text"
                   name="InputAddress"
                   id="InputAddress"
                   class="form-control w-50 p-3 text-center"
                   placeholder="Адрес">
            <button type="button" id="SendAddress" class="btn btn-info">Получить данные</button>
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