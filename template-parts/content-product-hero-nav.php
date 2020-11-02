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
                <li class="product-nav__tab-list__item tab-overview current" data-tab="tab-overview">
                    Overview
                </li>
                <li class="product-nav__tab-list__item tab-itineraries " data-tab="tab-itineraries">
                    Itineraries
                </li>
                <li class="product-nav__tab-list__item tab-cabins" data-tab="tab-cabins">
                    <?php echo (get_post_type() == 'rfc_cruises') ? ('Cabins') : ('Accommodations'); ?>
                </li>
                <li class="product-nav__tab-list__item tab-prices" data-tab="tab-prices">
                    Prices
                </li>
                <?php if (get_post_type() == 'rfc_cruises') { ?>
                    <li class="product-nav__tab-list__item tab-dates" data-tab="tab-dates">
                        Dates
                    </li>
                <?php } ?>
            </ul>

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
                        <div class="product-nav__slick__item__title">
                            <?php echo esc_html($image['title']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
</section>