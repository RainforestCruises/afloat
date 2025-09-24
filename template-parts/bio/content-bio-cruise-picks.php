<?php
$cruises_title = get_field('cruises_title');
$cruises_text = get_field('cruises_text');

$posts = get_field('cruises');

$resultCount = 0;

?>

<div class="product-related">
    <h2 class="page-divider page-divider--padding u-margin-bottom-medium u-margin-top-small">
        <?php echo $cruises_title ?>
    </h2>
    <div class="product-related__sub-text">
        <?php echo $cruises_text ?>
    </div>
    <?php if ($posts) : ?>
        <div class="product-related__slider" id="related-slider">

            <?php
            foreach ($posts as $p) :
                $featured_image = get_field('featured_image', $p);
                $cruise_data = get_field('cruise_data', $p);
                $prePriceText = "Per Day";

                $charterView = false;
                $isCharterOnly = false;
                $hasCharterAvailable = false;
                $charter_min_days = 0;
                $charter_price = 0;
                $link = get_permalink($p);
                if (get_post_type() == 'rfc_cruises') {
                    $charterView = $args['charter_view'];
                    $isCharterOnly = get_field('charter_only', $p);
                    $hasCharterAvailable = get_field('charter_available', $p);
                    $charter_min_days = get_field('charter_min_days', $p);
                    $charter_display_full_price = get_field('charter_display_full_price', $p);


                    if (array_key_exists("LowestCharterPrice", $cruise_data)) {
                        $charter_price = $cruise_data['LowestCharterPrice'];
                        if($charter_display_full_price == true){
                            $charter_price = $charter_min_days * $charter_price;
                            $prePriceText = "From";
                        }
                    }
                }

                if (!$charterView) {
                    if ($isCharterOnly) {
                        continue;
                    }
                } else {
                    if (!$hasCharterAvailable) {
                        continue;
                    }

                    if (!$isCharterOnly) {
                        $link = $link . "?charter=true";
                    };
                }



                $relatedItemDestinations = get_field('destinations', $p);
                $top_snippet = get_field('top_snippet', $p);
                $currentYear = date('Y');
                $propertyDestinations  = get_field('destinations', $p);
                if (get_post_type($p) == 'rfc_tours') {
                    $prePriceText = "From ";

                    $tour_length = get_field('length', $p);
                    $price_packages = get_field('price_packages', $p);

                    $lowestPrice = lowest_tour_price($price_packages, $currentYear);
                } else {

                    $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                }
                if ($resultCount <= 12) :
            ?>

                    <!-- Card -->
                    <a class="product-card" href="<?php echo $link;; ?>">
                        <div class="product-card__image-area">
                            <?php if ($featured_image) : ?>
                                <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                            <?php endif; ?>
                            <ul class="product-card__image-area__destinations">
                                <?php
                                if ($propertyDestinations) :
                                    foreach ($propertyDestinations as $d) :
                                        echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                    endforeach;
                                endif; ?>
                            </ul>
                            <?php if ($charterView) : ?>
                                <div class="product-card__image-area__charter-text">
                                    Private Charter
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <h3 class="product-card__bottom__title-group__product-name">
                                    <?php echo (get_post_type($p) == 'rfc_tours') ? get_field('tour_name', $p) : get_the_title($p) ?>
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
                                        <?php if ($charterView) :
                                            echo $charter_min_days . ' Days +';
                                        else :
                                            echo (get_post_type($p) == 'rfc_tours') ? $tour_length  . " Days" : itineraryRange($cruise_data, " - ") . " Days";
                                        endif; ?>

                                    </div>
                                </div>
                                <div class="product-card__bottom__info__price-group">

                                    <?php if ($charterView) : ?>
                                        <div class="product-card__bottom__info__price-group__from"><?php echo $prePriceText ?></div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($charter_price);  ?> <span>USD</span></div>

                                    <?php else : ?>
                                        <div class="product-card__bottom__info__price-group__from"><?php echo $prePriceText ?></div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($lowestPrice); ?> <span>USD</span></div>
                                    <?php endif; ?>

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