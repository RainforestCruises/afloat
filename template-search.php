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

$searchType = get_field('search_type');
$destination = null;
$region = null;


if ($searchType == 'region') {
    $region = get_field('region');
} else {
    
    $destination = get_field('destination');
    $region = get_field('region', $destination);
}


//GET PRESELECTIONS


$args = array(
    'destination' => $destination,
    'region' => $region,
    'searchType' => $searchType,
);

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

        get_template_part('template-parts/content', 'search-sidebar2', $args);

        get_template_part('template-parts/content', 'search-results', $args);

        ?>


     
    </section>


    <!-- Bottom -->
    <!-- <div class="search-page__bottom">
        bottom
    </div> -->
</main>


<form class="search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <!-- Direct to function within functions.php -->
    <input type="hidden" name="action" value="primarySearch">

    <input type="hidden" name="formDates" id="formDates" value="">
    <input type="hidden" name="formTravelStyles" id="formTravelStyles" value="">
    <input type="hidden" name="formDestinations" id="formDestinations" value="">
    <input type="hidden" name="formExperiences" id="formExperiences" value="">
    <input type="hidden" name="formMinLength" id="formMinLength" value="">
    <input type="hidden" name="formMaxLength" id="formMaxLength" value="">



    <input type="hidden" name="region" id="region" value="<?php echo $region->ID ?>">
    <input type="hidden" name="destination" id="destination" value="<?php echo ($searchType == 'region') ? '' : $destination->ID ?>">
    <input type="hidden" name="searchType" id="searchType" value="<?php echo $searchType ?>">
    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>




<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>