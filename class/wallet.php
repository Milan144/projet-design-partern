<?php

interface Bank{
    public function storeMoneyBank($amount);
    public function withdrawMoneyBank($amount);
}


class Wallet{
    private $myMoney; // Amount in USDT
    private $myCryptos; // Array of crypto we bought with the buying price and the quantity

    public function __construct(){
        $this->myMoney = 1000;
        $this->myCryptos = array();
    }

    public function getMyMoney(){
        return $this->myMoney;
    }

    public function storeMoney($amount){
        $this->myMoney += $amount;
    }

    public function withdrawMoney($amount){
        $this->myMoney -= $amount;
    }

    public function storeCryptos($oneCryptoBought){
        $this->myCryptos[] = $oneCryptoBought;
    }

    public function getACrypto($symbol){
        $oneCrypto = $this->myCryptos[0];

        for ($i = 1; $i < count($this->myCryptos); $i++) {

            if($this->myCryptos[$i]["symbol"] != $symbol){
                continue;
            }

            if($this->myCryptos[$i]["buyingPrice"] < $oneCrypto["buyingPrice"]){
                $oneCrypto = $this->myCryptos[$i];
            }
        }

        return $oneCrypto;
    }
    public function withdrawACrypto($symbol){
        $index = 0;
        $oneCrypto = $this->myCryptos[0];

        for ($i = 1; $i < count($this->myCryptos); $i++) {
            $index = $i;
            if($this->myCryptos[$i]["symbol"] != $symbol){
                continue;
            }

            if($this->myCryptos[$i]["buyingPrice"] < $oneCrypto["buyingPrice"]){
                $oneCrypto = $this->myCryptos[$i];
            }
        }

        unset($this->myCryptos[$index]);

        return $oneCrypto;
    }
}

//Proxy car le Banker fait le tampon/stockage de l'argent, et n'envoie pas de requête toute les deux secondes

class Banker implements Bank{
    //Récupération des infos du wallet
    private Wallet $myWallet;
    private double $buffer;

    public function __construct(Waller $myWallet){
        $this->myWallet = $myWallet;
    }

    public function storeMoneyBank($amount){
        $this->buffer += $amount;


        if ($this->buffer > 1000){
            myWallet.storeMoney($this->buffer);
            $this->buffer = 0;
            echo "Banker reset";
            return;
        }
        echo "Money stored";
        return;
    }

    public function withdrawMoneyBank($amount){
        $this->buffer -= $amount;
    }
}