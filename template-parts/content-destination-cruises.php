<?php

$cruises = $args['cruises'];
$currentYear = date("Y");

?>


<div class="destination-cruises">
    <div class="destination-cruises__header">
        <div class="destination-cruises__header__title page-divider">
            Cruises
        </div>
        <div class="destination-cruises__header__sub-text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
        </div>
    </div>

    <div class="destination-cruises__best-selling">

        <div class="destination-cruises__best-selling__slider" id="cruises-slider">
            <?php foreach ($cruises as $c) : ?>
                <?php
                $featured_image = get_field('featured_image', $c);
                $cruise_data = get_field('cruise_data', $c);
                $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                //$rangeLow = $cruise_data['LowestLengthInDays'];
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
    <div class="destination-cruises__btn ">
        <button class="btn-outline " href="#">View All Cruises</button>
    </div>
</div>