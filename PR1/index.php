<?php
require './TaskA.php';

$inputsfile = glob("test/*.dat");
$outputsfile =  glob("test/*.ans");
$i = 1;
foreach (array_combine($inputsfile, $outputsfile)as $input=> $output) {
    $fs = fopen($output, 'r');
    $answer = fgets($fs);
    $calcAnswer = getValue($input);
    echo "Test $i: ";
    echo $calcAnswer;
    if ($calcAnswer == $answer) {
        echo  " Correct\n";
    }
    else {

        echo " Wrong \n";
    }
    $i++;
}
