<?php
//Upper bounded list of products for search results
function buildSearchResultsArray($posts)
{

    $results = [];
    $startYear = date('Y');
    foreach ($posts as $p) {

        $productTitle = "";
        $itineraries = [];
        $snippet = get_field('top_snippet', $p);

        $featuredImage = get_field('featured_image', $p); //need specific image size  
        $productImage = wp_get_attachment_image_url($featuredImage['id'], 'featured-square');

        $locationPosts = get_field('locations', $p);
        $destinationPosts = get_field('destinations', $p);
        $experiencePosts = get_field('experiences', $p);

        $postType = get_post_type($p);
        $resultLink = get_permalink($p);

        $charterAvailable = false;
        $charterOnly = false;
        $vesselCapacity = 0;
        $numberOfCabins = 0;

        $productTypeDisplay = "";


        if ($postType  == 'rfc_tours') {
            $productTitle = get_field('tour_name', $p);
            $productTypeDisplay = 'Land Tour';

            $pricePackages = get_field('price_packages', $p);


            $prices = [];
            for ($x = 0; $x <= 1; $x++) {
                $year = $startYear + $x;

                $lowestPrice = lowest_tour_price($pricePackages, $year);
                $prices[] = (object) array(
                    'year' => $year,
                    'lowestPrice' => $lowestPrice, //lowest per price package -- 
                );
            }

            $itineraries[] = (object) array(
                'lengthInDays' => get_field('length', $p),
                'prices' => $prices //lowest per price package -- Break down yearly (year array in tour is similar to departure dates array for cruises)
            );
        };

        if ($postType  == 'rfc_lodges' || $postType  == 'rfc_cruises') {
            $productTitle = get_the_title($p);
            $cruiseData = get_field('cruise_data', $p);
            $vesselCapacity = get_field('vessel_capacity', $p);
            $numberOfCabins = get_field('number_of_cabins', $p);

            if ($postType  == 'rfc_cruises') {
                $charterAvailable = get_field('charter_available', $p);
                if ($charterAvailable) {
                    $charterOnly = get_field('charter_only', $p);
                }

                $productTypeDisplay = 'River Cruise';
            } else {
                $productTypeDisplay = 'Lodge Stay';
            }

            foreach ($cruiseData['Itineraries'] as $itinerary) {



                if ($postType  == 'rfc_cruises') {
                    //CRUISES
                    $departures = [];
                    if ($itinerary['Departures'] != null) {
                        foreach ($itinerary['Departures'] as $d) {

                            $departures[] = (object) array(
                                'departureDate' => $d['DepartureDate'],
                                'lowestPrice' => $d['LowestPrice'], //lowest per cabin
                                'hasPromo' => $d['HasPromo'],
                                'isHighSeason' => $d['IsHighSeason'],
                                'isLowSeason' => $d['IsLowSeason'],
                                'promoName' => $d['PromoName'],

                            );
                        }
                    }

                    $itineraries[] = (object) array(
                        'lengthInDays' => $itinerary['LengthInDays'],
                        'departures' => $departures,
                    );
                } else {
                    //LODGES -- (will always get current year lowest price --> could be improved)
                    $lowestPrice  = $itinerary['LowestPrice'];


                    $itineraries[] = (object) array(
                        'lengthInDays' => $itinerary['LengthInDays'],
                        'lowestPrice' => $lowestPrice,
                    );
                }
            }
        }

        $destinations = [];
        if ($destinationPosts) {
            foreach ($destinationPosts as $d) {
                $destinations[] = (object) array(
                    'postId' => $d->ID,
                    'name' => get_field('navigation_title', $d),
                );
            }
        }


        $locations = [];
        if ($locationPosts) {
            foreach ($locationPosts as $l) {
                $locations[] = (object) array(
                    'postId' => $l->ID,
                    'name' => get_field('navigation_title', $l),
                );
            }
        }

        $experiences = [];
        if ($experiencePosts) {
            foreach ($experiencePosts as $e) {
                $experiences[] = (object) array(
                    'postId' => $e->ID,
                    'name' => get_the_title($e),
                    'icon' => get_field('icon', $e),
                );
            }
        }


        $results[] = (object) array(
            'postType' => $postType,
            'productTypeDisplay' => $productTypeDisplay,
            'productTitle' => $productTitle,
            'productImage' => $productImage, //need image ID and then get custom size -- return URL here
            'snippet' => $snippet,
            'itineraries' => $itineraries, //tours always have one
            'destinations' => $destinations,
            'locations' => $locations,
            'experiences' => $experiences,
            'postLink' => $resultLink,
            'charterAvailable' => $charterAvailable,
            'charterOnly' => $charterOnly,
            'vesselCapacity' => $vesselCapacity,
            'numberOfCabins' => $numberOfCabins

        );
    }

    return $results;
}

function formatFilterSearch($posts, $minLength, $maxLength, $datesArray)
{

    $results = [];
    $startYear = date('Y'); //change to be minimim start year if dates selected --> this is for determining lowest price
    if (!$datesArray) {
        //find start year
    }

    //loop through posts (travel type, experience, destinations --> already filtered)
    foreach ($posts as $p) {

        $postType = get_post_type($p);
        $productTitle = "";
        $productTypeDisplay = "";
        $productTypeCta = "";
        $snippet = get_field('top_snippet', $p);
        $featuredImage = get_field('featured_image', $p); //need specific image size  
        $productImageUrl = wp_get_attachment_image_url($featuredImage['id'], 'square-medium');

        $vesselCapacity = 0;
        $numberOfCabins = 0;

        $itineraries = [];

        $itineraryCountDisplay = "";
        $itineraryLengthDisplay = "";
        $vesselCapacityDisplay = "";
        $numberOfCabinsDisplay = "";

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
            for ($x = 0; $x <= 1; $x++) {
                $year = $startYear + $x;

                $lowestPrice = lowest_tour_price($pricePackages, $year);
                $prices[] = (object) array(
                    'year' => $year,
                    'lowestPrice' => $lowestPrice, //lowest per price package -- 
                );
            }

            $itineraries[] = (object) array(
                'lengthInDays' => $lengthInDays,
                'prices' => $prices //lowest per price package -- Break down yearly (year array in tour is similar to departure dates array for cruises)
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

                $productTypeDisplay = 'River Cruise';
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

                    $itineraries[] = (object) array(
                        'lengthInDays' => $lengthInDays,
                        'departures' => $departures,
                    );
                }

                if (!$itineraries) {
                    continue;
                }
            } else {
                $productTypeDisplay = 'Lodge Stay';
                $productTypeCta = 'Lodge';

                foreach ($cruiseData['Itineraries'] as $itinerary) {
                    $lowestPrice  = $itinerary['LowestPrice'];
                    $lengthInDays = $itinerary['LengthInDays'];

                    if ($minLength != null) {
                        if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                            continue; // skip to next
                        }
                    }

                    $itineraries[] = (object) array(
                        'lengthInDays' => $itinerary['LengthInDays'],
                        'lowestPrice' => $lowestPrice,
                    );
                }
                if (!$itineraries) {
                    continue;
                }
            }

            //Itinerary Attributes Display
            //count
            if (count($itineraries) > 1) {
                $itineraryCountDisplay = count($itineraries) . " Itineraries";
            } else {
                $itineraryCountDisplay = count($itineraries) . " Itinerary";
            }

            //length
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
            'lowestPrice' => 0,
            'itineraryLengthDisplay' => $itineraryLengthDisplay,
            'itineraryCountDisplay' => $itineraryCountDisplay,

            //'postLink' => $resultLink,
            //'charterAvailable' => $charterAvailable,
            //'charterOnly' => $charterOnly,
            'vesselCapacity' => $vesselCapacity,
            'vesselCapacityDisplay' => $vesselCapacityDisplay,

            'numberOfCabins' => $numberOfCabins,
            'numberOfCabinsDisplay' => $numberOfCabinsDisplay

        );
    }

    return $results;
}
