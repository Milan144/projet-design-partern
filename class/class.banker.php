<?php
include "class.wallet.php";
include "connexion.php";

class Banker implements Bank
{

    private Wallet $wallet;

    private float $myMoneyBuffer;

    public function __construct($wallet)
    {
        $this->wallet = $wallet;
        $this->myMoneyBuffer = $wallet->getMyMoney();
    }

    public function getMyMoney($pdo, $id): float
    {
        $manager = new WalletManager($pdo);
        $reponse = $manager->getById($id);
        return $reponse->getQuantity();
    }

    public function storeMoney($amount): void
    {
        $this->myMoneyBuffer += $amount;

        if ($this->myMoneyBuffer >= $this->wallet->getMyMoney() + 100) {
            $this->wallet->storeMoney($this->myMoneyBuffer - $this->wallet->getMyMoney());
        }
    }

    public function withdrawMoney($amount): float
    {
        $this->myMoneyBuffer -= $amount;

        if ($this->myMoneyBuffer <= $this->wallet->getMyMoney() - 100) {
            $this->wallet->withdrawMoney($this->wallet->getMyMoney() - $this->myMoneyBuffer);
        }

        return $this->myMoneyBuffer;
    }

    public function storeCryptos($oneCryptoBought): void
    {
        $this->wallet->storeCryptos($oneCryptoBought);
    }

    // public function getACrypto($symbol): array
    // {
    //     $this->walletf->getACrypto($symbol);
    // }

    // public function withdrawACrypto($symbol): array
    // {
    //     $this->wallet->withdrawACrypto($symbol);
    // }
}
