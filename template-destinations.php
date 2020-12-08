<?php
/*Template Name: Destinations*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<?php
$destination = get_field('destination_post');
$locations = get_field('locations', $destination->ID); //selector, post ID
$tour_experiences = get_field('tour_experiences'); //selector, post ID
console_log($tour_experiences);
$destinationCount = count($locations);

//need to get all tours that have this destination
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


//sort locations by importance
usort($locations, function ($a, $b) {
    return strcmp($a->importance, $b->importance);
});


$args = array(
    'destination' => $destination,
    'locations' => $locations,
    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
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

        <div class="destination-cruises">
            <div class="destination-cruises__header">
                <div class="destination-cruises__header__title page-divider">
                    Cruises
                </div>
                <div class="destination-cruises__header__sub-text">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
                </div>
            </div>

            <?php
            $postCriteria = array(
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
            $cruisePosts = get_posts($postCriteria);
            ?>

            <div class="destination-cruises__best-selling">

                <div class="destination-cruises__best-selling__slider" id="cruises-slider">
                    <?php foreach ($cruisePosts as $c) : ?>
                        <?php
                        $featured_image = get_field('featured_image', $c);
                        $cruise_data = get_field('cruise_data', $c);
                        $lowest = $cruise_data['LowestPrice'];
                        ?>
                        <!-- Card -->

                        <a class="product-card" href="<?php echo get_permalink($c); ?>">
                            <div class="product-card__image">
                                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                            </div>
                            <div class="product-card__bottom">
                                <div class="product-card__bottom__title-group">
                                    <div class="product-card__bottom__title-group__product-name">
                                        <?php echo get_the_title($c) ?>
                                    </div>
                                    <div class="product-card__bottom__title-group__price">
                                        <span class="from-price">From</span> <?php echo "$" . number_format($lowest, 0);  ?> <span class="currency-price">USD</span>
                                    </div>
                                </div>
                                <div class="product-card__bottom__text">
                                    <?php echo get_field('top_snippet', $c) ?>
                                </div>
                                <div class="product-card__bottom__info">
                                    6 - 9 Day Cruises
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>



            </div>
            <div class="destination-cruises__btn ">
                <button class="btn-outline " href="#">View All Cruises</button>
            </div>
        </div>
    </section>

    <!-- Accommodations -->
    <section class="destination-page__section-accommodations" style="display: none;" id="accommodations">
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