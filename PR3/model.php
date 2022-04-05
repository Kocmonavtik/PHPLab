<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

ini_set('display_errors',1);
//error_reporting(E_ALL);

$connection = new PDO('pgsql:host=localhost;port=5435;user=postgres;password=290677;dbname=postgres');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dateString = date('H:i:s Y-m-d');
$dateNow=new DateTime($dateString);

$spamcheck=SpamCheck();
$errCheck='0';
if($spamcheck!=1){
 $errCheck=$spamcheck;
} else{
    $messageCheck=SendMessage();
    if($messageCheck!=1){
        $errCheck=$messageCheck;
    }
}

// Формируем массив для JSON ответа
$result = array(
    'NameBox' => $_POST["NameBox"],
    'SurnameBox'=>$_POST["SurnameBox"],
    'PatronymicBox'=>$_POST["PatronymicBox"],
    'EmailBox'=>$_POST["EmailBox"],
    'PhoneBox' => $_POST["PhoneBox"],
    'DateTime'=>date('H:i:s Y-m-d', strtotime("+1 hours 30 minutes")),
    'Err'=>$spamcheck
);
// Переводим массив в JSON
echo json_encode($result);



function SpamCheck ()
{
    global $connection;
    global $dateNow;
    $prepared=$connection->prepare('select datetime from pr3 where email=\''.$_POST['EmailBox'].'\' order by id desc limit 1');
    $result = $prepared->execute();
    if ($result) {
        $dateStringBD=$prepared->fetchColumn();
    }
    if($dateStringBD!='') {
        $dateBD=new DateTime($dateStringBD);
        $diff = $dateNow->diff($dateBD);
        $minutes = ($diff->y * 365 * 24 * 60 * 60) +
            ($diff->m * 30 * 24 * 60 * 60) +
            ($diff->d * 24 * 60 * 60) +
            ($diff->h * 60 * 60) +
            $diff->i;
        if($minutes<=60){
            $TimeLeft=60-$minutes;
            return 'Вы сможете отправить повторно заявку через '.$TimeLeft.' минут(ы)';
        }
    }
    return 1;
}
function SendMessage()
{
    global $connection;
    global $dateString;
    // Создание экземпляра и передача `true` для включения исключений
    $mail= new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        //Настройки почты
        //$mail->SMTPDebug=\PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;   //Подробный вывод отладки
        $mail->isSMTP();                                            //Отправление сообщения черещ SMTP
        $mail->Host = 'smtp.gmail.com';                             //Настройка SMTP для отправки
        $mail->SMTPAuth = true;                                     //Включение аутетнтификатора SMTP
        $mail->Username = 'myemail@gmail.com';              //SMTP имя пользователя
        $mail->Password = 'password';                           //SMTP пароль
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;    //Включение шифрования
        $mail->Port = 587;                                          //TCP  порт для подключения

        //Получатель сообщения
        $mail->setFrom('myemail@gmail.com', 'Newsletter');//Адрес почты и имя отправителя
        $mail->addAddress("myworkemail@gmail.com", "$_POST[NameBox]");     //Добавление получателя сообщения.Имя не обязательно

        /*Вложения
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Добавления вложений
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Имя не обязателно
        */

        //Содержание сообщения
        $mail->isHTML(true);                                  //Установка формата html в эл. почте
        $mail->Subject = 'Test message sending';
        $mail->Body = "<h3>Новая заявка:</h3>
            Имя: $_POST[NameBox]<br>
            Фамилия: $_POST[SurnameBox]<br>
            Отчество: $_POST[PatronymicBox]<br>
            <b>Электронная почта: $_POST[EmailBox]</b><br> 
            <b>Номер телефона: $_POST[PhoneBox]</b>";

        //В виде обычного текста для почтовых клиентов, отличных от HTML.
        //$mail->AltBody = '';

        $mail->send();
        try {
            $prepared = $connection->prepare('insert into pr3 (name, surname, patronymic, email, phoneNumber, dateTime)
                values(\''.$_POST['NameBox'].'\', \''.$_POST['SurnameBox'].'\',
                \''.$_POST['PatronymicBox'].'\',\''.$_POST['EmailBox'].'\', \''.$_POST['PhoneBox'].'\', \''.$dateString.'\')');
            $prepared->execute();
        } catch (Exception $e) {
            return $e;
        }
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    return 1;
}
