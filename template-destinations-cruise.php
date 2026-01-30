<?php
/*Template Name: Destinations - Cruise*/
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-destination',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);
get_header();

$destinationType = 'cruise';
$destination = get_field('destination_post');
$show_charters = get_field('show_charters');
$show_tours = get_field('show_tours');
$activities = get_field('activities_list');
$locations = get_field('locations_list');
$tour_experiences = get_field('tour_experiences');
$sliderContent = get_field('hero_slider');
$title = $destination->post_title;
$has_video = get_field('has_video');
$vimeo_link = get_field('vimeo_link');
$sliderLimit = 36;

$tours = get_field('tours');

// All Cruises
$cruiseCriteria = array(
    'posts_per_page' => $sliderLimit,
    'post_type' => 'rfc_cruises',
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'destinations', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$allCruises = get_posts($cruiseCriteria);

// FIT Cruises
$cruises = [];
foreach ($allCruises as $cruise) {
    $charter_only = get_field('charter_only', $cruise);
    if (!$charter_only) {
        $cruises[] = $cruise;
    }
}


// Charter Cruises
$charters = [];
foreach ($allCruises as $cruise) {
    $charter_available = get_field('charter_available', $cruise);
    if ($charter_available) {
        $charters[] = $cruise;
    }
}



//Title (Destination)
$title = $destination->post_title;




// Deals

//If Destniation Page Type
$dealArgs = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_deals',
    'meta_key' => 'value_rating',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'destinations', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);



$dealPosts  = get_posts($dealArgs); //Stage I posts
$validDeals = array();

// Filter deals based on expiration date
foreach ($dealPosts as $deal) {
    $expiration_date = get_field('expiration_date', $deal->ID);

    // If no expiration date is set, include the deal
    if (empty($expiration_date)) {
        $validDeals[] = $deal;
        continue;
    }

    // Convert d/m/Y date to timestamp
    $expiration_timestamp = DateTime::createFromFormat('d/m/Y', $expiration_date)->getTimestamp();

    // Include deal if expiration date is in the future
    if ($expiration_timestamp >= $current_timestamp) {
        $validDeals[] = $deal;
    }
}



$args = array(
    'destination' => $destination,
    'locations' => $locations,
    'activities' => $activities,
    'charters' => $charters,
    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
    'cruises' => $cruises,
    'sliderContent' => $sliderContent,
    'title' => $title,
    'destinationType' => $destinationType,
    'show_charters' => $show_charters,
    'show_tours' => $show_tours,
    'deals' => $validDeals

);

?>

<!-- Hero -->
<main class="destination-page">
    <section class="destination-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'destination-hero', $args);
        ?>
    </section>

    <!-- Cruises -->
    <section class="destination-page__section-main">
        <?php
        get_template_part('template-parts/content', 'destination-main-cruise', $args);
        ?>
    </section>




    <?php if ($show_charters) : ?>
        <!-- Private Charters -->
        <section class="destination-page__section-secondary" id="charters">
            <?php
            get_template_part('template-parts/content', 'destination-charters', $args);
            ?>
        </section>
    <?php endif; ?>

    <!-- Deals -->
    <section class="destination-page__section-deals" id="deals">
        <?php
        get_template_part('template-parts/content', 'destination-deals', $args);
        ?>
    </section>
    
    <!-- Tours-->
    <?php if ($show_tours) : ?>
        <section class="destination-page__section-secondary">
            <?php
            get_template_part('template-parts/content', 'destination-secondary-cruise', $args);
            ?>
        </section>
    <?php endif; ?>

    <!-- Travel Guides -->
    <section class="destination-page__section-travel-guides" id="travel-guide">
        <?php
        get_template_part('template-parts/content', 'destination-guides', $args);
        ?>
    </section>


    <!-- Testimonials -->
    <?php if (get_field('show_testimonials') == true) { ?>
        <section class="destination-page__section-testimonials" id="testimonials">
            <?php
            get_template_part('template-parts/content', 'destination-testimonials', $args);
            ?>
        </section>
    <?php } ?>

    <!-- FAQ -->
    <section class="destination-page__section-faq" id="faq">
        <?php
        get_template_part('template-parts/content', 'destination-faq', $args);
        ?>
    </section>

    <?php if ($has_video) : ?>
        <!-- Video Modal -->
        <div class="modal modal--video stop-video" id="videoModal">
            <div class="modal__video">

                <!-- Top Section -->
                <div class="modal__video__top">

                </div>

                <!-- Main -->
                <div class="modal__video__main">
                    <div style="padding:56.25% 0 0 0;position:relative;">
                        <iframe id="modal-video-iframe" src="<?php echo get_field('vimeo_link') ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Antarctica Cruises"></iframe>
                    </div>
                </div>

            </div>
        </div>
    <?php endif ?>

</main>

<!-- Contact Modal -->
<?php
get_template_part('template-parts/content', 'shared-contact-modal', $args);
?>

<?php get_footer(); ?>