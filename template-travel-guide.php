<?php
/*Template Name: Travel Guide*/
wp_enqueue_script('page-travel-guide-landing', get_template_directory_uri() . '/js/page-travel-guide-landing.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-travel-guide-landing',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);

get_header();

$destination = get_field('destination');
$author = get_field('author');

$region = get_field('region');
$location = get_field('location');
$image = get_field('image');
$intro_snippet = get_field('intro_snippet');
$featured_snippet = get_field('featured_snippet');
$show_featured = get_field('show_featured');

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
};

//all related posts
if ($destination_type == 'rfc_author') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides',
        'meta_query' => array(
            array(
                'key' => 'author',
                'value' => $author->ID,
                'compare' => '='
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

if ($destination_type == 'rfc_top') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_travel_guides'
    );

    $categories = get_posts(array(
        'post_type' => 'rfc_destinations',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
};

$posts = get_posts($args); // regular posts
console_log($posts);
$featured_args = $args; // Copy the existing args that match your destination type

// Add the is_featured condition to the meta_query
$featured_args['meta_query'][] = array(
    'key' => 'is_featured',
    'value' => '1', // or true depending on how your ACF field stores boolean values
    'compare' => '='
);

// Get the featured posts
$featured_posts = get_posts($featured_args);


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

?>



<main class="travel-guide-landing-page">


    <!-- Content -->
    <section class="travel-guide-landing-page__content">
        <!-- Breadcrumb -->
        <ol class="travel-guide-landing-page__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">Home</a>
            </li>
            <?php if ($destination_type != 'rfc_top' && $destination_type != 'rfc_author') : ?>
                <li>
                    <a href=" <?php echo $breadcrumbDestinationURL; ?>"><?php echo $breadcrumbDestinationText; ?></a>
                </li>
            <?php endif; ?>
            <li>
                <?php echo get_the_title(); ?>
            </li>
        </ol>


        <!-- Titles -->
        <h1 class="travel-guide-landing-page__content__title">
            <?php echo $pageTitle ?>
        </h1>
        <?php if ($destination_type == 'rfc_author' && $author != null) :
            $authorImage = get_field('image', $author);
            $authorWebsite = get_field('website', $author);
            $authorTwitter = get_field('twitter', $author);
        ?>
            <div class="travel-guide-landing-page__content__author">
                <div class="travel-guide-landing-page__content__author__avatar">
                    <img src="<?php echo $authorImage['url']; ?>" alt="<?php echo $authorImage['alt']; ?>">
                </div>
                <div class="travel-guide-landing-page__content__author__links">
                    <?php if ($authorWebsite) : ?>
                        <a class="travel-guide-landing-page__content__author__links__social" href="<?php echo $authorWebsite; ?>" target="_blank" rel="nofollow noopener">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                            </svg>
                            <?php echo $authorWebsite; ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($authorTwitter) : ?>
                        <a class="travel-guide-landing-page__content__author__links__social" href="<?php echo 'https://x.com/' . $authorTwitter; ?>" target="_blank" rel="noopener">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
                            </svg>
                            @<?php echo $authorTwitter; ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        <?php endif; ?>
        <div class="travel-guide-landing-page__content__subtext">
            <?php echo $intro_snippet ?>
        </div>

    </section>
    <!-- Featured -->
    <?php if ($featured_posts) : ?>
        <div class="destination-main" style="margin-bottom: 0;">
            <div class="destination-main__packages" id="cruises">
                <div class="destination-main__packages__header">
                    <h2 class="destination-main__packages__header__title page-divider">
                        Featured
                    </h2>
                </div>

                <!-- Best Selling - use secondary slider-->
                <div class="destination-secondary__best-selling">
                    <div class="destination-secondary__best-selling__slider" id="featured-slider">
                        <?php
                        foreach ($featured_posts as $p) :
                            $featured_image = get_field('featured_image', $p);
                            $imageID = '';
                            if ($featured_image) {
                                $imageID = $featured_image['ID'];
                            }
                            $guideCategories = get_field('categories', $p);


                        ?>
                            <a class="product-card" href="<?php echo get_permalink($p); ?>">

                                <div class="product-card__image-area">
                                    <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>

                                    <ul class="product-card__image-area__destinations">
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

                                </div>

                                <div class="product-card__bottom">
                                    <div class="product-card__bottom__title-group">
                                        <h3 class="product-card__bottom__title-group__product-name">
                                            <?php echo get_field('navigation_title', $p); ?>
                                        </h3>
                                    </div>
                                    <div style="font-size: 1.4rem; padding: 2rem 1rem">
                                        <?php
                                        echo get_the_excerpt($p);
                                        ?>
                                    </div>

                                </div>
                            </a>

                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="destination-main__packages__header">
                    <h2 class="destination-main__packages__header__title page-divider">
                        All Guides
                    </h2>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <section class="travel-guide-landing-page__content">

        <!-- Search -->
        <div class="travel-guide-landing-page__content__search-area">
            <input type="text" placeholder="Search Guide..." id="quicksearch">
        </div>

        <!-- Categories -->
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

        <!-- Guides -->
        <div class="travel-guide-landing-page__content__results" id="results">
            <?php
            if ($posts) :

                foreach ($posts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }
                    $guideCategories = ($destination_type == 'rfc_top') ? get_field('destinations', $p) : get_field('categories', $p);


                    $isoClasses = '';
                    if ($guideCategories) {
                        foreach ($guideCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>


                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image-area">
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
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

                                <h3>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h3>

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
        <div class="travel-guide-landing-page__content__no-results" id="no-results-message">
            No travel guides available. Please select another category.
        </div>
    </section>

    <div class="svg-divider">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
        </svg>
    </div>

    <!-- Newsletter -->
    <section class="experience-page__section-newsletter">
        <?php
        get_template_part('template-parts/content', 'shared-newsletter');
        ?>
    </section>

</main>



<?php get_footer(); ?>