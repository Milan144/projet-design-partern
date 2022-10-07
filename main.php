<?php
include("connexion.php");
include("class/class.proxydataretriever.php");
include("class/class.dataretriever.php");
include("class/class.algorithm.php");
include("class/class.trader.php");
include("class/class.wallet.php");
include("class/class.trader.php");


// $urlAPI = "https://api.binance.com/api/v3/ticker/price";

// $api = file_get_contents('https://api.binance.com/api/v3/ticker/price');



// $tabPrixCrypto = (explode("{", $api));
// $prixBTC = ($tabPrixCrypto[12]);

// preg_match_all('!\d+(?:\.\d+)?!', $prixBTC, $matches);
// echo ($matches[0][0])


$manager = new WalletManager($pdo);
$wallet = $manager->getById(1);
var_dump($wallet);
