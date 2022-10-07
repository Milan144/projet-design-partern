<?php

class TraderBinance implements Trader{

    private Bank $wallet;

    public function __construct(Bank $wallet){
        $this->wallet = $wallet;
    }

    public function buy(string $symbol, float $quantity, float $price): array
    {
        echo "Bought $quantity $symbol at $price on BINANCE";
        return $this->wallet->storeCryptos(
            array(
                "symbol" => $symbol,
                "buyingPrice" => $price,
                "quantity" => $quantity
            )
        );

        $this->wallet->withdrawMoney($quantity * $price);

        // TODO: implement buy on Binance Platform
        return array($symbol, $quantity, $price);
    }

    public function sell(string $symbol, float $currentPrice): float
    {

        $aCrypto = $this->wallet->getACrypto($symbol);

        if($aCrypto["buyingPrice"] < $currentPrice){
            echo "Sold ".$aCrypto["quantity"]." $symbol at $currentPrice on BINANCE";

            $this->wallet->withdrawACrypto($symbol);

            // TODO: Implement sell() method on Binance Platform

            $this->wallet->storeMoney($aCrypto["quantity"] * $currentPrice);
            return $aCrypto["quantity"] * $currentPrice;
        }


    }
}


