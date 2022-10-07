<?php
include "connexion.php";

class Wallet
{
    private $id;
    private $symbol;
    private $buyingPrice;
    private $quantity;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }
    public function getSymbol()
    {
        return $this->symbol;
    }

    public function setPrice($buyingPrice)
    {
        $this->buyingPrice = $buyingPrice;
    }
    public function getPrice()
    {
        return $this->buyingPrice;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

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

    public function getById(int $id)
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

    public function addWallet(String $symbol, float $buyingPrice, float $quantity)
    {
        $del = $this->db->prepare("insert into Wallet (symbol, buyingPrice, quantity) values (?,?,?)");
        $del->execute(array($symbol, $buyingPrice, $quantity));
    }

    public function updateWalletSold(float $amount, int $id)
    {
        $update = $this->db->prepare("update Wallet set quantity=? where id=?");
        $update->execute(array($amount, $id));
    }

    public function deleteWallet(int $id)
    {
        $del = $this->db->prepare("delete from Wallet where id=?");
        $del->execute(array($id));
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}
