<?php
/*Template Name: Destinations - Destination*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destinationType = 'destination';

$destination = get_field('destination_post');
$activities = get_field('activities_list');

$locations = get_field('locations_list');

$tour_experiences = get_field('tour_experiences');
$sliderContent = get_field('hero_slider');

//Title (Destination)
$title = $destination->post_title;

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

    <div class="destination-page__section-main" id="packages">
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
    <section class="destination-page__section-accommodations" id="accommodation">
        <?php
        get_template_part('template-parts/content', 'destination-accommodations', $args);
        ?>
    </section>
    <?php } ?>

    <!-- Travel Guides -->
    <section class="destination-page__section-travel-guides" id="travel-guide">
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
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>