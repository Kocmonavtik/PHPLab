<?php
function getValue($path)
{
    //считывание из файла построчно и запись в массив $mas
    $read = fopen($path, 'r');
    if ($read) {
        $tmp = 0;
        $mas = array();
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
    //число записей - количество ставок.
    $tm = (int)$mas[0];
    //запись в двумерный массив ставок.
    if ($tm != 0) {
        $sum = 0;
        $rateStr = array();
        for ($i = 0; $i < $tm; ++$i) {
            $rateStr[$i] = explode(" ", $mas[$i + 1]);
            $sum = $sum - $rateStr[$i][1];
        }
        //число записей - количество игр.
        $tm = (int)$mas[$mas[0] + 1];
        //запись в двумерный массив игр.
        if ($tm != 0) {
            $games = array();
            for ($i = 0; $i < $tm; ++$i) {
                $games[$i] = explode(" ", $mas[$mas[0] + 2 + $i]);
            }

            for ($i = 0; $i < count($rateStr); ++$i) {
                for ($j = 0; $j < count($games); ++$j) {
                    if ($rateStr[$i][0] == $games[$j][0]) {
                        if ($rateStr[$i][2] == $games[$j][4]) {
                            if (preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $rateStr[$i][2]) == 'L') {
                                $sum = $sum + ($rateStr[$i][1] * $games[$j][1]);
                                break;
                            }
                            if (preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $rateStr[$i][2]) == 'R') {
                                $sum = $sum + ($rateStr[$i][1] * $games[$j][2]);
                                break;
                            }
                            if (preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $rateStr[$i][2]) == 'D') {
                                $sum = $sum + ($rateStr[$i][1] * $games[$j][3]);
                                break;
                            }
                        }
                    }
                }
            }
            return $sum;
        } else {
            echo "Не цифровое значение в 1 строке";
        }
    } else {
        echo "Не цифровое значение в 1 строке";
    }
}