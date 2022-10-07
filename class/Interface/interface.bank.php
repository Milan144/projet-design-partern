<?php

interface Bank
{
    public function getMyMoney($id): array;
    public function storeMoney($amount): void;
    public function withdrawMoney($amount): float;
    public function storeCryptos($oneCryptoBought): void;
    public function getACrypto($symbol): array;
    public function withdrawACrypto($symbol): array;
}
