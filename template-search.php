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


//Region / Destination Setup --------------
$searchType = get_field('search_type');

$region = null;
$destination = null;
$destinationId = null;

if ($searchType == 'region') {
    $region = get_field('region');
} else {
    
    $destination = get_field('destination');
    $region = get_field('region', $destination);
    $destinationId = $destination->ID;
}

$regionId = $region->ID;


//Preselections (strings for form values) ------------
//--Travel style
$travelTypes = [];
$travelTypesString = "";
$selectedTravelTypes = get_field('travel_type');
if ($selectedTravelTypes != null) {
    $travelTypes = $selectedTravelTypes;
    $travelTypesString = implode(":", $travelTypes);
}

//--Destinations
$destinations = [];
$destinationsString = "";
$selectedDestinations = ($searchType == 'destination') ? get_field('location_filter') : get_field('destination_filter');
if ($selectedDestinations != null) {
    $destinations = $selectedDestinations;
    $destinationsString = implode(":", $destinations);
}

//--Experiences
$experiences = [];
$experiencesString = "";
$selectedExperiences = get_field('experience');
if ($selectedExperiences != null) {
    $experiences = $selectedExperiences;
    $experiencesString = implode(":", $experiences);
}

//Page arguments ------------
$args = array(
    'searchType' => $searchType,
    'destinationId' => $destinationId,
    'regionId' => $regionId,
    'travelTypes' => $travelTypes, //preselection
    'experiences' => $experiences, //preselection
    'destinations' => $destinations, //preselection
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
        get_template_part('template-parts/content', 'search-sidebar2', $args); //page args --> initial preselection
        get_template_part('template-parts/content', 'search-results', $args); //page args --> initial render
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
    <input type="hidden" name="formTravelStyles" id="formTravelStyles" value="<?php echo $travelTypesString ?>"> 
    <input type="hidden" name="formDestinations" id="formDestinations" value="<?php echo $destinationsString ?>">
    <input type="hidden" name="formExperiences" id="formExperiences" value="<?php echo $experiencesString ?>">
    <input type="hidden" name="formMinLength" id="formMinLength" value="">
    <input type="hidden" name="formMaxLength" id="formMaxLength" value="">

    <input type="hidden" name="region" id="region" value="<?php echo $regionId ?>">
    <input type="hidden" name="destination" id="destination" value="<?php echo $destinationId ?>">
    <input type="hidden" name="searchType" id="searchType" value="<?php echo $searchType ?>">
    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>




<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>