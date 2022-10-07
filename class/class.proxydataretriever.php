<?php

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