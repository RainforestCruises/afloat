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

        get_template_part('template-parts/content', 'search-results');

        ?>


     
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