<?php
class BinanceTraderFactory extends TraderFactory{

    public function createTrader(Bank $bank): Trader{
        return new TraderBinance($bank);
    }
}