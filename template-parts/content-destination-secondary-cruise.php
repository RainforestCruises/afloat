<?php

$tours = $args['tours'];
$currentYear = date("Y");

$destination = get_field('destination_post');
$tour_experiences = get_field('tour_experiences');
?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <h2 class="destination-secondary__header__title page-divider" id="extensions">
            Cruise Extensions
        </h2>
        <div class="destination-secondary__header__sub-text">
            <?php echo get_field('tour_package_title_subtext') ?>
        </div>
    </div>
    <div class="destination-main__packages">
        <div class="destination-main__packages__best-selling">

            <div class="destination-main__packages__best-selling__slider" id="main-slider">
                <?php foreach ($tours as $t) : 

      
                    $hero_image =  get_post_type($t) == 'rfc_tours' ? get_field('best_selling_image', $t) : get_field('featured_image', $t);
                    $countries  = get_field('destinations', $t);
                    $price_packages = get_field('price_packages', $t);
                    $cruise_data = get_field('cruise_data', $t);

                    $lowest = get_post_type($t) == 'rfc_tours' ? lowest_tour_price($price_packages, $currentYear) : lowest_property_price($cruise_data, 0, $currentYear, true);
                    $length =  get_post_type($t) == 'rfc_tours' ? get_field('length', $t) . ' Days' : itineraryRange($cruise_data, " - ") . ' Days';
                    $dealPosts = listDealsForProduct($t);
                    $hasDeals = (count($dealPosts) > 0) ? true : false;

                    ?>
                        <!-- Tour Card -->
                        <a class="wide-slider-card" href="<?php echo get_permalink($t); ?>">
                            <?php if ($hero_image) { ?>
                                <div class="wide-slider-card__image">
                                    <img <?php afloat_image_markup($hero_image['id'], 'wide-slider-medium'); ?>>
                                </div>
                            <?php } ?>

                            <div class="wide-slider-card__content">
                                <div class="wide-slider-card__content__tag-area">
                                    <div class="wide-slider-card__content__tag-area__tag">
                                        Best Seller
                                    </div>
                                    <?php if ($hasDeals) : ?>
                                        <div class="wide-slider-card__content__tag-area__tag deal-tag">
                                            Deals
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="wide-slider-card__content__text-area">
                                    <div class="wide-slider-card__content__text-area__country">
                                        <?php foreach ($countries as $c) :
                                            $isCountry = get_field('is_country', $c);
                                            if ($isCountry) : ?>
                                                <li>
                                                    <?php echo get_the_title($c); ?>
                                                </li>

                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                    <h3 class="wide-slider-card__content__text-area__title">
                                        <?php echo get_field('tour_name', $t) ?>
                                    </h3>
                                    <h5 class="wide-slider-card__content__text-area__info">
                                        <div class="wide-slider-card__content__text-area__info__length">
                                            <?php echo $length ?>
                                        </div>
                                        <div class="wide-slider-card__content__text-area__info__price">
                                            From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                        </div>

                                    </h5>
                                </div>
                            </div>
                        </a>
                <?php  endforeach; ?>
            </div>
        </div>
    </div>

    <?php
    $top_level_packages_page = get_field('top_level_packages_page', 'options');
    ?>

    <div class="destination-main__lengths">

        <a class="btn-outline btn-outline--dark btn-outline--small" href="<?php echo $top_level_packages_page . '?destination=' . $destination->ID; ?>">View All Extensions</a>
    </div>


</div>