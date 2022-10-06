<?php
include "connexion.php";

class Wallet
{
    private $id;
    private $symbol;
    private $amount;

    public function __construct(int $id, String $symbol, int $amount)
    {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->amount = $amount;
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
            $amount = $wallet['value'];

            return new Wallet($id, $symbol, $amount);
        }
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}
