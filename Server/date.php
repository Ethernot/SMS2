<?php
function getLogFileName($switchname)
{
    //DATA
    $now = time();
    $num = date("w");
    if ($num == 0) {
        $sub = 6;
    } else {
        $sub = ($num - 1);
    }
    $WeekMon = mktime(0, 0, 0, date("m", $now), date("d", $now), date("Y", $now));    //monday week begin calculation
    $todayh = getdate($WeekMon); //monday week begin reconvert
    $d = $todayh[mday];
    $m = $todayh[mon];
    $y = $todayh[year];
    $date = "$d-$m-$y"; //getdate converted day

    $date = $date . ".txt";
    $dir = $switchname . '/';

    $dir = $dir . $date;
    $dir = $switchname . '/';
    $dir = $dir . $date;

    return $dir;
    //DATA
}

function getLogFileNow($switchname)
{
    //DATA
    $now = time();
    $num = date("w");
    if ($num == 0) {
        $sub = 6;
    } else {
        $sub = ($num - 1);
    }
    $todayh = getdate(); //monday week begin reconvert
    $d = $todayh[mday];
    $m = $todayh[mon];
    $y = $todayh[year];
    $h = $todayh[hours];
    $m = $todayh[minutes];
    $date = "$d-$m-$y-$h-$m"; //getdate converted day

    $date = $date . ".txt";
    $dir = $switchname . '/';

    $dir = $dir . $date;
    $dir = $switchname . '/';
    $dir = $dir . $date;

    return $dir;
    //DATA
}

?>﻿
