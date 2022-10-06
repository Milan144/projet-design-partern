<?php

include "main.php";

$alg = new Algorithm();

$trashArray = array();

while (count($trashArray)<39){
    $trashArray[] = 1;
}

$trashArray[] = 1;

echo $alg->getSignal($trashArray);