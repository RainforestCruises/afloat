<?php
$queryArgs = array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID)

);


//build meta query criteria
$queryArgsDestination = array();
$queryArgsDestination['relation'] = 'OR';

$destinations = get_field('destinations');
if ($destinations) {
    foreach ($destinations as $d) {
        if (get_field('is_country', $d) == true) {
            $queryArgsDestination[] = array(
                'key'     => 'destinations',
                'value'   => serialize(strval($d->ID)),
                'compare' => 'LIKE'
            );
        }
    }
    $queryArgs['meta_query'][] = $queryArgsDestination;
}


$posts = get_posts($queryArgs);
$relatedCount = 0;
?>

<div class="product-related">

    <div class="product-related__slider" id="related-slider">

        <?php
        if ($posts) :
            foreach ($posts as $p) :

                $relatedCount++;

                $featured_image = get_field('featured_image', $p);
                $cruise_data = get_field('cruise_data', $p);
                $relatedItemDestinations = get_field('destinations', $p);
                $top_snippet = get_field('top_snippet', $p);

                if (get_post_type($p) != 'rfc_cruises') {

                    $tour_length = get_field('length', $p);

                    $priceList = [];
                    $price_packages = get_field('price_packages', $p);

                    if ($price_packages) {
                        foreach ($price_packages as $price_package) {
                            if ($price_package['year'] >= date("Y")) {
                                $priceList[] = $price_package['price'];
                            }
                        }
                    }

                    $lowestPrice = 0;
                    if ($priceList) {
                        sort($priceList);
                        $lowestPrice = $priceList[0];
                    }
                } else {
                    $lowest = $cruise_data['LowestLengthInDays'];
                    $highest = $cruise_data['HighestLengthInDays'];
                    $lowestPrice = $cruise_data['LowestPrice'];
                }
        ?>

                <!-- Card -->
                <a class="product-card" href="<?php echo get_permalink($p); ?>">
                    <div class="product-card__image-area">
                        <?php if ($featured_image) : ?>
                            <img <?php afloat_responsive_image($featured_image['id'], 'featured-medium', array('featured-medium')); ?> alt="">
                        <?php endif; ?>
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <div class="product-card__bottom__title-group__product-name">
                                <?php echo get_the_title($p) ?>
                            </div>
                            <div class="product-card__bottom__title-group__price">
                                <span class="from-price">From</span> <?php echo "$" . number_format($lowestPrice, 0);  ?> <span class="currency-price">USD</span>
                            </div>
                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo $top_snippet ?>
                        </div>
                        <div class="product-card__bottom__info">
                            <?php echo (get_post_type($p) == 'rfc_tours') ? $tour_length  . " Day Tour" : itineraryRange($cruise_data, " - ") . " Day Cruises"; ?>
                        </div>
                    </div>
                </a>

        <?php
            endforeach;
        endif;
        ?>
    </div>
</div>



<script>
    var relatedCount = '<?php echo $relatedCount; ?>';
</script>