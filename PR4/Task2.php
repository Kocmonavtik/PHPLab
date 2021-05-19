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
$regular1='/http:\/\/asozd.duma.gov.ru\/main.nsf\/\(Spravka\)\?OpenAgent&RN=(\d+)(&*)(\d+)/';
$template='0';
$result=array();
for($i=0;$i<count($mas);++$i){
    preg_match($regular1, $mas[$i],$template);
    $result[$i]=str_replace($template[0],"http://sozd.parlament.gov.ru/bill/$template[1]",$mas[$i]);
}
file_put_contents('OutputTask2.txt', $result);
