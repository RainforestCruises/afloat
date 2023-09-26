<?php

$charters = $args['charters'];
$currentYear = date("Y");
$charter_search_link = get_field('charter_search_link');
$charter_title_subtext = get_field('charter_title_subtext');
console_log($charters);

?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <h2 class="destination-secondary__header__title page-divider">
            Private Charters
        </h2>
        <div class="destination-secondary__header__sub-text">
            <?php echo $charter_title_subtext; ?>
        </div>
    </div>

    <div class="destination-secondary__best-selling">

        <div class="destination-secondary__best-selling__slider" id="charter-slider">
            <?php foreach ($charters as $c) : ?>
                <?php
                $featured_image = get_field('featured_image', $c);
                $cruise_data = get_field('cruise_data', $c);
                $charter_min_days = get_field('charter_min_days', $c);
                $charter_display_full_price = get_field('charter_display_full_price', $c);

                $dealPosts = listDealsForProduct($c, true);
                $hasDeals = (count($dealPosts) > 0) ? true : false;
                $prePriceText = "Per Day";

                if (array_key_exists("LowestCharterPrice", $cruise_data)) {
                    $charter_price = $cruise_data['LowestCharterPrice'];
                    if($charter_display_full_price == true){
                        $charter_price = $charter_min_days * $charter_price;
                        $prePriceText = "From";
                    }
                }

                $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear, true);
                ?>
                <!-- Card -->

                <a class="product-card" href="<?php echo get_permalink($c); ?>?charter=true">
                    <?php if ($hasDeals) : ?>
                        <div class="product-card__tag">
                            <div class="deal-tag">
                                Deals
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product-card__image-area">
                        <?php if ($featured_image) : ?>
                            <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                        <?php endif; ?>


                        <ul class="product-card__image-area__destinations">
                            <?php
                            $destinations = $c->destinations;
                            if ($destinations) :
                                foreach ($destinations as $d) :
                                    echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                endforeach;
                            endif; ?>
                        </ul>


                        <div class="product-card__image-area__charter-text">
                            Private Charter
                        </div>

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
                                    <?php echo $charter_min_days . ' Days +'; ?>
                                </div>
                            </div>
                            <div class="product-card__bottom__info__price-group">
                                <div class="product-card__bottom__info__price-group__from"><?php echo $prePriceText;?></div>
                                <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($charter_price, 0);  ?> <span>USD</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="destination-secondary__btn ">
        <a class="btn-outline btn-outline--dark  btn-outline--small" href="<?php echo $charter_search_link; ?>">View All Charters</a>
    </div>
</div>