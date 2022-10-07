<?php

class TradingCommand{
     private String $action;
     private String $symbol;
     private float $price;

     public function getAction():String{
        //donne l'action à executer
        return $this->action;
     }

     public function getPrice():float{
        //renvoie le prix
        return $this->price;
     }

     public function getSymbol():String{
        //renvoie la monnaie
        return $this->symbol;
     }
}