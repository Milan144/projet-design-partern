<?php

class PlatformBinance
{
    private Analyzer $analyzer;
    private Trader $trader;

    public function __construct(Analyzer $analyzer, Trader $trader)
    {
        $this->analyzer = $analyzer;
        $this->trader = $trader;
    }

    public function run(): void
    {

        while ( $command = $this->analyzer->waitForCommand()) {
            Logger::log("Command received: " . $command->getAction());
            if ($command->getAction() == "buy") {

                // Ramener le prix a 20
                $quantity = 20/$command->getPrice();

                $this->trader->buy(
                    $command->getSymbol(),
                    $quantity,
                    $command->getPrice()
                );
            } else {
                $this->trader->sell(
                    $command->getSymbol(),
                    $command->getPrice()
                );
            }
        }
    }
}