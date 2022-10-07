<?php

class DataRetriever{
    private $url;
    private $data = array();

    public function __construct($url){
        $this->url = $url;
    }

    public function getData(){
        $json = file_get_contents($this->url);
        $this->data = json_decode($json, true);
        return $this->data;
    }

    public function getPairPrice($pair){
        foreach ($this->data as $key => $onePair) {
            if($onePair["symbol"] == $pair){
                return $onePair['price'];
            }
        }
    }
}

class ProxyDataRetriever{
    private array $data;
    private int $lastRequestTimestamp;
    private DataRetriever $dataRetriever;

    public function __construct(DataRetriever $dataRetriever){
        $this->lastRequestTimestamp = 0;
        $this->dataRetriever = $dataRetriever;
    }

    public function getData(){
        if(time() - $this->lastRequestTimestamp > 20){
            $this->data = $this->dataRetriever->getData();
            $this->lastRequestTimestamp = time();
        }
        return $this->data;
    }

    public function getPairPrice($pair){
        return $this->dataRetriever->getPairPrice($pair);
    }
}

class Algorithm{

    // Constructor
    public function __construct(){
        // Nothing to do here
    }

    // Get signal. Returns 1 if the signal is buy, -1 if the signal is sell, 0 if the signal is hold
    public function getSignal($arrayPrices)
    {
        // Size of the array
        $size = count($arrayPrices);

        // If the size is less than 10, return 0
        if ($size < 10) {
            return 0;
        }

        $sum = 0;
        for ($i = 0; $i < $size - 1; $i++) {
            $sum += $arrayPrices[$i];
        }

        $average = $sum / ($size - 1);

        // BUY
        if ($arrayPrices[$size - 1] > $average*1.02) {
            return 1;
        }

        // SELL
        if ($arrayPrices[$size - 1] < $average/1.02) {
            return -1;
        }

        return 0;
    }
}

?>