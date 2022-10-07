<?php

interface Trader{
    public function buy(String $symbol, float $quantity, float $price) : array;
    public function sell(String $symbol, float $currentPrice) : float;
}