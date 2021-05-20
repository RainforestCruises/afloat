<?php
//Upper bounded list of products for search results
function getSearchPosts($travelStyles, $destinations, $experiences, $searchType, $destinationId, $regionId)
{

    if($travelStyles == null) {
        $travelStyles = array('rfc_cruises', 'rfc_tours', 'rfc_lodges');
    }
    $args = array(
        'posts_per_page' => -1,
        'post_type' => $travelStyles,
    );



    //Get destinations by destination
    
    if ($searchType == 'destination') { //DESTINATION
        if ($destinations != null) { //selection - (Get Lima, Cusco, Amazon)

            $queryargs = array();
            $queryargs['relation'] = 'OR';
            foreach ($destinations as $l) {
                $queryargs[] = array(
                    'key'     => 'locations',
                    'value'   => '"' . $l . '"',
                    'compare' => 'LIKE'
                );
            }

            $args['meta_query'][] = $queryargs;
        } else { //no selection -- (Get all from Peru)
        
            $args['meta_query'][] = array(
                'key' => 'destinations',
                'value' => '"' . $destinationId . '"',
                'compare' => 'LIKE'
            );
        }
    }

    if ($searchType == 'region') { //REGION 
        if ($destinations != null) { //if selection

            $queryargs = array();
            $queryargs['relation'] = 'OR';
            foreach ($destinations as $d) {
                $queryargs[] = array(
                    'key'     => 'destinations',
                    'value'   => '"' . $d . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                    'compare' => 'LIKE'
                );
            }

            $args['meta_query'][] = $queryargs;
        } else { //if no selection
            //- Get destinations by region if nothing selected, then get all products in those destinations

            $destinationCriteria = array(
                'posts_per_page' => -1,
                'post_type' => 'rfc_destinations',
                "meta_key" => "region",
                "meta_value" => $regionId
            );
            $destinations = get_posts($destinationCriteria);

            //build meta query criteria
            $queryargs = array();
            $queryargs['relation'] = 'OR';
            foreach ($destinations as $d) {
                $queryargs[] = array(
                    'key'     => 'destinations',
                    'value'   => serialize(strval($d->ID)),
                    'compare' => 'LIKE'
                );
            }

            $args['meta_query'][] = $queryargs;
        }
    }



    //experiences
    if ($experiences != null) {


        $queryargs = array();
        $queryargs['relation'] = 'OR';
        foreach ($experiences as $e) {
            $queryargs[] = array(
                'key'     => 'experiences',
                'value'   => '"' . $e . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                'compare' => 'LIKE'
            );
        }

        $args['meta_query'][] = $queryargs;
    }



    $posts = get_posts($args); //Stage I posts

    return $posts;

}


function formatFilterSearch($posts, $minLength, $maxLength, $datesArray)
{

    $results = [];
    $startYear = date('Y'); //change to be minimim start year if dates selected --> this is for determining lowest price
    if ($datesArray) {
        //find start year

        $yearsInSelection = [];
        foreach ($datesArray as $a) {
            $date = DateTime::createFromFormat("Y-m", $a);
            $yearValue = $date->format("Y");
            $yearsInSelection[] = $yearValue;
        }
        $startYear = min($yearsInSelection);
    }

    //loop through posts (travel type, experience, destinations --> already filtered)
    foreach ($posts as $p) {

        $postType = get_post_type($p);
        $productTitle = "";
        $productTypeDisplay = "";
        $productTypeCta = "";
        $snippet = get_field('top_snippet', $p);
        $featuredImage = get_field('featured_image', $p); //need specific image size  - 600x500
        $productImageUrl = "";
        $charterOnly = get_field('charter_only', $p);

        if ($featuredImage) {
            $productImageUrl = wp_get_attachment_image_url($featuredImage['id'], 'featured-square');
        }


        $vesselCapacity = 0;
        $numberOfCabins = 0;

        $itineraries = [];

        $itineraryCountDisplay = "";
        $itineraryLengthDisplay = "";
        $vesselCapacityDisplay = "";
        $numberOfCabinsDisplay = "";

        $promoAvailable = false;

        // $resultLink = get_permalink($p);
        // $charterAvailable = false;
        // $charterOnly = false;



        //TOURS ---------------------------------------
        if ($postType  == 'rfc_tours') {

            $lengthInDays = get_field('length', $p);

            //length filter
            if ($minLength != null) {
                if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                    continue; // skip to next if not in range
                }
            }


            $itineraryLengthDisplay = $lengthInDays . " Days";


            $productTitle = get_field('tour_name', $p);
            $productTypeDisplay = 'Land Tour';
            $productTypeCta = 'Tour';

            $pricePackages = get_field('price_packages', $p);
            $prices = [];
            $priceValues = [];

            for ($x = 0; $x <= 1; $x++) { //loop twice
                $year = $startYear + $x;

                $lowestPrice = lowest_tour_price($pricePackages, $year);
                $prices[] = (object) array(
                    'year' => $year,
                    'lowestPrice' => $lowestPrice, //lowest per price package
                );

                if ($lowestPrice != 0) {
                    $priceValues[] = $lowestPrice;
                }
            }

            //lowest price for itinerary
            if ($priceValues) {
                $itineraryLowestPrice = min($priceValues);
            }



            $itineraries[] = (object) array(
                'lengthInDays' => $lengthInDays,
                'prices' => $prices, //lowest per price package -- Break down yearly (year array in tour is similar to departure dates array for cruises)
                'lowestItineraryPrice' => $itineraryLowestPrice
            );
        };


        //CRUISES / LODGES -------------------------------------------------------
        if ($postType  == 'rfc_lodges' || $postType  == 'rfc_cruises') {
            $productTitle = get_the_title($p);
            $cruiseData = get_field('cruise_data', $p);
            $vesselCapacity = get_field('vessel_capacity', $p);
            $numberOfCabins = get_field('number_of_cabins', $p);

            if ($postType  == 'rfc_cruises') { //CRUISES 

                // $charterAvailable = get_field('charter_available', $p);
                // if ($charterAvailable) {
                //     $charterOnly = get_field('charter_only', $p);
                // }

                $cruiseType = get_field('cruise_type', $p);
                $productTypeDisplay = $cruiseType . ' Cruise';
                $productTypeCta = 'Cruise';
                //Cruise Itineraries
                foreach ($cruiseData['Itineraries'] as $itinerary) {

                    $lengthInDays = $itinerary['LengthInDays'];

                    if ($minLength != null) {
                        if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                            continue; // skip to next itinerary if not in range
                        }
                    }


                    $departures = [];
                    $priceValues = [];

                    if ($itinerary['Departures'] != null) {
                        foreach ($itinerary['Departures'] as $d) { //departure loop


                            if ($datesArray) {

                                $match = false;
                                foreach ($datesArray as $dateSelection) { //selection loop

                                    $testdate = strtotime($d['DepartureDate']); // this will be converted to YYYY-MM-DD
                                    $selectedDate = strtotime($dateSelection);

                                    if (date('Ym', $selectedDate) == date('Ym', $testdate)) { //test Ym (year + month)
                                        $match = true;
                                    }
                                }

                                if (!$match) { //continue to next iteration of departure loop (date doesnt match any selection range)
                                    continue;
                                }
                            }


                            if ($d['LowestPrice'] != 0) {
                                $priceValues[] = $d['LowestPrice'];
                            }

                            if($d['HasPromo'] == true){
                                $promoAvailable = true;
                            }


                            $departures[] = (object) array(
                                'departureDate' => $d['DepartureDate'],
                                'lowestPrice' => $d['LowestPrice'], //lowest per cabin
                                'hasPromo' => $d['HasPromo'],
                                'isHighSeason' => $d['IsHighSeason'],
                                'isLowSeason' => $d['IsLowSeason'],
                                'promoName' => $d['PromoName'],
                            );
                        }
                    } else {
                        continue; // no departure dates to begin with
                    }

                    if (!$departures) {
                        continue; //no departures in this itinerary after date filtering
                    }

                    $departureCount = 0;
                    if ($departures) {
                        $departureCount = count($departures);
                    }

                    //lowest price for itinerary
                    $itineraryLowestPrice = 0;
                    if ($priceValues) {
                        $itineraryLowestPrice = min($priceValues);
                    }


                    $itineraries[] = (object) array(
                        'lengthInDays' => $lengthInDays,
                        //'departures' => $departures,
                        'departureCount' => $departureCount,
                        'lowestItineraryPrice' => $itineraryLowestPrice
                    );
                }

                if (!$itineraries) {
                    continue;
                }
            } else { //LODGES
                $productTypeDisplay = 'Lodge Stay';
                $productTypeCta = 'Lodge';

                foreach ($cruiseData['Itineraries'] as $itinerary) {
                    $lowestItineraryPrice  = $itinerary['LowestPrice'];
                    $lengthInDays = $itinerary['LengthInDays'];

                    if ($minLength != null) {
                        if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                            continue; // skip to next
                        }
                    }

                    $itineraries[] = (object) array(
                        'lengthInDays' => $itinerary['LengthInDays'],
                        'lowestItineraryPrice' => $lowestItineraryPrice,
                    );
                }
                if (!$itineraries) {
                    continue;
                }
            }

            //Itinerary Attributes Display
            //--Count
            if (count($itineraries) > 1) {
                $itineraryCountDisplay = count($itineraries) . " Itineraries";
            } else {
                $itineraryCountDisplay = count($itineraries) . " Itinerary";
            }

            //--Length
            $itineraryValues = [];
            foreach ($itineraries as $i) {
                $itineraryValues[] = $i->lengthInDays;
            }
            $rangeFrom = min($itineraryValues);
            $rangeTo = max($itineraryValues);

            if ($rangeFrom != $rangeTo) {
                $itineraryLengthDisplay = $rangeFrom . " - " . $rangeTo . " Days";
            } else {
                $itineraryLengthDisplay = $rangeFrom . " Days";
            }

            //Capacity Attributes Display
            if ($numberOfCabins) {
                $numberOfCabinsDisplay = $numberOfCabins . " Cabins";
            }
            if ($vesselCapacity) {
                $vesselCapacityDisplay = $vesselCapacity . " Guests";
            }
        }

        $productLowestPrice = 0;

        if($charterOnly == true){
            $productLowestPrice = get_field('charter_daily_price', $p);
        } else {
            $productLowestPriceValues = [];
            foreach ($itineraries as $itinerary) {
                $productLowestPriceValues[] = $itinerary->lowestItineraryPrice;
            }
            $productLowestPrice = min($productLowestPriceValues);
        }



        

        $results[] = (object) array(
            'post' => $p,
            'postType' => $postType,
            'productTypeDisplay' => $productTypeDisplay,
            'productTypeCta' => $productTypeCta,
            'productTitle' => $productTitle,
            'productImageUrl' => $productImageUrl, //need image ID and then get custom size -- return URL here
            'snippet' => $snippet,
            'itineraries' => $itineraries,
            'destinations' => get_field('destinations', $p),
            'locations' => get_field('locations', $p),
            'experiences' => get_field('experiences', $p),
            'lowestPrice' => $productLowestPrice,
            'itineraryLengthDisplay' => $itineraryLengthDisplay,
            'itineraryCountDisplay' => $itineraryCountDisplay,
            'promoAvailable' => $promoAvailable,

            //'postLink' => $resultLink,
            //'charterAvailable' => $charterAvailable,
            'charterOnly' => $charterOnly,
            'vesselCapacity' => $vesselCapacity,
            'vesselCapacityDisplay' => $vesselCapacityDisplay,

            'numberOfCabins' => $numberOfCabins,
            'numberOfCabinsDisplay' => $numberOfCabinsDisplay

        );
    }

    //$output = array_slice($results, 0, 10);

    return $results;
}
