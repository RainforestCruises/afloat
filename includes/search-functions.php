<?php
//Upper bounded list of products for search results
function getSearchPosts($travelStyles, $destinations, $experiences, $searchType, $destinationId, $regionId, $minLength, $maxLength, $datesArray, $searchInput, $sorting, $pageNumber, $viewType, $features)
{

    $charterFilter = false;
    if ($travelStyles == null) {
        $travelStyles = array('rfc_cruises', 'rfc_tours', 'rfc_lodges');
    } else {

        if ($travelStyles[0] == 'charter_cruises') {
            $travelStyles = array('rfc_cruises');
            $charterFilter = true;
        }
    }

    $args = array(
        'posts_per_page' => -1,
        'post_type' => $travelStyles,
    );


    if ($charterFilter == true) {
        $args['meta_query'][] = array(
            'key' => 'charter_available',
            'value' => true,
            'compare' => 'LIKE'
        );
    }


    //Get destinations by destination
    if ($searchType == 'destination') { //DESTINATION
        if ($destinations != null) { //selection - (Get Lima, Cusco, Amazon)

            $args['meta_query'][] = array(
                'key' => 'destinations',
                'value' => '"' . $destinationId . '"',
                'compare' => 'LIKE'
            );

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
    } else { //REGION / TOP
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

            if ($searchType == 'region') {
                $destinationCriteria = array(
                    'posts_per_page' => -1,
                    'post_type' => 'rfc_destinations',
                    "meta_key" => "region",
                    "meta_value" => $regionId
                );
                $destinations = get_posts($destinationCriteria);
            } else {
                $destinationCriteria = array(
                    'posts_per_page' => -1,
                    'post_type' => 'rfc_destinations',
                );
                $destinations = get_posts($destinationCriteria);
            }



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
    $formattedPosts = formatFilterSearch($posts, $minLength, $maxLength, $datesArray, $charterFilter, $sorting, $searchInput, $viewType, $features); //Stage II metadata





    $resultsPerPage = 8;
    if ($viewType == 'grid') {
        $resultsPerPage = 30;
    }

    $resultsTotal = count($formattedPosts);

    $pageCount = floor($resultsTotal / $resultsPerPage);
    if ($resultsTotal % $resultsPerPage != 0) {
        $pageCount++;
    };




    if (is_numeric($pageNumber) && $pageNumber != 'all') {
        $startIndex = (($pageNumber - 1) * $resultsPerPage);
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    } else if ($pageNumber == 'all') {
        $formattedPosts = array_slice($formattedPosts, 0, 50);
    } else {
        $startIndex = 0;
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    }

    //return object with results, result count, and page count seperately
    $searchResults = [
        'results' => $formattedPosts,
        'resultsCount' => $resultsTotal,
        'pageCount' => $pageCount,
        'pageNumber' => $pageNumber,
        'viewType' => $viewType,
        'charterFilter' => $charterFilter,
    ];



    return $searchResults;
}


//Stage II - metadata
function formatFilterSearch($posts, $minLength, $maxLength, $datesArray, $charterFilter, $sorting, $searchInput, $viewType, $features)
{

    $results = [];


    //loop through posts (travel type, experience, destinations --> already filtered)
    foreach ($posts as $p) {

        $postType = get_post_type($p);

        $productTitle = ($postType  == 'rfc_tours') ? get_field('tour_name', $p) : get_the_title($p);

        if ($searchInput != null) {
            if (!preg_match("/{$searchInput}/i", $productTitle)) {
                continue;
            }
        }


        $productTypeDisplay = "";
        $productTypeCta = "";
        $searchRank = intval(get_field('search_rank', $p) ?? 1);
        $snippet = get_field('top_snippet', $p);
        $featuredImage = get_field('featured_image', $p); //need specific image size  - 600x500
        $productImageId = '';

        if ($featuredImage) {
            $productImageId = $featuredImage['id'];
        }


        $vesselCapacity = 0;
        $numberOfCabins = 0;

        $itineraryCountDisplay = "";
        $itineraryLengthDisplay = "";
        $itineraryLengthDisplayCharter = "";
        $itineraryLengthCharter = 0;

        $itineraryCharterValues = []; // this would be the way to improve 

        $vesselCapacityDisplay = "";
        $numberOfCabinsDisplay = "";

        $charterAvailable = false;
        $charterOnly = false;
        $charterDisplayFullPrice = false;
        $productLowestPrice = 0;
        $productLowestCharterPrice = 0;

        $postUrl = get_permalink($p);


        //TOURS ---------------------------------------
        if ($postType  == 'rfc_tours') {

            $lengthInDays = get_field('length', $p);

            //Length filter
            if ($minLength != null) {
                if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                    continue; // skip to next if not in range
                }
            }

            $productTypeCta = 'Tour';
            $productTypeDisplay = 'Private Tour';


            //Price / Length -- (no itinerary count on tours)
            $pricePackages = get_field('price_packages', $p);
            $productLowestPrice = lowest_tour_price($pricePackages, date('Y')); //current year only for consistency

            $itineraryLengthDisplay = $lengthInDays . " Days";
        };


        //CRUISES / LODGES -------------------------------------------------------
        if ($postType  == 'rfc_lodges' || $postType  == 'rfc_cruises') {


            $cruiseData = get_field('cruise_data', $p);


            if ($postType  == 'rfc_cruises') { //CRUISES 
                $productTypeCta = 'Cruise';


                //Charter Filters
                $charterAvailable = get_field('charter_available', $p);
                if ($charterAvailable) {
                    $charterOnly = get_field('charter_only', $p);
                }
                if ($charterFilter == true && $charterAvailable != true) {
                    continue;
                }

                //Product Type Display
                if ($charterOnly == true) {
                    $productTypeDisplay = 'Private Charter';
                } else {
                    $cruiseType = get_field('cruise_type', $p); //River Cruise / Coastal Cruise
                    $productTypeDisplay = $cruiseType . ' Cruise';
                }

                //Price / Length
                $itineraryCount = 0;
                $itineraryLengthValues = [];

                $itineraryPriceValues = [];
                $itineraryPriceValuesCharter = [];


                // Skip if features requirements don't match
                if (!empty($features)) {
                    $featuresMatch = false;

                    foreach ($features as $featureType) {
                        $featureType = strtolower(trim($featureType));

                        if ($featureType === 'single' && !empty($cruiseData['SingleOccupancy'])) {
                            $featuresMatch = true;
                            break;
                        }
                        if ($featureType === 'triple' && !empty($cruiseData['TripleOccupancy'])) {
                            $featuresMatch = true;
                            break;
                        }
                        if ($featureType === 'quad' && !empty($cruiseData['QuadOccupancy'])) {
                            $featuresMatch = true;
                            break;
                        }

                        $shipFeatures = get_field('features', $p);
                        $wifi_available = $shipFeatures['wifi_available'];
                        $connecting_cabins = $shipFeatures['connecting_cabins'];
                        $cabins_with_balconies = $shipFeatures['cabins_with_balconies'];

                        if ($featureType === 'wifi' && $wifi_available) {
                            $featuresMatch = true;
                            break;
                        }

                        if ($featureType === 'connecting' && $connecting_cabins) {
                            $featuresMatch = true;
                            break;
                        }

                        if ($featureType === 'balconies' && $cabins_with_balconies) {
                            $featuresMatch = true;
                            break;
                        }
                    }

                    // Skip this post if no types matched
                    if (!$featuresMatch) {
                        continue;
                    }
                }

                if (array_key_exists("Itineraries", $cruiseData)) {
                    foreach ($cruiseData['Itineraries'] as $itinerary) {

                        $lengthInDays = $itinerary['LengthInDays'];

                        if ($minLength != null) {
                            if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                                continue; // skip to next itinerary if not in range
                            }
                        }

                        if ($itinerary['CharterAmount'] > 0) {
                            $itineraryPriceValuesCharter[] = $itinerary['CharterAmount'];
                        }


                        //new
                        $itineraryCharterValues[] = (object) array(
                            'length' => $lengthInDays,
                            'price' => $itinerary['CharterAmount'],
                        );


                        if ($charterFilter && $charterOnly == true) {

                            $itineraryCount = 1; //Charter Only + Charter Filter -- bypass availability
                        } else { //FIT

                            if ($charterOnly == false) {
                                if ($itinerary['Departures'] != null) {

                                    if ($datesArray) {

                                        //check date selection for availability
                                        $match = false;
                                        foreach ($datesArray as $dateSelection) {
                                            $ds = explode("-", $dateSelection);
                                            $dYear = $ds[0];
                                            $dMonth = $ds[1];

                                            foreach ($itinerary['DepartureYears'] as $dy) {

                                                if ($dy['Year'] == $dYear) {

                                                    $departureMonths = $dy['DepartureMonths'];
                                                    foreach ($departureMonths as $dm) {

                                                        if ($dm['Month'] == $dMonth && $dm['HasDepartures'] == true) {
                                                            $match = true;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        if (!$match) { //continue to next iteration of departure loop (date doesnt match any selection range)
                                            continue;
                                        }
                                    }

                                    if (!$itinerary['IsCharterOnly']) {
                                        $itineraryLengthValues[] = $itinerary['LengthInDays'];
                                        $itineraryCount += 1;
                                        $itineraryPriceValues[] = $itinerary['LowestPrice'];
                                    }
                                } else {

                                    continue; // no departure dates to begin with
                                }
                            } else {
                                $itineraryCount = 1; //TODO: check intinerary['IsOngoing] make sure is included
                            }
                        }
                    }
                }

                $filteredItineraryCharterValues = [];
                foreach ($itineraryCharterValues as $icv) {
                    if ($icv->length >= $minLength && $icv->length <= $maxLength) {
                        $filteredItineraryCharterValues[] = $icv;
                    }
                }

                // FIX -- need to fing the lowest price of the filteredItineraryCharterValues;
                // look at Fenides for example
                $shortestItinerary = array_reduce($filteredItineraryCharterValues, function ($a, $b) {
                    return $a->length < $b->length ? $a : $b;
                }, array_shift($filteredItineraryCharterValues));

                //Price / Length - Charter
                if (count($itineraryPriceValuesCharter) > 0) {
                    $productLowestCharterPrice = $shortestItinerary->price;
                }

                $itineraryLengthCharter = get_field('charter_min_days', $p);
                $charterDisplayFullPrice = get_field('charter_display_full_price', $p);
                $itineraryLengthDisplayCharter =  $itineraryLengthCharter . " Days +";
                if ($charterDisplayFullPrice && $charterOnly == false) { // wont be accurate if charter only and display full price
                    $itineraryLengthDisplayCharter = !empty($itineraryLengthValues) ? min($itineraryLengthValues) . " Days +" : "N/A";
                    $itineraryLengthCharter = !empty($itineraryLengthValues) ? min($itineraryLengthValues) : 0;
                };
            } else { //LODGES
                $productTypeDisplay = 'Lodge Stay';
                $productTypeCta = 'Lodge';

                $itineraryCount = 0;
                $itineraryLengthValues = [];
                $itineraryPriceValues = [];
                if (array_key_exists("Itineraries", $cruiseData)) {
                    foreach ($cruiseData['Itineraries'] as $itinerary) {
                        $lengthInDays = $itinerary['LengthInDays'];

                        if ($minLength != null) {
                            if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                                continue; // skip to next
                            }
                        }

                        $itineraryLengthValues[] = $itinerary['LengthInDays'];
                        $itineraryCount += 1;
                        $itineraryPriceValues[] = $itinerary['LowestPrice'];
                    }
                }
            }



            if ($itineraryCount == 0) {
                continue;
            }

            //Itinerary Count Display (Cruise /Lodge)
            $itineraryCountDisplay = $itineraryCount . (($itineraryCount > 1) ? " Itineraries" : " Itinerary");


            //Lowest Price
            if (count($itineraryPriceValues) > 0) {
                // Filter out zero values
                $nonZeroPrices = array_filter($itineraryPriceValues, function ($price) {
                    return $price > 0;
                });
                console_log('prices');

                console_log($itineraryPriceValues);

                if (count($nonZeroPrices) > 0) {
                    $productLowestPrice = min($nonZeroPrices);
                }
            }
            if ($charterOnly == true) {
                $productLowestPrice = $productLowestCharterPrice;
            }

            //Itinerary Length Display (Cruise /Lodge)
            if (count($itineraryLengthValues) > 0) {
                $rangeFrom = min($itineraryLengthValues);
                $rangeTo = max($itineraryLengthValues);

                if ($rangeFrom != $rangeTo) {
                    $itineraryLengthDisplay = $rangeFrom . " - " . $rangeTo . " Days";
                } else {
                    $itineraryLengthDisplay = $rangeFrom . " Days";
                }
            }



            //Capacity Attributes Display -- (Cruise /Lodge)
            $vesselCapacity = get_field('vessel_capacity', $p);
            $numberOfCabins = get_field('number_of_cabins', $p);

            if ($numberOfCabins) {
                $numberOfCabinsDisplay = $numberOfCabins . " Cabins";
            }
            if ($vesselCapacity) {
                $vesselCapacityDisplay = $vesselCapacity . " Guests";
            }
        }


        //check if has promos
        $dealAvailable = false;
        $dealPosts = [];
        $dealPosts = listDealsForProduct($p);
        if (count($dealPosts) > 0) {
            $dealAvailable = true;
        }

        $charterDealAvailable = false;
        $charterDealPosts = [];
        $charterDealPosts = listDealsForProduct($p, true);
        if (count($charterDealPosts) > 0) {
            $charterDealAvailable = true;
        }

        $results[] = (object) array(
            'post' => $p,
            'postUrl' => $postUrl,
            'postType' => $postType,
            'productTypeDisplay' => $productTypeDisplay,
            'productTypeCta' => $productTypeCta,
            'productTitle' => $productTitle,
            'productImageId' => $productImageId, //need image ID and then get custom size -- return URL here
            'snippet' => $snippet,
            'destinations' => get_field('destinations', $p),
            'locations' => get_field('locations', $p),
            'experiences' => get_field('experiences', $p),
            'lowestPrice' => $productLowestPrice,
            'lowestCharterPrice' => $productLowestCharterPrice,
            'itineraryLengthDisplay' => $itineraryLengthDisplay,
            'itineraryLengthDisplayCharter' => $itineraryLengthDisplayCharter,
            'itineraryLengthCharter' => $itineraryLengthCharter,
            'charterDisplayFullPrice' => $charterDisplayFullPrice,

            'itineraryCountDisplay' => $itineraryCountDisplay,
            'dealAvailable' => $dealAvailable,
            'dealPosts' => $dealPosts,
            'charterDealAvailable' => $charterDealAvailable,
            'charterDealPosts' => $charterDealPosts,
            'charterOnly' => $charterOnly,
            'charterAvailable' => $charterAvailable,
            'vesselCapacity' => $vesselCapacity,
            'vesselCapacityDisplay' => $vesselCapacityDisplay,
            'numberOfCabins' => $numberOfCabins,
            'numberOfCabinsDisplay' => $numberOfCabinsDisplay,
            'searchRank' => $searchRank

        );
    }

    if ($sorting == 'popularity') {
        usort($results, "sortRank"); //sort by search rank score
    }

    if ($sorting == 'high') {
        if ($charterFilter == true) {
            usort($results, "sortPriceHighCharter");
        } else {
            usort($results, "sortPriceHigh");
        }
    }

    if ($sorting == 'low') {
        if ($charterFilter == true) {
            usort($results, "sortPriceLowCharter");
        } else {
            usort($results, "sortPriceLow");
        }
    }


    return $results;
}



//SORTING -----------------------
//Rank
function sortRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->searchRank - $a->searchRank;
    }
}

//Price
//FIT
function sortPriceHigh($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestPrice - $a->lowestPrice;
    }
}

function sortPriceLow($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestPrice - $b->lowestPrice;
    }
}

//Charter
function sortPriceHighCharter($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestCharterPrice - $a->lowestCharterPrice;
    }
}

function sortPriceLowCharter($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestCharterPrice - $b->lowestCharterPrice;
    }
}
