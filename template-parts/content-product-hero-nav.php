<?php
$hero_image = get_field('hero_image');
?>


<section class="product-hero" id="top">
    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
</section>

<!-- Nav -->
<section class="product-nav">
    <div class="product-nav__caption">
        <h1 class="product-nav__caption__title" id="template-nav-title" href="#top"><?php echo get_the_title() ?></h1>
        <h2 class="product-nav__caption__subtitle"><?php echo get_field('top_snippet') ?></h2>
        <div class="product-nav__sticky-wrapper" id="template-nav">
            <ul class="product-nav__tab-list">
                <li class="product-nav__tab-list__item tab-overview current">
                    <a href="#overview" class="product-nav__tab-list__item__link">Overview</a>
                </li>
                <li class="product-nav__tab-list__item tab-itineraries ">
                    <a href="#itineraries" class="product-nav__tab-list__item__link">Itineraries</a>
                </li>
                <li class="product-nav__tab-list__item tab-cabins">
                    <a href="#cabins" class="product-nav__tab-list__item__link"><?php echo (get_post_type() == 'rfc_cruises') ? ('Cabins') : ('Accommodations'); ?></a>


                </li>
                <li class="product-nav__tab-list__item tab-prices" data-tab="tab-prices">
                    <a href="#prices" class="product-nav__tab-list__item__link">Prices</a>

                </li>
                <?php if (get_post_type() == 'rfc_cruises') { ?>
                    <li class="product-nav__tab-list__item tab-dates" data-tab="tab-dates">
                        <a href="#dates" class="product-nav__tab-list__item__link">Dates</a>

                    </li>
                <?php } ?>
            </ul>
            <div class="page-nav__button">
                Delfin III
                <svg>
                    <use xlink:href="img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </div>
            <!-- page-nav__collapse--active -->
            <nav class="page-nav__collapse ">
                <ul class="page-nav__collapse__list">
                    <li class="page-nav__collapse__list__item" href="#tours">
                        <a href="#overview">Overview</a>
                    </li>
                    <li class="page-nav__collapse__list__item" href="#cruises">
                        <a href="#itineraries">Itineraries</a>
                    </li>
                    <li class="page-nav__collapse__list__item" href="#accommodations">
                        <a href="#cabins">Cabins</a>
                    </li>
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