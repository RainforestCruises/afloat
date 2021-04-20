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


$itineraryCount = 0;

if(get_post_type() != 'rfc_tours') {
    $itineraryCount = count($args['cruiseData']['Itineraries']);
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
                </nav>

                <!-- CTA -->
                <div class="product-hero__top__content__cta">
                    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#overview">
                        <svg class="btn-circle--arrow-main">
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                        <svg class="btn-circle--arrow-animate">
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
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
                <div class="product-hero__bottom__content__info-group__info" id="page-title">
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

                    <!-- Itineraries -->
                    <div class="product-hero__bottom__content__info-group__attributes__item <?php echo (get_post_type($p) == 'rfc_tours' ? "nomargin-attributes" : "") ?>">
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <div class="product-hero__bottom__content__info-group__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                            </div>
                            <div class="product-hero__bottom__content__info-group__attributes__item__data__text">
                                <?php if ($charter_view == false) : ?>
                                    <?php echo (get_post_type($p) == 'rfc_tours') ? get_field('length') . " Days / " . (get_field('length') - 1) . " Nights" : itineraryRange($args['cruiseData'], " - ") . " Days"; ?>
                                <?php else :
                                    echo get_field('charter_min_days') . " Days +";
                                endif; ?>
                                <?php if($itineraryCount > 0 && $charter_view == false) : ?>
                                <div class="sub-attribute">
                                    <?php echo $itineraryCount ?> Itineraries
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <?php if (get_post_type($p) != 'rfc_tours') : ?>
                        <!-- Capacity -->
                        <div class="product-hero__bottom__content__info-group__attributes__item nomargin-attributes">

                            <div class="product-hero__bottom__content__info-group__attributes__item__data">

                                <div class="product-hero__bottom__content__info-group__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                    </svg>
                                </div>
                                <div class="product-hero__bottom__content__info-group__attributes__item__data__text">
                                    <?php echo get_field('vessel_capacity') . ' Guests'; ?>
                                    <div class="sub-attribute">
                                        22 Cabins
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Experiences -->
                    <div class="product-hero__bottom__content__info-group__attributes__item experience-attributes">
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <?php $experiences = get_field('experiences');
                            if ($experiences) : ?>
                                <ul>
                                    <?php foreach ($experiences as $e) : ?>
                                        <li>

                                            <div class="experience-icon">
                                                <?php echo get_field('icon', $e); ?>

                                            </div>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>



</div>