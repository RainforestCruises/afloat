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
$location = get_field('location');

$image = get_field('image');
$intro_snippet = get_field('intro_snippet');

$destination_type = get_field('destination_type');

$pageTitle = get_the_title();

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
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            )
        )

    );
    console_log('dest');
};

if ($destination_type == 'rfc_regions') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides',
        'meta_query' => array(
            array(
                'key' => 'region', // name of custom field
                'value' => $region->ID, // strangely will not work with quotes around
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'is_region_level', // name of custom field
                'value' => true,
                'compare' => 'LIKE'
            )
        )

    );



    //get all posts from child destinations also here
    console_log('region');
    console_log($region->ID);
}


if ($destination_type == 'rfc_locations') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides',
        'meta_query' => array(
            array(
                'key' => 'locations', // name of custom field
                'value' => '"' . $location->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );
};



//breadcrumbs
//destination / region
$breadcrumbDestinationPage  = get_field('breadcrumb_destination_page');

$breadcrumbDestinationURL = get_permalink($breadcrumbDestinationPage);

$templateType = get_page_template_slug($breadcrumbDestinationPage->ID);
$breadcrumbDestinationText = "";
if ($templateType == 'template-destinations-destination.php' || $templateType == 'template-destinations-cruise.php') {
    $destinationPost = get_field('destination_post', $breadcrumbDestinationPage);
    $breadcrumbDestinationText  = get_field('navigation_title', $destinationPost);
}
if ($templateType == 'template-destinations-region.php') {
    $regionPost = get_field('region_post', $breadcrumbDestinationPage);
    $breadcrumbDestinationText  = get_field('navigation_title', $regionPost);
}


$posts = get_posts($args); //Stage I posts


?>

<div class="travel-guide-landing-page">

    <!-- Intro -->
    <div class="travel-guide-landing-page__header">

        <div class="travel-guide-landing-page__header__image-area">
            <?php if ($image) : ?>
                <img <?php afloat_responsive_image($image['ID'], 'pill-large', array('pill-large', 'featured-small', 'featured-large', 'pill-large')); ?> alt="">
            <?php endif; ?>
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
        <!-- Breadcrumb -->
        <ol class="travel-guide-landing-page__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">Home</a>
            </li>
            <li>
                <a href=" <?php echo $breadcrumbDestinationURL; ?>"><?php echo $breadcrumbDestinationText; ?></a>
            </li>

            <li>
                <?php echo get_the_title(); ?>
            </li>
        </ol>
        <div class="travel-guide-landing-page__content__title">
            <?php echo $pageTitle ?>
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

            if ($posts) :

                foreach ($posts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $guideCategories = get_field('categories', $p);
                    $isoClasses = '';
                    if ($guideCategories) {
                        foreach ($guideCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>


                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image-area">
                            <img <?php afloat_responsive_image($featured_image['ID'], 'featured-medium', array('featured-small', 'featured-medium')); ?>>
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
                            <a class="guide-item__bottom__title" href="<?php echo the_permalink($p) ?>">
                                <?php echo get_field('navigation_title', $p); ?>
                            </a>
                            <div class="guide-item__bottom__snippet">
                                <?php
                                echo get_the_excerpt($p);
                                ?>
                            </div>
                            <div class="guide-item__bottom__cta">
                                <a class="goto-button goto-button--dark" href="<?php echo the_permalink($p) ?>">
                                    Read More
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>


            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>


</div>



<?php get_footer(); ?>