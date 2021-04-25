<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR3</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
<header class="header">
    <div class="wrapper">
        <p class="header_text">Форма обратной связи</p>
    </div>
</header>
<main class="main">
    <div class="wrapper">
        <div class="FeedbackBlock">
            <form method="POST" id="ajax_form" name="FeedbackForm" action="">
            <p>Имя</p>
            <input type="text" id="NameBox" name="NameBox" size="30px" maxlength="32">
            <p>Фамилия</p>
            <input type="text"  id="SurnameBox" name="SurnameBox" size="30px" maxlength="32">
            <p>Отчество</p>
            <input type="text" id="PatronymicBox" name="PatronymicBox" size="30px" maxlength="32">
            <p>Электронная почта</p>
            <INPUT type="text" id="EmailBox" name="EmailBox" size="30px" maxlength="32">
            <p>Номер телефона</p>
            <INPUT type="text" id="PhoneBox" name="PhoneBox" size="30px" maxlength="32">
            <p><input type="submit" id="btn" value="Отправить" name="SendInfo"></p>
            </form>
            <p><div id="result_form" class="SendInfo"></div></p>
        </div>
    </div>
</main>
</body>
</html>