<?php

include "main.php";

$dtr = new DataRetrievr();

while(TRUE){
    $data = $dtr->getData();
    $price = $dtr->getPairPrice;
    $count = count($data);
    echo "N : $count";
    sleep(3);
}

$alg = new Algorithm();

$trashArray = array();

while (count($trashArray)<39){
    $trashArray[] = 1;
}

$trashArray[] = 1;

echo $alg->getSignal($trashArray);