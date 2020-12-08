<?php
/*Template Name: Destinations*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<?php
$destination = get_field('destination_post');
$locations = get_field('locations', $destination->ID);
$tour_experiences = get_field('tour_experiences');
$destinationCount = count($locations);

//TOURS
$tourCriteria = array(
    'posts_per_page' => 6,
    'post_type' => 'rfc_tours',
    'meta_query' => array(
        array(
            'key' => 'destination',
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$tours = get_posts($tourCriteria);

//CRUISES
$cruiseCriteria = array(
    'posts_per_page' => 6,
    'post_type' => 'rfc_cruises',
    'meta_query' => array(
        array(
            'key' => 'destination', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$cruises = get_posts($cruiseCriteria);

//LOCATIONS
//sort locations by importance
usort($locations, function ($a, $b) {
    return strcmp($a->importance, $b->importance);
});


$args = array(
    'destination' => $destination,
    'locations' => $locations,
    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
    'cruises' => $cruises,

);

?>

<!-- Hero -->
<div class="destination-page">
    <section class="destination-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'destination-hero', $args);
        ?>
    </section>

    <div class="destination-page__section-tours" id="tours">
        <?php
        get_template_part('template-parts/content', 'destination-tours', $args);
        ?>
    </div>


    <!-- Cruises-->
    <section class="destination-page__section-cruises" id="cruises">
        <?php
        get_template_part('template-parts/content', 'destination-cruises', $args);
        ?>
    </section>

    <!-- Accommodations -->
    <section class="destination-page__section-accommodations" id="accommodations">
    <?php
        get_template_part('template-parts/content', 'destination-accommodations', $args);
        ?>
    </section>

    <section class="destination-page__section-travel-guides" id="travel-guides"></section>
    <section class="destination-page__section-reviews" id="reviews"></section>
    <section class="destination-page__section-faq" id="faq"></section>

</div>

<?php get_footer(); ?>


<script>
    var destinationCount = <?php echo json_encode($destinationCount); ?>;
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>