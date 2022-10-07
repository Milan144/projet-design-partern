<?php
class Analyzer{
    private ProxyDataRetriever $dataRetriever;
    private Algorithm $algorithm;

    private array $symbolsHistory;

    public function __construct(ProxyDataRetriever $dataRetriever, Algorithm $algorithm){
        $this->dataRetriever = $dataRetriever;
        $this->algorithm = $algorithm;
    }

    public function waitForCommand(): TradingCommand
    {
        // Algo:
        // 1. Get data
        // 2. Analyze data
        // 3. Return command (buy/sell) if the signal is 1 or -1
        // 4. Wait 5 seconds
        // 5. Repeat
        while(true) {
            $allPrices = $this->dataRetriever->getData();

            // Save the data
            $this->saveData($allPrices);
            Logger::log("Data saved (".count($this->symbolsHistory)." symbols)");

            // Foreach symbol, analyze the data with the algorithm
            foreach ($this->symbolsHistory as $symbol => $historyArray) {
                $signal = $this->algorithm->getSignal($historyArray);

                if ($signal == 1) {
                    Logger::log("Signal buy for symbol $symbol");
                    return new TradingCommand("buy", $symbol, $historyArray[count($historyArray) - 1]);
                } elseif ($signal == -1) {
                    Logger::log("Signal sell for symbol $symbol");
                    return new TradingCommand("sell", $symbol, $historyArray[count($historyArray) - 1]);
                }
            }
            sleep(1);
        }
    }

    private function saveData(array $data){
        foreach ($data as $key => $onePair) {
            // only the pair with a symbol ending with USDT
            if (substr($onePair["symbol"], -4) != "USDT") {
                continue;
            }

            $this->symbolsHistory[$onePair["symbol"]][] = $onePair["price"];
            // If we have more than 20 values (20 * 5 seconds = 100 seconds) we remove the first one
            if(count($this->symbolsHistory[$onePair["symbol"]]) > 20){
                array_shift($this->symbolsHistory[$onePair["symbol"]]);
            }
        }
    }
    /**
     * {
     *     "BTCUSDT" : [.....],
     *     "ETHUSDT" : [.....],
     * }
     */
}