<?php
$inputFile="InputTask2.txt";
$read=fopen($inputFile,'r');
if($read){
    $tmp=0;
    $mas=array();
    while (($buffer = fgets($read)) !== false) {
        $mas[$tmp] = $buffer;
        $tmp++;
    }
    if (!feof($read)) {
        echo "Ошибка!";
        exit();
    }
    fclose($read);
}
$regular='/(\d+)(&*)(\d+)/';
$template=array();
$result=array();
for($i=0;$i<count($mas);++$i){
    preg_match($regular,$mas[$i],$template);
    $result[$i]="http://sozd.parlament.gov.ru/bill/$template[1]\n";
}
file_put_contents('OutputTask2.txt', $result);