<?php
require_once('class/classes.php');

$manager = new WalletManager($pdo);
$wallet = $manager->getById(2);
$manager->addWallet('$', 1, 200000000);
// $manager->updateWalletSold(2, 7);
var_dump($wallet);

$bdd = new DBConnector();
$pdo = $bdd->connexion();
$bank = new Banker($wallet);
$money = $bank->getMyMoney($pdo, 2);
echo "solde sur le wallet : " . $money;

$dtr = new DataRetriever('https://api.binance.com/api/v3/ticker/price');
// Boucle while ??

//Connexion au bordel

//analyser return si on est en position d'achat ou de vente et lance en conséquence le trader

// creation du wallet et banker pour la binance factory

// Retire ou ajoute money ou crypto au banker

// $pltf = new PlatformBinance($trader, $analyser);

// $pltf->run();
