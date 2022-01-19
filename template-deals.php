<?php
/*Template Name: Deals - Landing Page*/
wp_enqueue_script('page-travel-guide-landing', get_template_directory_uri() . '/js/page-travel-guide-landing.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php

$landing_page_type = get_field('landing_page_type');


$destination = get_field('destination');
$region = get_field('region');
$deal_category = get_field('deal_category');

$intro_snippet = get_field('intro_snippet');


$pageTitle = get_the_title();


$categories = [];

//all related posts
if ($landing_page_type == 'rfc_deal_categories') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_query' => array(
            array(
                'key' => 'categories', // name of custom field
                'value' => '"' . $deal_category->ID . '"',
                'compare' => 'LIKE'
            )
        )

    );

    $categories = get_posts(array(
        'post_type' => 'rfc_regions',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
};

if ($landing_page_type == 'rfc_destinations') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_query' => array(
            array(
                'key' => 'destinations', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );

    $categories = get_posts(array(
        'post_type' => 'rfc_deal_categories',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
};

if ($landing_page_type == 'rfc_regions') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_query' => array(
            array(
                'key' => 'regions', // name of custom field
                'value' => $region->ID, // strangely will not work with quotes around
                'compare' => 'LIKE'
            )
        )
    );

    $categories = get_posts(array(
        'post_type' => 'rfc_destinations',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'region', // name of custom field
                'value' => $region->ID,
                'compare' => 'LIKE'
            )
        )
    ));
}



$posts = get_posts($args); //Stage I posts



?>

<main class="travel-guide-landing-page">

    <!-- Content -->
    <section class="travel-guide-landing-page__content">
        <!-- Breadcrumb -->
        <ol class="travel-guide-landing-page__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo get_field('top_level_deals_page', 'options') ?>">All Deals</a>
            </li>

            <li>
                <?php echo get_the_title(); ?>
            </li>
        </ol>
        <h1 class="travel-guide-landing-page__content__title">
            <?php echo $pageTitle ?>
        </h1>

        <div class="travel-guide-landing-page__content__subtext">
            <?php echo $intro_snippet ?>
        </div>

        <div class="travel-guide-landing-page__content__search-area">
            <input type="text" placeholder="Search Guide..." id="quicksearch">
        </div>
        <div class="travel-guide-landing-page__content__categories filters-button-group">
            <button data-filter="*" class="filter-button filter-button-all selected">
                All
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
                    $applicable_to = get_field('applicable_to', $p);

                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }


                    $guideCategories = [];
                    if ($landing_page_type == 'rfc_deal_categories') {
                        $guideCategories = get_field('regions', $p);
                    }
                    if ($landing_page_type == 'rfc_regions') {
                        $guideCategories = get_field('destinations', $p);
                    }
                    if ($landing_page_type == 'rfc_destinations') {
                        $guideCategories = get_field('categories', $p);
                    }


                    $isoClasses = '';
                    if ($guideCategories) {
                        foreach ($guideCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>


                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image-area">
                            <img <?php afloat_responsive_image($imageID, 'featured-medium', array('featured-small', 'featured-medium')); ?>>
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
                            <div class="guide-item__bottom__title" >
                                <h2>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h2>

                            </div>
                            <div class="guide-item__bottom__snippet">
                                <?php echo get_field('description', $p); ?>
                            </div>
                            <?php if ($applicable_to == 'broadCategory') : 
                                $serp_link = get_field('serp_link', $p);
                                ?>
                                <div class="guide-item__bottom__cta">
                                    <a class="goto-button goto-button--dark" href="<?php echo $serp_link ?>">
                                        View All
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            <?php elseif ($applicable_to == 'travelProducts') :
                                $travelProducts = get_field('products', $p);

                            ?>
                               
                                <div class="guide-item__bottom__cta guide-item__bottom__cta--multiple">
                                    <span>Available On: </span>
                                    <?php foreach ($travelProducts as $product) : ?>
                                        <a class="goto-button goto-button--dark" href="<?php echo the_permalink($product) ?>">
                                            <?php echo get_the_title($product); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


            <?php
                endforeach;
            endif;
            ?>
        </div>
    </section>


</main>



<?php get_footer(); ?>