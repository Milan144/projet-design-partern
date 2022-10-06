<?php

class Algorithm{

    //Constructor
    public function __construct(){
        //Nothing to do here
    }
    // Get Signal returns 1 if the signa is buy, -1 if the signal is sell,  if the signal is hold

    public function getSignal ($arrayPrices){
        //Size of the array
        $size = count($arrayPrices);
        
        if($size < 10){
            return 0;
        }

        $sum = 0;
        for ($i = 0; $i < $size-1; $i++){
            $sum += $arrayPrices[$i];
        }

        
        $average = $sum / ($size -1);

        if ($arrayPrices[$size -1] > ($average*1.02)){
            return 1;
        }
        if ($arrayPrices[$size -1] < $average/1.02){
            return -1;
        }
        return 0;
    }
}