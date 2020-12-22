<?php

$tours = $args['tours'];
$currentYear = date("Y");

$tours = $args['tours'];

?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <div class="destination-secondary__header__title page-divider">
            Tours
        </div>
        <div class="destination-secondary__header__sub-text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
        </div>
    </div>

    <div class="destination-secondary__best-selling">

        <div class="destination-secondary__best-selling__slider" id="secondary-slider">
            <?php foreach ($tours as $t) : ?>
                <?php
                $featured_image = get_field('featured_image', $t);
                $price_packages = get_field('price_packages', $t);
                $lowest = lowest_tour_price($price_packages, $currentYear);
                //$cruise_data = get_field('cruise_data', $c);
                //$lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                ?>
                <!-- Card -->

                <a class="product-card" href="<?php echo get_permalink($t); ?>">
                    <div class="product-card__image">
                        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <div class="product-card__bottom__title-group__product-name">
                                <?php echo get_field('tour_name', $t) ?>
                            </div>
                            <div class="product-card__bottom__title-group__price">
                                <span class="from-price">From</span> <?php echo "$" . number_format($lowest, 0);  ?> <span class="currency-price">USD</span>
                            </div>
                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo get_field('top_snippet', $t) ?>
                        </div>
                        <div class="product-card__bottom__info">
                            <?php echo get_field('length', $t) ?>-Day Tour
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="destination-secondary__btn ">
        <button class="btn-outline " href="#">View All Tours</button>
    </div>
</div>