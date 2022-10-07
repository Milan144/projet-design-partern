<?php

interface Bank
{
    public function getMyMoney($pdo, $id): float;
    public function storeMoney($amount): void;
    public function withdrawMoney($amount): float;
    public function storeCryptos($oneCryptoBought): void;
    // public function getACrypto($symbol): array;
    // public function withdrawACrypto($symbol): array;
}
