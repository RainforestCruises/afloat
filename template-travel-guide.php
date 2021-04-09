<?php
/*Template Name: Travel Guide*/
wp_enqueue_script('page-travel-guide-landing', get_template_directory_uri() . '/js/page-travel-guide-landing.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destination = get_field('destination');
$region = get_field('region');

$image = get_field('image');
$intro_snippet = get_field('intro_snippet');

$destination_type = get_field('destination_type');

$categories = get_posts(array(
    'post_type' => 'rfc_guide_categories',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

//all related posts

if ($destination_type == 'rfc_destinations') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides',
        'meta_query' => array(
            array(
                'key' => 'destinations', // name of custom field
                'value' => $destination->ID,
                'compare' => 'LIKE'
            )
        )

    );
};

if ($destination_type == 'rfc_regions') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides',
        'meta_query' => array(
            array(
                'key' => 'region', // name of custom field
                'value' => $region->ID,
                'compare' => 'LIKE'
            )
        )

    );
    $destination = $region;

    //get all posts from child destinations also here
}

$travelGuidePosts = new WP_Query($args);

?>

<div class="travel-guide-landing-page">

    <!-- Intro -->
    <div class="travel-guide-landing-page__header">
        <div class="travel-guide-landing-page__header__image-area">
            <img <?php afloat_responsive_image($image['ID'], 'pill-large', array('pill-large', 'featured-small', 'featured-large', 'pill-large')); ?> alt="">

        </div>

        <div class="travel-guide-landing-page__header__icon-area">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-04"></use>
            </svg>
        </div>
        <input type="text" placeholder="Search Guide..." id="quicksearch">
    </div>

    <!-- Content -->
    <div class="travel-guide-landing-page__content">
        <div class="travel-guide-landing-page__content__title">
            <?php echo get_field('navigation_title', $destination) ?> Travel Guide
        </div>
        <div class="travel-guide-landing-page__content__subtext">
            <?php echo $intro_snippet ?>
        </div>
        <div class="travel-guide-landing-page__content__categories filters-button-group">
            <button data-filter="*" class="filter-button filter-button-all selected">
                All Guides
            </button>
            <?php foreach ($categories as $c) : ?>
                <button data-filter="<?php echo '.' . $c->post_name ?>" class="filter-button">
                    <?php echo get_the_title($c) ?>
                </button>
            <?php endforeach; ?>

        </div>

        <div class="travel-guide-landing-page__content__results" id="results">

            <?php
            if ($travelGuidePosts->have_posts()) :
                while ($travelGuidePosts->have_posts()) : $travelGuidePosts->the_post();
                    $featured_image = get_field('featured_image');
                    $guideCategories = get_field('categories');

                    $isoClasses = '';
                    if ($guideCategories) :
                        foreach ($guideCategories as $c) :
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        endforeach;
                    endif;

            ?>
                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image-area">
                            <img <?php afloat_responsive_image($featured_image['ID'], 'featured-medium', array('featured-small', 'featured-medium')); ?> alt="">
                        </div>
                        <div class="guide-item__bottom">
                            <ul class="guide-item__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            $catTitle = get_the_title($c);
                                            echo trim($catTitle);
                                            ?>
                                        </li>
                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <a class="guide-item__bottom__title" href="<?php echo the_permalink() ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                            <div class="guide-item__bottom__snippet">
                                <?php
                                echo the_excerpt();
                                ?>
                            </div>
                            <div class="guide-item__bottom__cta">
                                <a class="goto-button goto-button--dark" href="<?php echo the_permalink() ?>">
                                    Read More
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata(); //very important to rest after custom query
            endif;
            ?>
        </div>
    </div>


</div>



<?php get_footer(); ?>