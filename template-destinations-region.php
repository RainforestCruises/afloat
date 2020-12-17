<?php
/*Template Name: Destinations - Region*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destinationType = 'region';
$title = '';
$region= '';
$destinations= '';
$sliderContent = [];

$tour_experiences = get_field('tour_experiences');
$destinationCount = 0;


//REGION
$region = get_field('region_post');

//DESTINATIONS
$destinationCriteria = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_destinations',
    "meta_key" => "region",
    "meta_value" => $region->ID
);
$destinations = get_posts($destinationCriteria);
usort($destinations, function ($a, $b) { //sort locations by importance
    return strcmp($a->importance, $b->importance);
});
$destinationCount = count($destinations); //pass count to JS


//get destination IDs
$destinationIds = [];
foreach ($destinations as $d) {
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

//Build Slider Content
$regionSlide = array(
    'hero_image' => get_field('hero_image', $region),
    'hero_title' => get_field('hero_title', $region),
    'hero_short_text' => get_field('hero_short_text', $region),
);
$sliderContent[] = $regionSlide;
foreach ($destinations as $d) {
    $destinationSlide = array(
        'hero_image' => get_field('hero_image', $d),
        'hero_title' => get_field('hero_title', $d),
        'hero_short_text' => get_field('hero_short_text', $d),
    );
    $sliderContent[] = $destinationSlide;
}

//Title (Region)
$title = $region->post_title;



$args = array(
    'destination' => $destination,
    'destinations' => $destinations,
    'region' => $region,
    'title' => $title,

    'locations' => $locations,
    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
    'cruises' => $cruises,
    'sliderContent' => $sliderContent,
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