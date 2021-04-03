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
    //запись в массив ставок.
    if ($tm != 0) {
        $sum = 0;
        $rateStr = array();//так ли
        for ($i = 0; $i < $tm; ++$i) {
            list($id, $bet, $win) = explode(" ", $mas[$i + 1]);
            //$rateStr[$i] = explode(" ", $mas[$i + 1]);
            $rateStr[$id]['bet']=(int)$bet;
            $rateStr[$id]['win']=trim($win, "\n\r");
            $sum = $sum - $bet;
        }
        //число записей - количество игр.
        $tm = (int)$mas[$mas[0] + 1];
        //запись в массив игр.
        if ($tm != 0) {
            $games = array();
            for ($i = 0; $i < $tm; ++$i) {
                list($id,$coefL,$coefR,$coefD,$gameWin)=explode(" ", $mas[$mas[0] + 2 + $i]);
                $games[$id]['coefL']=(float)$coefL;
                $games[$id]['coefR']=(float)($coefR);
                $games[$id]['coefD']=(float)($coefD);
                $games[$id]['gameWin']=trim($gameWin, "\n\r");
                //$games[$i] = explode(" ", $mas[$mas[0] + 2 + $i]);
            }
            foreach($rateStr as $id =>$rateStr){
                if($rateStr['win']==$games[$id]['gameWin'] && $rateStr['win']=='L')
                {
                    $sum=$sum+($rateStr['bet']*$games[$id]['coefL']);
                }
                if($rateStr['win']==$games[$id]['gameWin'] && $rateStr['win']=='R')
                {
                    $sum=$sum+($rateStr['bet']*$games[$id]['coefR']);
                }
                if($rateStr['win']==$games[$id]['gameWin'] && $rateStr['win']=='D')
                {
                    $sum=$sum+($rateStr['bet']*$games[$id]['coefD']);
                }
            }
            return $sum;
            }
        else {
            echo "Не цифровое значение в 1 строке";
        }
    }
    else {
        echo "Не цифровое значение в 1 строке";
    }
}