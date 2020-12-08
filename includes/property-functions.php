<?php 
//Get lowest price (Price From)
function lowest_property_price($cruise_data, $fromLength, $fromYear)
{

    $prices = [];

    $itineraries = $cruise_data['Itineraries'];
    foreach($itineraries as $i){
        if($i['LengthInDays'] >= $fromLength){
            $rateYears = $i['RateYears'];   
            foreach($rateYears as $r){
                if($r['Year'] >= $fromYear) {
                    $rates = $r['Rates'];
                    $rateValues = [];
                    foreach($rates as $rate){
                        $rateValues[] = $rate['WebAmount'];
                    }
                    if($rateValues){
                        $prices[] = min($rateValues);
                    }
                    
                }     
            }  
        }
         
    }


    $lowestPrice = min($prices);
 
    return $lowestPrice;
}


//Range (From x Days to x Days)
function itineraryRange($cruise_data, $separator)
{
    $itineraries = $cruise_data['Itineraries'];
    $itineraryValues  = [];

    foreach($itineraries as $i){
        $itineraryValues[] = $i['LengthInDays'];       
    }

    $rangeFrom = min($itineraryValues);
    $rangeTo = max($itineraryValues);
    $returnString = "";
    if($rangeFrom != $rangeTo){
        $returnString = $rangeFrom . $separator . $rangeTo;
    } else {
        $returnString = $rangeFrom;
    }

    return $returnString;
}
