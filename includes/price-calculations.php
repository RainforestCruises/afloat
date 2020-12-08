<?php
//Console Log Utility--------------
function lowest_tour_price($price_packages, $fromYear)
{
    

    $priceList = [];

    if ($price_packages) {
        foreach ($price_packages as $price_package) {
            if ($price_package['year'] >= $fromYear) {
                $priceList[] = $price_package['price'];
            }
        }
    }


    $lowestPrice = 0;
    if ($priceList) {
        sort($priceList);
        $lowestPrice = $priceList[0];
    }
    
    return $lowestPrice;
}
//--------------------------------
