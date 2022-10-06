<?php

try {
    #MAC
    #$pdo = new PDO("mysql:host=localhost;dbname=bot-crypto", "root", "root");
    #WIN
    $pdo = new PDO("mysql:host=localhost;dbname=bot-crypto", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}


// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

//example : 

$urlAPI = "https://api.binance.com/api/v3/ticker/price";

$api = file_get_contents('https://api.binance.com/api/v3/ticker/price');



$tabPrixCrypto = (explode("{", $api));
$prixBTC = ($tabPrixCrypto[12]);

preg_match_all('!\d+(?:\.\d+)?!', $prixBTC, $matches);
echo ($matches[0][0]);
