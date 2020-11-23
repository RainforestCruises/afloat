<div class="related-slider" id="related-slider">
    <?php
    $queryArgs = array(
        'post_type' => get_post_type(),
        'posts_per_page' => 8
    );
    $secondary = new WP_Query($queryArgs);
    $relatedCount = 0;
    if ($secondary->have_posts()) :
        while ($secondary->have_posts()) : $secondary->the_post();
            $relatedCount++;

            $featured_image = get_field('featured_image');
            $cruise_data = get_field('cruise_data');
            $countries = get_field('country');
            $top_snippet = get_field('top_snippet');

            if (get_post_type() != 'rfc_cruises') {

                $lowest = get_field('length_in_days');
                $highest = get_field('length_in_days');

                $priceList = [];
                $price_packages = get_field('price_packages');

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

            <div class="related-slider__item" onClick="parent.location='<?php echo get_permalink(); ?>'">
                <div class="related-slider__item__title-group">
                    <div class="related-slider__item__title-group__name">
                        <?php echo get_the_title() ?>
                    </div>
                    <div class="related-slider__item__title-group__country">
                        <?php
                        $count = 0;
                        if ($countries) {
                            foreach ($countries as $country) {
                                $title = get_the_title($country->ID);
                                if ($count != 0) {
                                    echo " / " . $title;
                                } else {
                                    echo $title;
                                }
                                $count++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="related-slider__item__img">
                <div class="related-slider__item__bottom">
                    <div class="related-slider__item__bottom__header">
                        River Cruise
                    </div>
                    <div class="related-slider__item__bottom__description">
                        <?php echo $top_snippet; ?>
                    </div>
                    <div class="related-slider__item__bottom__last-section">
                        <div class="related-slider__item__bottom__length">
                            <span class="related-slider__item__bottom__length__numbers"><?php echo $lowest; ?>-<?php echo $highest; ?></span>
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
        endwhile;
        wp_reset_postdata(); //very important to rest after custom query
    endif;
    ?>
</div>


<script>
    var relatedCount = '<?php echo $relatedCount; ?>';
</script>