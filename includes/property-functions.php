<?php
//Get lowest price (Price From)
function lowest_property_price($cruise_data, $fromLength, $fromYear)
{

    $prices = [];

    $itineraries = $cruise_data['Itineraries'];
    if($itineraries){
        foreach ($itineraries as $i) {
            if ($i['LengthInDays'] >= $fromLength) {
                $rateYears = $i['RateYears'];
                foreach ($rateYears as $r) {
                    if ($r['Year'] >= $fromYear) {
                        $rates = $r['Rates'];
                        $rateValues = [];
                        foreach ($rates as $rate) {
                            $rateValues[] = $rate['WebAmount'];
                        }
                        if ($rateValues) {
                            $prices[] = min($rateValues);
                        }
                    }
                }
            }
        }
      
        $lowestPrice = min($prices);
        //console_log('has_itinerary');
    } else {
        $lowestPrice = 0;
        //console_log('no_itinerary');
    }


    return $lowestPrice;
}


//Range (From x Days to x Days)
function itineraryRange($cruise_data, $separator)
{
    $itineraries = $cruise_data['Itineraries'];
    $itineraryValues  = [];

    if($itineraries){
        foreach ($itineraries as $i) {
            $itineraryValues[] = $i['LengthInDays'];
        }
    
        $rangeFrom = min($itineraryValues);
        $rangeTo = max($itineraryValues);
        $returnString = "";
        if ($rangeFrom != $rangeTo) {
            $returnString = $rangeFrom . $separator . $rangeTo;
        } else {
            $returnString = $rangeFrom;
        }
    } else {
        $returnString = "N/A";
    }


    return $returnString;
}

function countriesInDestinations($destinations, $separator)
{

    $count = 0;
    if ($destinations) {
        foreach ($destinations as $r) {
            if ($r) {
                $isCountry = get_field('is_country', $r);
                if ($isCountry == true) {
                    $title = get_the_title($r);
                    if ($count != 0) {
                        echo " $separator " . $title;
                    } else {
                        echo $title;
                    }
                    $count++;
                }
            }
        }
    }
}

function productType($property) {
    $postType = get_post_type($property);

    if($postType == 'rfc_tours'){
        echo 'Tour Package';
    }else if ($postType == 'rfc_lodges'){
        echo 'Lodge';

    }else if ($postType == 'rfc_cruises'){

        $cruiseType = get_field('cruise_type', $property);
        if($cruiseType == 'river'){
            echo 'River Cruise';
        }else {
            echo 'Costal Cruise';

        }
        

    }
}


function cruises_available_location($location)
{

    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
    );

    $postCriteria['meta_query'][] = array(
        'key' => 'locations',
        'value' => '"' . $location->ID . '"',
        'compare' => 'LIKE'
    );

    $count = 0;


    $cruisePosts = get_posts($postCriteria);
    $count = count($cruisePosts);
    return $count;

}


function cruises_available_experience($destination, $experience)
{
    $count = 0;
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destination', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'experiences', // name of custom field
                'value' => '"' . $experience->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );
    $cruisesPosts = get_posts($postCriteria);
    $count = count($cruisesPosts);

    return $count;
}