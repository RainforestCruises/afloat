<?php
/*Template Name: Search*/

//CHANGE HERE
// wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
wp_enqueue_script('page-search2', get_template_directory_uri() . '/js/page-search2.js', array('jquery'), false, true);

?>

<?php
get_header();
?>

<?php

// $searchType = get_field('search_type');



// $destination = null;
// $region = null;


// if ($searchType == 'region') {
//     $region = get_field('region');
// } else {
//     $region = get_field('region', $destination);
//     $destination = get_field('destination');
// }


// $destinationTitle = get_field('navigation_title', $destination);
// $regionTitle = get_field('navigation_title', $region);




// $args = array(
//     'destination' => $destination,
//     'region' => $region,
//     'searchType' => $searchType,
// );

?>

<main class="search-page">
    <section class="search-page__intro">
        <?php
        get_template_part('template-parts/content', 'search-intro');
        ?>
    </section>


    <!-- Content -->
    <section class="search-page__content">
        <?php

        get_template_part('template-parts/content', 'search-sidebar2');

        //get_template_part('template-parts/content', 'search-results');

        ?>


        <!-- Result -->
        <a class="search-result" href="#">
            <div class="search-result__image-area">
                <img src="<?php echo get_template_directory_uri() . '/css/img/test-images/delfin-i.jpg' ?>" alt="">
            </div>
            <div class="search-result__content">
                <div class="search-result__content__top">
                    <div class="search-result__content__top__title-group">
                        <div class="search-result__content__top__title-group__subtitle">
                            River Cruise
                        </div>
                        <div class="search-result__content__top__title-group__title">
                            Delfin I
                        </div>
                    </div>
                    <div class="search-result__content__top__snippet">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quis explicabo beatae.
                    </div>
                </div>
                <div class="search-result__content__bottom">
                    <div class="search-result__content__bottom__details">
                        <div class="search-result__content__bottom__details__group">
                            <span class="search-result__content__bottom__details__group__title">
                                Regions:
                            </span>
                            <span class="search-result__content__bottom__details__group__text">
                                Peru, Amazon
                            </span>
                        </div>
                        <div class="search-result__content__bottom__details__group">
                            <span class="search-result__content__bottom__details__group__title">
                                Destinations:
                            </span>
                            <span class="search-result__content__bottom__details__group__text">
                                Peru, Amazon
                            </span>
                        </div>
                    </div>
                    <div class="search-result__content__bottom__experiences">
                        <div class="search-result__content__bottom__experiences__item">
                            <div class="experience-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32">
                                    <title>distance</title>
                                    <g class="nc-icon-wrapper" stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" fill="#111111" stroke="#111111">
                                        <circle cx="23" cy="18" r="3" fill="none" stroke="#111111" stroke-miterlimit="10"></circle>
                                        <path d="M31,18c0,4.418-8,12-8,12s-8-7.582-8-12a8,8,0,0,1,16,0Z" fill="none" stroke="#111111" stroke-miterlimit="10"></path>
                                        <circle cx="7" cy="7" r="2" fill="none" stroke="#111111" stroke-miterlimit="10"></circle>
                                        <path d="M15,28a8,8,0,0,1-8-8" fill="none" stroke-miterlimit="10" data-color="color-2"></path>
                                        <path d="M13,7c0,3.314-6,9-6,9S1,10.314,1,7A6,6,0,0,1,13,7Z" fill="none" stroke="#111111" stroke-miterlimit="10"></path>
                                    </g>
                                </svg> <span class="tooltiptext">Luxury</span>
                            </div>

                        </div>
                        <div class="search-result__content__bottom__experiences__item">
                            <div class="experience-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32">
                                    <title>distance</title>
                                    <g class="nc-icon-wrapper" stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" fill="#111111" stroke="#111111">
                                        <circle cx="23" cy="18" r="3" fill="none" stroke="#111111" stroke-miterlimit="10"></circle>
                                        <path d="M31,18c0,4.418-8,12-8,12s-8-7.582-8-12a8,8,0,0,1,16,0Z" fill="none" stroke="#111111" stroke-miterlimit="10"></path>
                                        <circle cx="7" cy="7" r="2" fill="none" stroke="#111111" stroke-miterlimit="10"></circle>
                                        <path d="M15,28a8,8,0,0,1-8-8" fill="none" stroke-miterlimit="10" data-color="color-2"></path>
                                        <path d="M13,7c0,3.314-6,9-6,9S1,10.314,1,7A6,6,0,0,1,13,7Z" fill="none" stroke="#111111" stroke-miterlimit="10"></path>
                                    </g>
                                </svg> <span class="tooltiptext">Luxury</span>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="search-result__detail">
                <div class="search-result__detail__info">
                    <div class="search-result__detail__info__price-from">
                        <div class="search-result__detail__info__price-from__text">
                            Starting From
                        </div>
                        <div class="search-result__detail__info__price-from__price">
                            $4,775
                            <span>
                                USD
                            </span>
                        </div>
                    </div>
                    <div class="search-result__detail__info__attributes">

                        <!-- Itineraries -->
                        <div class="search-result__detail__info__attributes__item">
                            <div class="search-result__detail__info__attributes__item__data">
                                <div class="search-result__detail__info__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                </div>
                                <div class="search-result__detail__info__attributes__item__data__text">
                                    4 - 5 Days <div class="sub-attribute">
                                        2 Itineraries
                                    </div>
                                </div>

                            </div>
                        </div>

                      <!-- Capacity -->
                      <div class="search-result__detail__info__attributes__item">
                            <div class="search-result__detail__info__attributes__item__data">
                                <div class="search-result__detail__info__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-boat-front"></use>
                                    </svg>
                                </div>
                                <div class="search-result__detail__info__attributes__item__data__text">
                                    42 Guests <div class="sub-attribute">
                                        20 Cabins
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="search-result__detail__cta">
                    <button class="btn-cta-round">
                        View Cruise
                    </button>
                </div>

            </div>
        </a>
    </section>


    <!-- Bottom -->
    <!-- <div class="search-page__bottom">
        bottom
    </div> -->
</main>


<form class="search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <!-- Direct to function within functions.php -->
    <input type="hidden" name="action" value="mainSearch">

    <input type="hidden" name="formDates" id="formDates" value="">
    <input type="hidden" name="formTravelStyles" id="formTravelStyles" value="">
    <input type="hidden" name="formDestinations" id="formDestinations" value="">
    <input type="hidden" name="formExperiences" id="formExperiences" value="">



    <input type="hidden" name="region" id="region" value="<?php echo $region->ID ?>">
    <input type="hidden" name="destination" id="destination" value="<?php echo $destination->ID ?>">
    <input type="hidden" name="searchType" id="searchType" value="<?php echo $searchType ?>">
    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>


<?php

$travelType = array('rfc_cruises', 'rfc_tours', 'rfc_lodges'); //Any

$args = array(
    'posts_per_page' => -1,
    'post_type' => $travelType,
);

$posts = get_posts($args);
//get upper bound of search results -- destination boundary, not preselections

$resultsArray = buildSearchResultsArray($posts);




?>
<script>
    var resultsArray = JSON.parse('<?php echo json_encode($resultsArray) ?>');
</script>