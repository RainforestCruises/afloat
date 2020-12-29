<?php
/*Template Name: Destinations - Region*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destinationType = 'region';
$destination = get_field('region_post'); //actually a region
$activities = get_field('activities', $destination);
usort($activities, fn($a, $b) => strcmp($a->navigation_title, $b->navigation_title));


$tour_experiences = get_field('tour_experiences');
$sliderContent = get_field('hero_slider');

//Title (Destination)
$title = $destination->post_title;


//REGION
$region = get_field('region_post');

//DESTINATIONS
$destinationCriteria = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_destinations',
    "meta_key" => "region",
    "meta_value" => $destination->ID
);
$locations = get_posts($destinationCriteria); //actually destinations
usort($locations, fn($a, $b) => strcmp($a->navigation_title, $b->navigation_title));

$destinationCount = count($locations); //pass count to JS


//get destination IDs
$destinationIds = [];
foreach ($locations as $d) {
    $destinationIds[] = $d->ID;
}

//build meta query criteria
$queryargs = array();
$queryargs['relation'] = 'OR';
foreach ($destinationIds as $d) {
    $queryargs[] = array(
        'key'     => 'destination',
        'value'   => serialize(strval($d)),
        'compare' => 'LIKE'
    );
}

//TOURS
$tourCriteria = array(
    'posts_per_page' => 6,
    'post_type' => 'rfc_tours',
    'meta_query' => $queryargs
);
$tours = get_posts($tourCriteria);

//CRUISES
$cruiseCriteria = array(
    'posts_per_page' => 6,
    'post_type' => 'rfc_cruises',
    'meta_query' => $queryargs
);
$cruises = get_posts($cruiseCriteria);


//Title (Region)
$title = $destination->post_title;




$args = array(
    'destination' => $destination,
    'locations' => $locations,
    'activities' => $activities,

    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
    'cruises' => $cruises,
    'sliderContent' => $sliderContent,
    'title' => $title,
    'destinationType' => $destinationType,

);

?>

<!-- Hero -->
<div class="destination-page">
    <section class="destination-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'destination-hero', $args);
        ?>
    </section>

    <div class="destination-page__section-main" id="tours">
        <?php
        get_template_part('template-parts/content', 'destination-main', $args);
        ?>
    </div>


    <!-- Cruises-->
    <section class="destination-page__section-secondary" id="cruises">
        <?php
        get_template_part('template-parts/content', 'destination-secondary', $args);
        ?>
    </section>

    <!-- Accommodations -->
    <section class="destination-page__section-accommodations" id="accommodations">
        <?php
        get_template_part('template-parts/content', 'destination-accommodations', $args);
        ?>
    </section>

    <!-- Travel Guides -->
    <section class="destination-page__section-travel-guides" id="travel-guides">
        <?php
        get_template_part('template-parts/content', 'destination-guides', $args);
        ?>
    </section>

    <!-- Testimonials -->
    <section class="destination-page__section-testimonials" id="testimonials">
        <?php
        get_template_part('template-parts/content', 'destination-testimonials', $args);
        ?>
    </section>

    <!-- FAQ -->
    <section class="destination-page__section-faq" id="faq">
        <?php
        get_template_part('template-parts/content', 'destination-faq', $args);
        ?>
    </section>

</div>

<?php get_footer(); ?>


<script>
    var destinationCount = <?php echo json_encode($destinationCount); ?>;
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>