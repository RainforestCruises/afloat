<?php
/*Template Name: Travel Guide*/
wp_enqueue_script('page-travel-guide-landing', get_template_directory_uri() . '/js/page-travel-guide-landing.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destination = get_field('destination');
$image = get_field('image');
$intro_snippet = get_field('intro_snippet');

$categories = get_posts(array(
    'post_type' => 'rfc_guide_categories',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

//get all posts
$travelGuideCriteria = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_travel_guides',
    'meta_query' => array(
        array(
            'key' => 'destination', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$travelGuides = get_posts($travelGuideCriteria);

?>

<div class="travel-guide-landing-page">

    <!-- Intro -->
    <div class="travel-guide-landing-page__header">
        <div class="travel-guide-landing-page__header__hero">
            <img src="<?php echo esc_url($image['url']); ?>" alt="">
            <div class="travel-guide-landing-page__header__hero__icon">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-04"></use>
                </svg>
            </div>
            <input type="text" placeholder="Search Guides...">
        </div>
        

    </div>

    <!-- Content -->
    <div class="travel-guide-landing-page__content">
        <div class="travel-guide-landing-page__content__title">
            <?php echo get_field('navigation_title', $destination) ?> Travel Guide
        </div>
        <div class="travel-guide-landing-page__content__subtext">
            <?php echo $intro_snippet ?>
        </div>
        <div class="travel-guide-landing-page__content__categories">
            <button>
                All Guides
            </button>
            <?php foreach ($categories as $c) : ?>
                <button>
                    <?php echo get_the_title($c) ?>
                </button>
            <?php endforeach; ?>

        </div>
        <div class="travel-guide-landing-page__content__results" id="results">

            <?php if ($travelGuides) :
                foreach ($travelGuides as $g) : ?>
                    <!-- Guide -->
                    <?php $featured_image = get_field('featured_image', $g);
                    $guideCategories = get_field('categories', $g);

                    ?>
                    <div class="guide-item">
                        <div class="guide-item__image">
                            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                        </div>
                        <div class="guide-item__bottom">
                            <ul class="guide-item__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            echo trim(get_the_title($c)) ;
                                            ?>
                                        </li>

                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <div class="guide-item__bottom__title">
                                <?php echo get_the_title($g); ?>
                            </div>
                            <div class="guide-item__bottom__snippet">
                                <?php
                                echo substr(strip_tags($g->post_content), 0, 180);
                                ?>...
                            </div>
                            <div class="guide-item__bottom__cta">
                                <button class="goto-button goto-button--dark">
                                    Read More
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

            <?php endforeach;
            endif; ?>
        </div>
    </div>


</div>



<?php get_footer(); ?>