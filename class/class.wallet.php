<?php
include "connexion.php";

class Wallet
{
    private $id;
    private $symbol;
    private $buyingPrice;
    private $quantity;

    public function __construct(int $id, String $symbol, int $buyingPrice, int $quantity)
    {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->buyingPrice = $buyingPrice;
        $this->quantity = $quantity;
    }
}

class WalletManager
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getById($id)
    {
        $getWallet = $this->db->prepare("select * from Wallet where id=? limit 1");
        $wallet = $getWallet->execute(array($id));
        if ($wallet = $getWallet->fetch(PDO::FETCH_ASSOC)) {
            $id = $wallet['id'];
            $symbol = $wallet['symbol'];
            $buyingPrice = $wallet['buyingPrice'];
            $quantity = $wallet['quantity'];

            return new Wallet($id, $symbol, $buyingPrice, $quantity);
        }
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}
