<?php
$hero_image = get_field('hero_image');
$productTitle = get_the_title();
$breadcrumb = get_field('breadcrumb');

$showOverview = true;
if (get_post_type() == 'rfc_tours') {
    $productTitle = get_field('tour_name');
    $showOverview  = get_field('show_overview');
};

$charter_view = false;

if ($args['propertyType'] == 'Cruise') {
    if ($args['charter_view'] == true) {
        $charter_view = true;
    }
}


$images = get_field('highlight_gallery');
?>

<div class="product-hero">

    <!-- Top Section -->
    <div class="product-hero__top">
        <div class="product-hero__top__bg" id="top">
            <img <?php afloat_responsive_image($hero_image['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?> alt="">

        </div>

        <!-- Title / Navigation -->
        <div class="product-hero__top__content">

            <!-- Breadcrumb -->
            <ol class="product-hero__top__content__breadcrumb">
                <li>
                    <a href="<?php echo home_url() ?>">Home</a>
                </li>
                <?php
                if ($breadcrumb) :
                    foreach ($breadcrumb as $b) :
                        if ($b['link'] != null) : ?>
                            <li>
                                <a href=" <?php echo $b['link']  ?>"><?php echo $b['title'] ?></a>
                            </li>
                        <?php else : ?>
                            <li>
                                <?php echo $b['title'] ?>
                            </li>
                <?php endif;
                    endforeach;
                endif; ?>

            </ol>
            <div>
                <!-- H1 Title / Subtitle -->
                <div class="product-hero__top__content__title-group">
                    <h1 class="product-hero__top__content__title-group__title" id="template-nav-title"><?php echo $productTitle ?></h1>
                    <h2 class="product-hero__top__content__title-group__subtitle"><?php echo get_field('top_snippet') ?></h2>
                </div>


                <!-- Navigation Wrapper -->
                <nav class="product-hero__top__content__nav" id="template-nav">

                    <!-- Hidden title -->
                    <div class="page-nav-title">
                        <?php echo $productTitle ?>
                    </div>

                    <!-- nav list -->
                    <ul class="product-hero__top__content__nav__list">
                        <?php if ($showOverview) : ?>
                            <li class="product-hero__top__content__nav__list__item">
                                <a href="#overview" class="product-hero__top__content__nav__list__item__link page-nav-template">Overview</a>
                            </li>
                        <?php endif; ?>
                        <li class="product-hero__top__content__nav__list__item <?php echo ($showOverview ? '' : 'current') ?>">
                            <a href="#itineraries" class="product-hero__top__content__nav__list__item__link page-nav-template"><?php echo (get_post_type() == 'rfc_cruises') ? ('Itineraries') : ('Itinerary'); ?></a>
                        </li>
                        <li class="product-hero__top__content__nav__list__item ">
                            <a href="#accommodations" class="product-hero__top__content__nav__list__item__link page-nav-template">Accommodations</a>
                        </li>
                        <!-- <li class="product-hero__top__content__nav__list__item ">
                        <a href="#prices" class="product-hero__top__content__nav__list__item__link page-nav-template">Prices</a>
                    </li>
                    <?php if (get_post_type() == 'rfc_cruises') { ?>
                        <?php if (!$args['charter_view']) : ?>
                            <li class="product-hero__top__content__nav__list__item tab-dates">
                                <a href="#dates" class="product-hero__top__content__nav__list__item__link page-nav-template">Dates</a>
                            </li>
                    <?php endif;
                    } ?> -->
                    </ul>

                    <!-- mobile menu header -->
                    <div class="page-nav">
                        <div class="page-nav__button">
                            <!-- for tour name Tour Name -->
                            <?php echo get_the_title() ?>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </div>

                        <div class="page-nav__cta">
                            <button class="btn-cta-square btn-cta-square--small btn-cta-square--white">
                                Inquire
                            </button>
                        </div>
                    </div>

                    <!--mobile menu expand-->
                    <nav class="page-nav__collapse ">
                        <ul class="page-nav__collapse__list">
                            <?php if ($showOverview) : ?>
                                <li class="page-nav__collapse__list__item">
                                    <a class="page-nav__collapse__list__item__link" href="#overview">Overview</a>
                                </li>
                            <?php endif; ?>
                            <li class="page-nav__collapse__list__item">
                                <a class="page-nav__collapse__list__item__link" href="#itineraries">Itineraries</a>
                            </li>
                            <li class="page-nav__collapse__list__item">
                                <a class="page-nav__collapse__list__item__link" href="#accommodations">Accommodations</a>
                            </li>
                            <!-- <li class="page-nav__collapse__list__item">
                            <a class="page-nav__collapse__list__item__link" href="#prices">Prices</a>
                        </li>
                        <?php if (get_post_type() == 'rfc_cruises') { ?>
                            <li class="page-nav__collapse__list__item">
                                <a class="page-nav__collapse__list__item__link" href="#dates">Dates</a>
                            </li>
                        <?php } ?> -->
                        </ul>
                    </nav>
                </nav>

                <!-- CTA -->
                <div class="product-hero__top__content__cta">
                    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#overview">
                        <svg class="btn-circle--arrow-main">
                            <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                        <svg class="btn-circle--arrow-animate">
                            <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg></button>
                </div>
            </div>


            <!-- Expand Gallery -->
            <?php if ($images) : ?>
                <div class="product-hero__top__content__gallery-expand" id="gallery-expand-button">
                    Photos
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Gallery  -->
    <div class="product-hero__gallery">

        <div class="product-hero__gallery__slick" id="product-gallery">
            <?php

            if ($images) : ?>
                <?php foreach ($images as $image) : ?>
                    <div class="product-hero__gallery__slick__item">

                        <a href="<?php echo esc_url($image['url']); ?>">
                            <img <?php afloat_responsive_image($image['id'], 'square-small', array('square-small')); ?> alt="">

                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>


    <!-- Bottom Section -->
    <div class="product-hero__bottom">

        <!-- Info Area -->
        <div class="product-hero__bottom__content">
            <div class="product-hero__bottom__content__info-group">

                <!-- Starting Price / CTA -->
                <div class="product-hero__bottom__content__info-group__info">
                    <?php if ($charter_view == false) : ?>
                        <div class="product-hero__bottom__content__info-group__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
                    <?php else : ?>
                        <div class="product-hero__bottom__content__info-group__info__starting-price">Charter: <span><?php echo "$" . number_format($args['charter_daily_price'], 0); ?> </span> <span class="u-small-text"> / Day</span></div>
                    <?php endif; ?>
                    <div class="product-hero__bottom__content__info-group__info__cta">
                        <button class="btn-cta-round">Inquire</button>
                    </div>
                </div>

                <!-- KSPs -->
                <div class="product-hero__bottom__content__info-group__attributes">
                    <div class="product-hero__bottom__content__info-group__attributes__item <?php echo (get_post_type($p) == 'rfc_tours') ? "tour" : ""; ?>">
                        <div class="product-hero__bottom__content__info-group__attributes__item__title">
                            <?php echo (get_post_type($p) == 'rfc_tours') ? "Length" : "Itineraries"; ?>
                        </div>
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <?php if ($charter_view == false) : ?>
                                <?php echo (get_post_type($p) == 'rfc_tours') ? get_field('length') . " Days" : itineraryRange($args['cruiseData'], " - ") . " Days"; ?>
                            <?php else :
                                echo get_field('charter_min_days') . " Days +";
                            endif; ?>
                        </div>
                    </div>
                    <div class="product-hero__bottom__content__info-group__attributes__item <?php echo (get_post_type($p) == 'rfc_tours') ? "tour" : ""; ?>">
                        <div class="product-hero__bottom__content__info-group__attributes__item__title">
                            <?php echo (get_post_type($p) == 'rfc_tours') ? "Experience" : "Capacity"; ?>
                        </div>
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <?php if (get_post_type($p) == 'rfc_tours') : ?>
                                <?php $experiences = get_field('experiences');
                                if ($experiences) : ?>
                                    <ul>
                                        <?php foreach ($experiences as $e) : ?>
                                            <li><?php echo get_the_title($e) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            
                            <?php else :
                                echo get_field('vessel_capacity') . ' Guests';
                            endif; ?>


                        </div>
                    </div>
                    <?php if (get_post_type($p) != 'rfc_tours') : ?>
                        <div class="product-hero__bottom__content__info-group__attributes__item ">
                            <div class="product-hero__bottom__content__info-group__attributes__item__title">
                                Availability
                            </div>
                            <div class="product-hero__bottom__content__info-group__attributes__item__data" style="color: #00a84b">
                                High
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>

        </div>
    </div>



</div>