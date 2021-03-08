<?php

$cruises = $args['cruises'];
$currentYear = date("Y");

?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <div class="destination-secondary__header__title page-divider">
            Cruises
        </div>
        <div class="destination-secondary__header__sub-text">
            <?php echo get_field('cruise_title_subtext') ?>
        </div>
    </div>

    <div class="destination-secondary__best-selling">

        <div class="destination-secondary__best-selling__slider" id="secondary-slider">
            <?php foreach ($cruises as $c) : ?>
                <?php
                $featured_image = get_field('featured_image', $c);
                $cruise_data = get_field('cruise_data', $c);
                $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                ?>
                <!-- Card -->

                <a class="product-card" href="<?php echo get_permalink($c); ?>">
                    <div class="product-card__image">
                        <?php if ($featured_image) : ?>
                            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <div class="product-card__bottom__title-group__product-name">
                                <?php echo get_the_title($c) ?>
                            </div>
                            <div class="product-card__bottom__title-group__price">
                                <span class="from-price">From</span> <?php echo "$" . number_format($lowestPrice, 0);  ?> <span class="currency-price">USD</span>
                            </div>
                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo get_field('top_snippet', $c) ?>
                        </div>
                        <div class="product-card__bottom__info">
                            <?php echo itineraryRange($cruise_data, " - ") ?> Day Cruises
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    $cruise_search_link = get_field('cruise_search_link');
    ?>

    <div class="destination-secondary__btn ">
        <a class="btn-outline btn-outline--dark" href="<?php echo $cruise_search_link; ?>">View All Cruises</a>
    </div>
</div>