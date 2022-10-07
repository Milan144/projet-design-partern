<?php

include "class/class.algorithm.php";
include "class/class.dataretriever.php";
include "class/class.proxydataretriever.php";

include "class/interfaces/interface.bank.php";
include "class/class.wallet.php";
include "class/class.banker.php";

include "class/abstract.class.traderfactory.php";
include "class/binance/class.binanceTraderFactory.php";
include "class/interfaces/interface.trader.php";
include "class/binance/class.traderBinance.php";
include "class/class.analyzer.php";
include "class/binance/class.platformbinance.php";
include "class/class.command.php";

include "class/class.logger.php";


$factory = new BinanceTraderFactory();
$analizer = new Analyzer(
    new ProxyDataRetriever(
        new DataRetriever("https://api.binance.com/api/v3/ticker/price")
    ),
    new Algorithm()
);

$bank = new Banker(new Wallet());

$pltf = new PlatformBinance($analizer, $factory->createTrader($bank));

$pltf->run();