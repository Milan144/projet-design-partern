<?php

interface Trader {
    public function buy();
    public function sell();
}

abstract class TraderFactory{
    public abstract function createTrader(): Trader;
}

class BinanceTraderFactory{
    public function createTrader(): Trader{
        return new BinanceTrader();
    }
}
// ------------------------------------
class CoinbaseTraderFactory{
    public function createTrader(): Trader{
        return new CoinbaseTrader();
    }
}
// -------------------------------------


class BinanceTrader implements Trader{
    public function buy($symbol, $quantity, $amount){
        #demande au banker $amount
        #withdraw au bunker
        # add onecrypto

    }

    public function sell($symbol, $quantity, $amount){
        #demande au banker les crypto
        #donnel'argent au banker
        
    }
}