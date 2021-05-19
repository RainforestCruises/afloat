
<form class="search-results__grid__pagination" form="search-form">
    <?php
    if ($pageCount != 1 && $pageNumber != 'all') : ?>
        <div class="search-results__grid__pagination__pages-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--back-button btn-circle btn-circle--left btn-circle--small  <?php echo ($pageNumber == 1) ? 'btn-circle--disabled' : ''; ?>" style="margin-right: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg>
            </button>
            <?php
            for ($k = 1; $k <= $pageCount; $k++) :
            ?>
                <button class="btn-circle btn-circle--small  <?php echo ($pageNumber == $k) ? 'btn-circle--current' : ''; ?> search-results__grid__pagination__pages-group__button " value="<?php echo $k ?>">
                    <?php echo $k ?>
                </button>
            <?php endfor;
            ?>
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--next-button btn-circle btn-circle--right btn-circle--small <?php echo ($pageNumber == $pageCount) ? 'btn-circle--disabled' : ''; ?>" style="margin-left: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </button>
        </div>
        <div class="search-results__grid__pagination__show-all-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--all-button btn-outline btn-outline--small btn-outline--dark">
                Show All
            </button>
        </div>

    <?php endif; ?>
    <!-- <input type="hidden" name="pageNumber" id="pageNumber" form="search-form" value="1"> -->
</form>
<div id="pageNumberDisplay" style="display: none;" value="<?php echo $pageNumber ?>"> </div>
<div id="totalResultsDisplay" style="display: none;" value="<?php echo $resultsTotal ?>"> </div>








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


