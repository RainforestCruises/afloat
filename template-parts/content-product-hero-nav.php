<?php
$hero_image = get_field('hero_image');
$productTitle = get_the_title();
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
?>

<div class="product-hero">

    <div class="product-hero__top">
        <div class="product-hero__top__bg" id="top">
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
        </div>

        <!-- Page Title/Nav -->
        <div class="product-hero__top__content">

            <!-- H1 Title / H2 Subtitle-->
            <div class="product-hero__top__content__title-group">
                <h1 class="product-hero__top__content__title-group__title" id="template-nav-title"><?php echo $productTitle ?></h1>
                <h2 class="product-hero__top__content__title-group__subtitle"><?php echo get_field('top_snippet') ?></h2>
            </div>


            <!-- Navigation Wrapper -->
            <div class="product-hero__top__content__sticky-wrapper" id="template-nav">
                <ul class="product-hero__top__content__tab-list">
                    <?php if ($showOverview) : ?>

                        <li class="product-hero__top__content__tab-list__item tab-overview current">
                            <a href="#overview" class="product-hero__top__content__tab-list__item__link">Overview</a>
                        </li>
                    <?php endif; ?>
                    <li class="product-hero__top__content__tab-list__item tab-itineraries <?php echo ($showOverview ? '' : 'current') ?>">
                        <a href="#itineraries" class="product-hero__top__content__tab-list__item__link"><?php echo (get_post_type() == 'rfc_cruises') ? ('Itineraries') : ('Itinerary'); ?></a>
                    </li>
                    <li class="product-hero__top__content__tab-list__item tab-cabins">
                        <a href="#cabins" class="product-hero__top__content__tab-list__item__link"><?php echo (get_post_type() == 'rfc_cruises') ? ('Cabins') : ('Accommodations'); ?></a>
                    </li>
                    <li class="product-hero__top__content__tab-list__item tab-prices" data-tab="tab-prices">
                        <a href="#prices" class="product-hero__top__content__tab-list__item__link">Prices</a>
                    </li>
                    <?php if (get_post_type() == 'rfc_cruises') { ?>
                        <?php if (!$args['charter_view']) : ?>

                            <li class="product-hero__top__content__tab-list__item tab-dates" data-tab="tab-dates">
                                <a href="#dates" class="product-hero__top__content__tab-list__item__link">Dates</a>
                            </li>
                    <?php endif;
                    } ?>
                </ul>
                <div class="page-nav">
                    <div class="page-nav__button">
                        <!-- for tour name Tour Name -->
                        <?php echo get_the_title() ?>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </div>

                    <!-- <div class="page-nav__cta">
                        <button class="btn-cta-square btn-cta-square--small btn-cta-square--white">
                            Inquire
                        </button>
                    </div> -->
                </div>

                <!-- page-nav__collapse--active -->
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
                            <a class="page-nav__collapse__list__item__link" href="#cabins"><?php echo (get_post_type() == 'rfc_cruises') ? ('Cabins') : ('Accommodations'); ?></a>
                        </li>
                        <li class="page-nav__collapse__list__item">
                            <a class="page-nav__collapse__list__item__link" href="#prices">Prices</a>
                        </li>
                        <?php if (get_post_type() == 'rfc_cruises') { ?>
                            <li class="page-nav__collapse__list__item">
                                <a class="page-nav__collapse__list__item__link" href="#dates">Dates</a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

            <!-- CTA -->
            <div class="product-hero__top__content__cta">
                <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button">
                    <svg class="btn-circle--arrow-main">
                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-down"></use>
                    </svg>
                    <svg class="btn-circle--arrow-animate">
                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-down"></use>
                    </svg></button>
            </div>

            <div class="product-hero__top__content__gallery-expand" id="gallery-expand-button">
                Photos
            </div>
        </div>
    </div>

    <!-- Gallery -->
    <div class="product-hero__gallery">

        <div class="product-hero__gallery__slick" id="product-gallery">
            <?php
            $images = get_field('highlight_gallery');
            if ($images) : ?>
                <?php foreach ($images as $image) : ?>
                    <div class="product-hero__gallery__slick__item">
                        <a href="<?php echo esc_url($image['url']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>



    <div class="product-hero__bottom">
        <div class="product-hero__bottom__content">
            <div class="product-hero__bottom__content__info-group">
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
                <div class="product-hero__bottom__content__info-group__attributes">

                    <div class="product-hero__bottom__content__info-group__attributes__item">
                        <div class="product-hero__bottom__content__info-group__attributes__item__title">
                            Itineraries
                        </div>
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            4-8 Days
                        </div>
                    </div>
                    <div class="product-hero__bottom__content__info-group__attributes__item">
                        <div class="product-hero__bottom__content__info-group__attributes__item__title">
                            Capacity
                        </div>
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            16 Guests
                        </div>
                    </div>
                    <div class="product-hero__bottom__content__info-group__attributes__item">
                        <div class="product-hero__bottom__content__info-group__attributes__item__title">
                            Availability
                        </div>
                        <div class="product-hero__bottom__content__info-group__attributes__item__data" style="color: #00a84b">
                            High
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>



</div>