<?php
$queryArgs = array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'post__not_in' => array( $post->ID )

);


//build meta query criteria
$queryArgsDestination = array();
$queryArgsDestination['relation'] = 'OR';

$destinations = get_field('destinations');
if($destinations){
    foreach ($destinations as $d) {
        if(get_field('is_country', $d) == true){
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

<div class="related-slider" id="related-slider">

    <?php
    if ($posts) :
        foreach ($posts as $p) {

            

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

            <div class="related-slider__item" onClick="parent.location='<?php echo get_permalink($p); ?>'">
                <div class="related-slider__item__title-group">
                    <div class="related-slider__item__title-group__name">
                        <?php echo get_the_title($p) ?>
                    </div>
                    <div class="related-slider__item__title-group__country">
                        <?php
                        echo countriesInDestinations($relatedItemDestinations, '/')
                        ?>
                    </div>
                </div>
                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="related-slider__item__img">
                <div class="related-slider__item__bottom">
                    <div class="related-slider__item__bottom__header">
                       <?php productType($p) ?>
                    </div>
                    <div class="related-slider__item__bottom__description">
                        <?php echo $top_snippet; ?>
                    </div>
                    <div class="related-slider__item__bottom__last-section">
                        <div class="related-slider__item__bottom__length">
                            <span class="related-slider__item__bottom__length__numbers"><?php echo (get_post_type($p) == 'rfc_tours') ? $tour_length : $lowest . '-' . $highest ?></span>
                            <span class="related-slider__item__bottom__length__text">Days</span>
                        </div>
                        <div class="related-slider__item__bottom__price">
                            <div class="related-slider__item__bottom__price__text">
                                From
                            </div>
                            <div class="related-slider__item__bottom__price__numbers">
                                <?php echo "$" . number_format($lowestPrice, 0);  ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    <?php

        }
    endif;
    ?>





    <?php

    ?>
</div>


<script>
    var relatedCount = '<?php echo $relatedCount; ?>';
</script>