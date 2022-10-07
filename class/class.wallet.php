<?php

class Wallet implements Bank
{
    private float $myMoney; // Amount in USDT
    private array $myCryptos; // Array of crypto we bought with the buying price and the quantity

    public function __construct()
    {
        if(!file_exists("wallet.json")) {
            $this->myMoney = 1000;
            $this->myCryptos = array();
            $this->save();
        }
        else{
            $this->load();
        }
    }

    // Function to save the wallet into a json file
    public function save()
    {
        $wallet = array(
            "myMoney" => $this->myMoney,
            "myCryptos" => $this->myCryptos
        );

        $json = json_encode($wallet);
        file_put_contents("wallet.json", $json);
    }

    // Function to load the wallet from a file
    public function load()
    {
        $json = file_get_contents("wallet.json");
        $wallet = json_decode($json, true);

        $this->myMoney = $wallet["myMoney"];
        $this->myCryptos = $wallet["myCryptos"];
    }

    public function getMyMoney(): float
    {
        return $this->myMoney;
    }

    public function storeMoney($amount): void
    {
        $this->myMoney += $amount;
        $this->save();
    }

    public function withdrawMoney($amount): float
    {
        $this->myMoney -= $amount;
        $this->save();
        return $amount;
    }

    public function storeCryptos($oneCryptoBought): void
    {
        $this->myCryptos[] = $oneCryptoBought;
        $this->save();
    }

    public function getACrypto($symbol): array
    {
        $oneCrypto = $this->myCryptos[0];

        for ($i = 1; $i < count($this->myCryptos); $i++) {

            if ($this->myCryptos[$i]["symbol"] != $symbol) {
                continue;
            }

            if ($this->myCryptos[$i]["buyingPrice"] < $oneCrypto["buyingPrice"]) {
                $oneCrypto = $this->myCryptos[$i];
            }
        }

        return $oneCrypto;
    }

    public function withdrawACrypto($symbol): array
    {
        $index = 0;
        $oneCrypto = $this->myCryptos[0];

        for ($i = 1; $i < count($this->myCryptos); $i++) {
            $index = $i;
            if ($this->myCryptos[$i]["symbol"] != $symbol) {
                continue;
            }

            if ($this->myCryptos[$i]["buyingPrice"] < $oneCrypto["buyingPrice"]) {
                $oneCrypto = $this->myCryptos[$i];
            }
        }

        unset($this->myCryptos[$index]);

        $this->save();
        return $oneCrypto;
    }
}