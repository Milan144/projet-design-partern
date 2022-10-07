<?php
include("connexion.php");
include("class/class.proxydataretriever.php");
include("class/class.dataretriever.php");
include("class/class.algorithm.php");
include("class/class.trader.php");
include("class/class.wallet.php");
include("class/class.trader.php");

$manager = new WalletManager($pdo);
$wallet = $manager->getById(2);
$manager->addWallet('$', 1, 200000000);
// $manager->updateWalletSold(2, 7);
var_dump($wallet);


// Boucle while ??

//Connexion au bordel

//analyser return si on est en position d'achat ou de vente et lance en conséquence le trader

// creation du wallet et banker pour la binance factory

// Retire ou ajoute money ou crypto au banker










