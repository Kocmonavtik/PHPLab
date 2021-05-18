<?php
$inputFile="InputTask1.txt";
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
$regular="/'(\d+)'/";
for($i=0;$i<count($mas);++$i){
    $inputStr=$mas[$i];
    $result=preg_replace_callback($regular,'doubling',$inputStr);
    echo $result;
}

function doubling(array $mas)
{
    return '\''.$mas[1]*2 .'\'';
}