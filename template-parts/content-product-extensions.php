<?php
$extensions = get_field('extensions');
$currentYear = date("Y");

$resultCount = 0;

?>

<div class="product-related">
    <h2 class="page-divider page-divider--padding u-margin-bottom-medium u-margin-top-small">
        Extensions
    </h2>
    <?php if ($extensions) : ?>
        <div class="product-related__slider" id="extensions-slider">

            <?php
            foreach ($extensions as $extension) :
                $featured_image =  get_post_type($extension) == 'rfc_tours' ? get_field('best_selling_image', $extension) : get_field('featured_image', $extension);
                $countries  = get_field('destinations', $extension);
                $price_packages = get_field('price_packages', $extension);
                $cruise_data = get_field('cruise_data', $extension);

                $lowest = get_post_type($extension) == 'rfc_tours' ? lowest_tour_price($price_packages, $currentYear) : lowest_property_price($cruise_data, 0, $currentYear, true);

      
                $length =  get_post_type($extension) == 'rfc_tours' ? get_field('length', $extension) . ' Days' : itineraryRange($cruise_data, " - ") . ' Days';
                $dealPosts = listDealsForProduct($extension);
                $hasDeals = (count($dealPosts) > 0) ? true : false;
                $top_snippet = get_field('top_snippet', $extension);

                if ($resultCount <= 12) :
            ?>

                    <!-- Card -->
                    <a class="product-card" href="<?php echo get_permalink($extension); ?>">
                        <div class="product-card__image-area">
                            <?php if ($featured_image) : ?>
                                <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                            <?php endif; ?>
                            <ul class="product-card__image-area__destinations">
                                <?php
                                if ($countries) :
                                    foreach ($countries as $d) :
                                        echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                    endforeach;
                                endif; ?>
                            </ul>

                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <h3 class="product-card__bottom__title-group__product-name">
                                    <?php echo (get_post_type($extension) == 'rfc_tours') ? get_field('tour_name', $extension) : get_the_title($extension) ?>
                                </h3>
                            </div>
                            <div class="product-card__bottom__text">
                                <?php echo $top_snippet ?>
                            </div>
                            <div class="product-card__bottom__info">
                                <div class="product-card__bottom__info__length-group">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                    <div class="product-card__bottom__info__length-group__length">
                                        <?php
                                        echo $length;

                                        ?>

                                    </div>
                                </div>
                                <div class="product-card__bottom__info__price-group">
                                    <div class="product-card__bottom__info__price-group__from"><?php echo $prePriceText ?></div>
                                    <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($lowest, 0); ?> <span>USD</span></div>

                                </div>


                            </div>
                        </div>
                    </a>

            <?php
                    $resultCount++;
                endif;
            endforeach;
            ?>
        </div>
    <?php endif; ?>
</div>