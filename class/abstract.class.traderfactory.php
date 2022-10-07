<?php
abstract class TraderFactory{
    public abstract function createTrader(Bank $bank): Trader;
}