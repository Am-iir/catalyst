#!/usr/bin/php -q

<?php

$i = 1;
$output = '';

while ($i <= 100) {

    $checkFor3 = $i % 3 === 0;
    $checkFor5 = $i % 5 === 0;

    if ($checkFor3 && $checkFor5) {
        $string = 'foobar';
    } elseif ($checkFor3) {
        $string = 'foo';
    } elseif ($checkFor5) {
        $string = 'bar';
    } else {
        $string = $i;
    }

    $output .= $i !== 100 ? "$string, " : "$string \n";

    $i++;
}

echo $output;
exit();
