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
console_log($destination);
console_log($locations);

$destinationCount = count($locations);

usort($locations, function ($a, $b) {
    return strcmp($a->importance, $b->importance);
});

?>

<!-- Hero -->
<div class="destination-page">
    <section class="destination-page__section-hero" id="top">

        <!-- Destination Hero -->
        <div class="destination-hero">
            <div class="destination-hero__bg-slide" id="destination-hero__bg">
                <?php foreach ($locations as $s) : ?>
                    <img src="<?php echo wp_get_attachment_url($s->hero_image); ?>" alt="">

                <?php endforeach; ?>
            </div>
            <div class="destination-hero__content">
                <div class="destination-hero__content__breadcrumb">
                    <ol class="destination-hero__content__breadcrumb__path">
                        <li>
                            <a href="#">Destinations</a>
                        </li>
                        <li>
                            <?php echo ($destination->post_title) ?>
                        </li>
                    </ol>
                </div>
                <div class="destination-hero__content__title">
                    Peru Vacations
                </div>

                <div class="destination-hero__content__page-nav">


                    <!-- sticky wrapper -->
                    <nav class="destination-hero__content__page-nav__sticky-wrapper" id="template-nav">
                        <div class="destination-hero__content__page-nav__title" id="template-nav-title" href="#top">
                            <?php echo ($destination->post_title) ?>
                        </div>
                        <ul class="destination-hero__content__page-nav__list">
                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#tours" class="destination-hero__content__page-nav__list__item__link ">Tours</a>
                            </li>
                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                            </li>
                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#accommodations" class="destination-hero__content__page-nav__list__item__link">Accommodations</a>
                            </li>

                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#travel-guides" class="destination-hero__content__page-nav__list__item__link">Travel Guides</a>
                            </li>
                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#reviews" class="destination-hero__content__page-nav__list__item__link">Reviews</a>
                            </li>
                            <li class="destination-hero__content__page-nav__list__item">
                                <a href="#faq" class="destination-hero__content__page-nav__list__item__link">FAQ</a>
                            </li>
                        </ul>
                        <div class="page-nav__button">
                            <?php echo ($destination->post_title) ?>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </div>
                        <!-- page-nav__collapse--active -->
                        <nav class="page-nav__collapse ">
                            <ul class="page-nav__collapse__list">
                                <li class="page-nav__collapse__list__item" href="#tours">
                                    Tours
                                </li>
                                <li class="page-nav__collapse__list__item" href="#cruises">
                                    Cruises
                                </li>
                                <li class="page-nav__collapse__list__item" href="#accommodations">
                                    Accommodations
                                </li>
                            </ul>
                        </nav>



                    </nav>



                    <div class="destination-hero__content__page-nav__arrow">
                        <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#tours">
                            <svg class="btn-circle--arrow-main">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg>
                            <svg class="btn-circle--arrow-animate">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg></button>
                    </div>




                </div>


                <div class="destination-hero__content__location-slider">
                    <div class="destination-hero__content__location-slider__main" id="destination-hero__content">
                        <?php foreach ($locations as $s) : ?>
                            <div class="destination-hero__content__location-slider__main__item">
                                <div class="destination-hero__content__location-slider__main__item__title">
                                    <?php echo ($s->hero_title); ?>
                                </div>
                                <div class="destination-hero__content__location-slider__main__item__text">
                                    <?php echo ($s->hero_short_text); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>
                    <div class="destination-hero__content__location-slider__nav" id="destination-hero__nav">
                        <?php foreach ($locations as $s) : ?>
                            <div class="destination-hero__content__location-slider__nav__item"><?php echo ($s->post_title); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>


            </div>
        </div>

    </section>




    <div class="destination-page__section-intro" id="tours">
        <div class="destination-intro">
            <img class="destination-intro__bg" src="<?php echo bloginfo('template_url') ?>/css/img/test-images/map-peru-outline.png" alt="">

            <!-- Intro -->
            <div class="destination-intro__content">
                <div class="destination-intro__content__description">
                    <div class="destination-intro__content__description__title">
                        Travel In Peru
                    </div>
                    <div class="destination-intro__content__description__text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsam tempore ullam illo quasi quod. Totam libero doloremque accusantium iusto vero distinctio ipsa consequuntur in nulla? Consectetur sit deleniti dolor.
                    </div>
                </div>
                <div class="destination-intro__content__locations">
                    <div class="destination-intro__content__locations__title">
                        Destinations
                    </div>
                    <ul class="destination-intro__content__locations__list">
                        <?php foreach ($locations as $s) : ?>
                            <li>
                                <a href="#"><?php echo ($s->post_title); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="destination-intro__content__locations__title">
                        Explore All
                    </div>
                </div>
            </div>

            <!-- Tours -->
            <div class="destination-intro__tours">
                <div class="destination-intro__tours__header">
                    <div class="destination-intro__tours__header__title page-divider">
                        Tour Packages
                    </div>
                    <div class="destination-intro__tours__header__sub-text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
                    </div>
                </div>

                <div class="destination-intro__tours__best-selling">
                    <div class="destination-intro__tours__best-selling__item">
                        <div class="destination-intro__tours__best-selling__item__img"></div>
                    </div>
                </div>
            </div>

        </div>
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
            $args = array(
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
            $cruisePosts = get_posts($args);
            console_log($cruisePosts);
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
    <section class="destination-page__section-accommodations" id="accommodations">
        <div class="destination-accommodations">
            <div class="destination-accommodations__title">
                Accommodations
            </div>
            <div class="destination-accommodations__intro-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate qui rem in minus! Voluptatum, praesentium
                atque obcaecati quod consequatur debitis. Iure, aliquid. Quam cupiditate sequi impedit. Quasi nihil voluptates
                ipsam!
            </div>

            <div class="destination-accommodations__grid">
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">17 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/hotel-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Hotels in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">8 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/lodge-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Lodges in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">23 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/cruise-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Cruise Ships in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
            </div>

            <div class="destination-accommodations__all">
                <button class="btn-outline btn-grey">All Peru Accommodations</button>
            </div>
        </div>
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