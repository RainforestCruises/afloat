<?php


//Product Date Search
add_action('wp_ajax_productsearch', 'search_filter_product_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_productsearch', 'search_filter_product_search');

function search_filter_product_search()
{
    //Set up 
    //Start / End dates
    //Pass Along Post Id (WP ID of Product)

    $productId = $_POST['productId'];
    $selectedItinerary = $_POST['form-itinerary'];
    $selectedMonth = $_POST['form-month'];
    $selectedYear = $_POST['form-year'];




    $args = array(
        'selectedItinerary' => $selectedItinerary,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'productId' => $productId,
    );

    console_log($args);
    get_template_part('template-parts/content', 'product-dates-grid', $args);



    die();
}


//Main Search
add_action('wp_ajax_mainSearch', 'search_filter_main_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_mainSearch', 'search_filter_main_search');

function search_filter_main_search()
{

    //--------------WP Categories


    //Travel Type
    $travelType = array('rfc_cruises', 'rfc_tours', 'rfc_lodges'); //Any
    if (isset($_POST['travel-select']) && $_POST['travel-select'])
        $travelType = $_POST['travel-select']; //One Type Selected

    $args = null;
    $charterFilter = false;
    if ($travelType != 'charter_cruises') {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => $travelType,
        );
    } else { //charter selected
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_cruises',
        );

        $args['meta_query'][] = array(
            'key' => 'charter_available',
            'value' => true,
            'compare' => 'LIKE'
        );

        $charterFilter = true;

    }
   

    //Get destinations by destination
    if ($_POST['searchType'] == 'destination') { //DESTINATION
        if (isset($_POST['location-select']) && $_POST['location-select']) {
            //- Get specific location if location selected
            $locationId = $_POST['location-select'];

            $args['meta_query'][] = array(
                'key' => 'locations',
                'value' => '"' . $locationId . '"',
                'compare' => 'LIKE'
            );
        } else {
            //- Get all from peru
            $destinationId = $_POST['destination'];

            $args['meta_query'][] = array(
                'key' => 'destinations',
                'value' => '"' . $destinationId . '"',
                'compare' => 'LIKE'
            );
        }
    } else { //REGION 
        if (isset($_POST['destination-select']) && $_POST['destination-select']) {
            //- Get specific destination if destination selected
            $args['meta_query'][] = array(
                'key' => 'destinations',
                'value' => '"' . $_POST['destination-select'] . '"',
                'compare' => 'LIKE'
            );
        } else {
            //- Get destinations by region if nothing selected, then get all products in those destinations
            $regionId = $_POST['region'];
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


    if (isset($_POST['experience-select']) && $_POST['experience-select']) {
        //- Get specific experience if experience selected
        $args['meta_query'][] = array(
            'key' => 'experiences',
            'value' => '"' . $_POST['experience-select'] . '"',
            'compare' => 'LIKE'
        );
    }
    $posts = get_posts($args);



    //Capture non-WP Meta Input
    //-------------Meta Parameters
    //Length
    //Sorting
    //Dates
    //Budget

    $sortOrder = '';
    if (isset($_POST['result-sort']) && $_POST['result-sort'])
        $sortOrder = $_POST['result-sort'];

    $startDate = '';
    if (isset($_POST['startDate']) && $_POST['startDate']) {
        $startDate = $_POST['startDate'];
    }
    $endDate = '';
    if (isset($_POST['endDate']) && $_POST['endDate']) {
        $endDate = $_POST['endDate'];
    }
    $minLength = 0;
    if (isset($_POST['minLength']) && $_POST['minLength']) {
        $minLength = $_POST['minLength'];
    }
    $maxLength = 99;
    if (isset($_POST['maxLength']) && $_POST['maxLength']) {
        $maxLength = $_POST['maxLength'];
        if($maxLength == 15){ //make 15 days +
            $maxLength = 99;
        }
    }

    $pageNumber = 1;
    if (isset($_POST['initialPage']) && $_POST['initialPage']) {
        $pageNumber = $_POST['initialPage'];
        console_log('set') . $pageNumber;

    }

    
    $postsAndCriteria = new stdClass();
    $postsAndCriteria->products = $posts;
    $postsAndCriteria->sortOrder = $sortOrder;
    $postsAndCriteria->startDate = $startDate;
    $postsAndCriteria->endDate = $endDate;
    $postsAndCriteria->minLength = $minLength;
    $postsAndCriteria->maxLength = $maxLength;
    $postsAndCriteria->charterFilter = $charterFilter;

    $postsAndCriteria->pageNumber = $pageNumber;


    get_template_part('template-parts/content', 'main-search-results', $postsAndCriteria);



    die();
}




//HOME SEARCH
add_action('wp_ajax_homeSearch', 'search_filter_home_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_homeSearch', 'search_filter_home_search');

function search_filter_home_search()
{

    //DESTINATION
    $destinationId = 0;
    if (isset($_POST['travel-destination']) && $_POST['travel-destination']) {
        $destinationId = $_POST['travel-destination'];
    }

    //DATE
    $startDate = date("Y-m-d");
    $endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)));


    $travelMonth = 0;
    if (isset($_POST['travel-month']) && $_POST['travel-month']) {
        $travelMonth = $_POST['travel-month'];
    }
    $travelYear = 0;
    if (isset($_POST['travel-year']) && $_POST['travel-year']) {
        $travelYear = $_POST['travel-year'];
    }

    $d = mktime(null, null, null, $travelMonth, 1, $travelYear);
    $startDate = date("Y-m-d", $d);

    
    if ($travelMonth != date("m")) {   //selection not current month or unselected
        $endDate = date('Y-m-d', strtotime('+30 days', strtotime($startDate)));
    } else {
        $endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)));
    }


    $destinationPost = get_post($destinationId);
    $pageLink = get_field('default_search_link', $destinationPost);

    if ($pageLink != null) {
        wp_redirect($pageLink . "?startDate=" . $startDate . "&endDate=" . $endDate);
    } else {
        wp_redirect(home_url());
    }




    die();
}
