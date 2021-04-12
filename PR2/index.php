<?php
require './Task2.php';
if(@simplexml_load_file('input.xml')) {
    sendBD(simplexml_load_file('test.xml'));
}
else
{
    echo "Файл не соответствует стандарту xml".PHP_EOL;
}
