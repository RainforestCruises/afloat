<?php
/*Template Name: Destinations - Destination*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destinationType = 'destination';

$title = '';
$region = '';
$destination = '';
$destinations = '';
$locations = '';
$activities = '';

$sliderContent = [];

$tour_experiences = get_field('tour_experiences');
$destinationCount = 0;



//DESTINATION
//-single destintion -multiple locations
//-tours/cruises from single destination
//DESTINATION
$destination = get_field('destination_post');

//Activities
$activities = get_field('activities', $destination);

//LOCATIONS
$locationCriteria = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_locations',
    "meta_key" => "destination",
    "meta_value" => $destination->ID
);
$locations = get_posts($locationCriteria);
usort($locations, function ($a, $b) { //sort locations by importance
    return strcmp($a->importance, $b->importance);
});
$destinationCount = count($locations); //pass count to JS

//TOURS
$tourCriteria = array(
    'posts_per_page' => 6,
    'post_type' => 'rfc_tours',
    'meta_query' => array(
        array(
            'key' => 'destinations',
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

//Build Slider Content
$destinationSlide = array(
    'hero_image' => get_field('hero_image', $destination),
    'hero_title' => get_field('hero_title', $destination),
    'hero_short_text' => get_field('hero_short_text', $destination),
);
$sliderContent[] = $destinationSlide;
foreach ($locations as $l) {
    $locationSlide = array(
        'hero_image' => get_field('hero_image', $l),
        'hero_title' => get_field('hero_title', $l),
        'hero_short_text' => get_field('hero_short_text', $l),
    );
    $sliderContent[] = $locationSlide;
}

//Title (Destination)
$title = $destination->post_title;



$args = array(
    'destination' => $destination,
    'destinations' => $destinations,
    'region' => $region,

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
    <?php if (get_field('hide_cruises') == false) { ?>
        <section class="destination-page__section-secondary" id="cruises">
            <?php
            get_template_part('template-parts/content', 'destination-secondary', $args);
            ?>
        </section>
    <?php } ?>

    <!-- Accommodations -->
    <?php if (get_field('hide_accommodations') == false) { ?>
    <section class="destination-page__section-accommodations" id="accommodations">
        <?php
        get_template_part('template-parts/content', 'destination-accommodations', $args);
        ?>
    </section>
    <?php } ?>

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