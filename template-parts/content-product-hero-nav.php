<?php
$hero_image = get_field('hero_image');
$productTitle = get_the_title();
$showOverview = true;
if (get_post_type() == 'rfc_tours') {
    $productTitle = get_field('length') . '-Day ' . get_field('tour_name');
    $showOverview  = get_field('show_overview');
}
?>


<section class="product-hero" id="top">
    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
</section>

<!-- Page Title/Nav -->
<section class="product-nav">
    <div class="product-nav__caption">

        <!-- H1 Title / H2 Subtitle-->
        <div class="product-nav__caption__title-group">
            <h1 class="product-nav__caption__title-group__title" id="template-nav-title"><?php echo $productTitle ?></h1>
            <h2 class="product-nav__caption__title-group__subtitle"><?php echo get_field('top_snippet') ?></h2>
        </div>

        <!-- Navigation Wrapper -->
        <div class="product-nav__sticky-wrapper" id="template-nav">
            <ul class="product-nav__tab-list">
                <?php if ($showOverview) : ?>

                    <li class="product-nav__tab-list__item tab-overview current">
                        <a href="#overview" class="product-nav__tab-list__item__link">Overview</a>
                    </li>
                <?php endif; ?>
                <li class="product-nav__tab-list__item tab-itineraries <?php echo($showOverview ? '' : 'current') ?>">
                    <a href="#itineraries" class="product-nav__tab-list__item__link"><?php echo (get_post_type() == 'rfc_cruises') ? ('Itineraries') : ('Itinerary'); ?></a>
                </li>
                <li class="product-nav__tab-list__item tab-cabins">
                    <a href="#cabins" class="product-nav__tab-list__item__link"><?php echo (get_post_type() == 'rfc_cruises') ? ('Cabins') : ('Accommodations'); ?></a>
                </li>
                <li class="product-nav__tab-list__item tab-prices" data-tab="tab-prices">
                    <a href="#prices" class="product-nav__tab-list__item__link">Prices</a>
                </li>
                <?php if (get_post_type() == 'rfc_cruises') { ?>
                    <?php if (!$args['charter_view']) : ?>

                        <li class="product-nav__tab-list__item tab-dates" data-tab="tab-dates">
                            <a href="#dates" class="product-nav__tab-list__item__link">Dates</a>
                        </li>
                <?php endif;
                } ?>
            </ul>
            <div class="page-nav__button">
                <!-- for tour name Tour Name -->
                <?php echo get_the_title() ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
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
    </div>

    <div class="product-nav__rotate">
        <div class="product-nav__slick" id="product-nav__slick">
            <?php
            $images = get_field('highlight_gallery');
            if ($images) : ?>
                <?php foreach ($images as $image) : ?>
                    <div class="product-nav__slick__item">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</section>