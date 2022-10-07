<?php


class PlatformBinance{
    Analyser $analyser;
    Trader $trader;

    public function run():void{
        while($command = $this->analyser->waitForCommand()){
            if ($command->getAction()== "buy"){
                $quantity = 1;

                $this->trader->buy(
                    $command->getSymbol(),
                    $quantity,
                    $command->getPrice()
                );
            } else{
                $this->trader->sell(
                    $command->getSymbol(),
                    $command->getPrice()
                )
            }
        }
    }
}