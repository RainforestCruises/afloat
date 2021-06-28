<?php

$cruises = $args['cruises'];
$currentYear = date("Y");

console_log($cruises);

?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <h2 class="destination-secondary__header__title page-divider">
            Cruises
        </h2>
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
                $charter_only = get_field('charter_only', $c);
                $charter_min_days = get_field('charter_min_days', $c);
                $charter_daily_price = get_field('charter_daily_price', $c);

                $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                ?>
                <!-- Card -->

                <a class="product-card" href="<?php echo get_permalink($c); ?>">
                    <div class="product-card__image-area">
                        <?php if ($featured_image) : ?>
                            <img <?php afloat_responsive_image($featured_image['id'], 'featured-medium', array('featured-medium')); ?> alt="">
                        <?php endif; ?>
                        <?php if ($charter_only) : ?>
                            <div class="product-card__image-area__badge-area">
                                <div class="product-card__image-area__badge-area__badge">
                                    Charter
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <h3 class="product-card__bottom__title-group__product-name">
                                <?php echo get_the_title($c) ?>
                            </h3>

                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo get_field('top_snippet', $c) ?>
                        </div>
                        <div class="product-card__bottom__info">


                            <div class="product-card__bottom__info__length-group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                                <div class="product-card__bottom__info__length-group__length">

                                    <?php if ($charter_only) :
                                        echo $charter_min_days . ' Days +';
                                    else :
                                        echo itineraryRange($cruise_data, " - ") . ' Days';
                                    endif; ?>
                                </div>
                            </div>
                            <div class="product-card__bottom__info__price-group">
                                <?php if ($charter_only) : ?>
                                    <div class="product-card__bottom__info__price-group__from">Day</div>
                                    <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($charter_daily_price, 0);  ?> <span>USD</span></div>
                                <?php else : ?>
                                    <div class="product-card__bottom__info__price-group__from">From</div>
                                    <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($lowestPrice, 0);  ?> <span>USD</span></div>
                                <?php endif; ?>
                            </div>
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