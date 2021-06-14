<?php
//Get lowest price (Price From)
function lowest_property_price($cruise_data, $fromLength, $fromYear)
{

    $prices = [];
    $itineraries = $cruise_data['Itineraries'];
    if (count($itineraries) > 0) {

        foreach ($itineraries as $i) {
            if ($i['LengthInDays'] >= $fromLength) {
                $rateYears = $i['RateYears'];
                foreach ($rateYears as $r) {
                    if ($r['Year'] >= $fromYear) {
                        $rates = $r['Rates'];
                        $rateValues = [];
                        foreach ($rates as $rate) {
                            if ($rate['WebAmount'] > 0) {
                                $rateValues[] = $rate['WebAmount'];
                            }
                        }
                        if ($rateValues) {
                            $prices[] = min($rateValues);
                        }
                    }
                }
            }
        }

        if (count($prices) > 0) {
            $lowestPrice = min($prices);
        } else {
            $lowestPrice = 0;
        }
    } else {
        $lowestPrice = 0;
    }


    return $lowestPrice;
}


//Range (From x Days to x Days)
function itineraryRange($cruise_data, $separator)
{
    $itineraries = $cruise_data['Itineraries'];
    $itineraryValues  = [];

    if (count($itineraries) > 0) {
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

function productType($property)
{
    $postType = get_post_type($property);

    if ($postType == 'rfc_tours') {
        echo 'Tour Package';
    } else if ($postType == 'rfc_lodges') {
        echo 'Lodge';
    } else if ($postType == 'rfc_cruises') {

        $cruiseType = get_field('cruise_type', $property);
        if ($cruiseType == 'river') {
            echo 'River Cruise';
        } else {
            echo 'Costal Cruise';
        }
    }
}


//Cruises available functions --> return number for the rectangular blocks on destination pages
//NOTE: this WILL include cruises with no departure dates... SERPs will not include cruises with no departure dates, itineraries, etc. So the number may differ.
//Location
function cruises_available_location($location)
{

    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(

            array(
                'key' => 'locations', // name of custom field
                'value' => '"' . $location->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );


    $count = 0;
    $cruisePosts = get_posts($postCriteria);

    //filter out charter only
    foreach ($cruisePosts as $c) {
        $charterOnly = get_field('charter_only', $c);
        if ($charterOnly == false) {
            $count++;
        }
    }

    return $count;
}

//Experience
function cruises_available_experience($destination, $experience)
{

    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destinations', // name of custom field
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


    $count = 0;
    $cruisePosts = get_posts($postCriteria);

    //filter out charter only
    foreach ($cruisePosts as $c) {
        $charterOnly = get_field('charter_only', $c);
        if ($charterOnly == false) {

            $count++;
        }
    }


    return $count;
}

//Charter
function cruises_available_charter($destination)
{
    $count = 0;
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destinations', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'charter_available', // name of custom field
                'value' => true,
                'compare' => 'LIKE'
            )
        )
    );
    $cruisesPosts = get_posts($postCriteria);
    $count = count($cruisesPosts);

    return $count;
}

//Cruises available region (experience templates)
function cruises_available_region($region, $experience, $isCharter)
{

    //DESTINATIONS
    $destinationCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_destinations',
        "meta_key" => "region",
        "meta_value" => $region->ID
    );
    $destinations = get_posts($destinationCriteria);

    //get destination IDs
    $destinationIds = [];
    foreach ($destinations as $d) {
        $destinationIds[] = $d->ID;
    }

    //build meta query criteria
    $queryargs = array();
    $queryargs['relation'] = 'OR';
    foreach ($destinationIds as $d) {
        $queryargs[] = array(
            'key'     => 'destinations',
            'value'   => serialize(strval($d)),
            'compare' => 'LIKE'
        );
    }


    $count = 0;

    if ($isCharter == false) {
        $postCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_cruises',
            'meta_query' => array(
                'relation' => 'AND',
                $queryargs,
                array(
                    'key' => 'experiences', // name of custom field
                    'value' => '"' . $experience->ID . '"',
                    'compare' => 'LIKE'
                )
            )
        );
    } else {
        $postCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_cruises',
            'meta_query' => array(
                'relation' => 'AND',
                $queryargs,
                array(
                    'key' => 'charter_available', // name of custom field
                    'value' => true,
                    'compare' => 'LIKE'
                )
            )
        );
    }

    $cruisesPosts = get_posts($postCriteria);
    $count = count($cruisesPosts);
    return $count;
}










function check_if_promo($cruise_data, $startDate, $endDate, $lengthMin, $lengthMax)
{
    //filter itineraries if selection
    $itineraries = $cruise_data['Itineraries'];
    $filteredItineraries = [];

    foreach ($itineraries as $itinerary) {
        if ($itinerary['LengthInDays'] >= $lengthMin && $itinerary['LengthInDays'] <= $lengthMax) {
            $filteredItineraries[] = $itinerary;
        }
    }

    $hasPromo = false;
    foreach ($filteredItineraries as $itinerary) {

        $departures = $itinerary['Departures'];
        foreach ($departures as $departure) {
            $dateString = strtotime($departure['DepartureDate']);
            if ($dateString >= $startDate && $dateString <= $endDate) {
                if ($departure['HasPromo'] == true) {
                    $hasPromo = true;
                }
            }
        }
    }
    return $hasPromo;
}
