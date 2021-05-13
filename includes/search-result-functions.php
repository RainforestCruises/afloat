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
        $productImage = wp_get_attachment_image_url( $featuredImage['id'], 'featured-square');

        $locationPosts = get_field('locations', $p);
        $destinationPosts = get_field('destinations', $p);
        $experiencePosts = get_field('experiences', $p);

        $postType = get_post_type($p);
        $resultLink = get_permalink($p);

        $charterAvailable = false;
        $charterOnly = false;

        if ($postType  == 'rfc_tours') {
            $productTitle = get_field('tour_name', $p);


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


            if ($postType  == 'rfc_cruises') {
                $charterAvailable = get_field('charter_available', $p);
                if ($charterAvailable) {
                    $charterOnly = get_field('charter_only', $p);
                }
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
                    //xtra
                    

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
        if($destinationPosts){
            foreach ($destinationPosts as $d) {
                $destinations[] = (object) array(
                    'postId' => $d->ID,
                    'name' => get_field('navigation_title', $d),
                );
            }
        }
      

        $locations = [];
        if($locationPosts){
            foreach ($locationPosts as $l) {
                $locations[] = (object) array(
                    'postId' => $l->ID,
                    'name' => get_field('navigation_title', $l),
                );
            }
        }
    
        $experiences = [];
        if($experiencePosts){
            foreach ($experiencePosts as $e) {
                $experiences[] = (object) array(
                    'postId' => $e->ID,
                    'name' => get_the_title($e),
                );
            }
        }
        

        // $cruise_data = $post->cruise_data;
        // $result_link = get_permalink($post->postObject);
        // $charter_only = get_field('charter_only', $post->postObject);


        //    $cruise_data = get_field('cruise_data', $post);
        //    $lowest = $cruise_data['LowestPrice'];
        //    $highest = $cruise_data['HighestPrice'];
        //    $postType = get_post_type($post);

        //    $charterOnly = get_field('charter_only', $post);


        //    if ($postType == 'rfc_tours') {
        //        $pricePackages = get_field('price_packages', $post);
        //        $lowest = lowest_tour_price($pricePackages, $startYear);
        //        $tourLength = get_field('length', $post);
        //    }

        //    if ($charterFilter) {
        //        $lowest = get_field('charter_daily_price', $post);
        //        $highest = $lowest;
        //    }

        $results[] = (object) array(
            'postType' => $postType,
            'productTitle' => $productTitle,
            'productImage' => $productImage, //need image ID and then get custom size -- return URL here
            'snippet' => $snippet,
            'itineraries' => $itineraries, //tours always have one
            'destinations' => $destinations,
            'locations' => $locations,
            'experiences' => $experiences,
            'postLink' => $resultLink,
            'charterAvailable' => $charterAvailable,
            'charterOnly' => $charterOnly

        );
    }

    return $results;
}
