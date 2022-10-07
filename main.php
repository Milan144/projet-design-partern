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

$dtr = new DataRetriever('https://api.binance.com/api/v3/ticker/price');
// Boucle while ??

//Connexion au bordel

//analyser return si on est en position d'achat ou de vente et lance en conséquence le trader

// creation du wallet et banker pour la binance factory

// Retire ou ajoute money ou crypto au banker

// $pltf = new PlatformBinance($trader, $analyser);

// $pltf->run();



//__________________________________________________________

// initialisation : Wallet et Banker
// Connexion entre la DataBase et le wallet via un Singleton (limite instance de connexion)

$wallet = new Wallet();

$bank = new Banker($wallet); //lien avec le wallet                  #Pattern Proxy lien Trader DB

// Initialisation du traitement des data

$url = "https://api.binance.com/api/v3/ticker/price";  //API BINANCE

$dtr = new DataRetriever($url);

$proxy = new ProxyDataRetriever($dtr);

//Initialisation du trader ( Factory => construction des objets)

$factory = newBinanceTraderFactory();

// creation d'un trader reutilisable quelque soit la plateform ( seulement une petite modif )

$traderLambda = $factory->createTrader(new Banker());

// initialisation de l'analyser : prend en charge un historique de pris donné par le dataretriever



//lance la plateforme qui prend en charge l'analyser et le trader
//l'analyser tourne et prend ses décisions : lorsque 1 /-1 est retourné ==> envoie d'une instruction (via les classes COMMAND et WAITFORCOMMAND) au trader de l'achat ou de la vente

# if getSignal return 0 => wait
# if getSignal return 1 => lancement TradingCommand -> buy
# if getSignal return -1 => lancement TradinCommand -> sell


// trader demande au banker si il y a assez pour effectuer une transaction ou alors encaisse








