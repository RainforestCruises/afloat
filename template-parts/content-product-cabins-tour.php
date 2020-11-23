<?php

$properties = get_field('properties');



?>



<div class="product-cabins">
    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('accommodations_intro'); ?>

        </div>


    </div>
    <div id="sentinal-cabins"></div>
    <div class="page-divider u-margin-bottom-small">
        Tour Accommodations
    </div>
    <?php
    $propertyCount = 0;
    if ($properties) : ?>

        <?php foreach ($properties as $property) : ?>
            <?php
            $propertyPost = get_post($property);
            $flipClass = "";
            if ($propertyCount % 2 != 0) {
                $flipClass = "--flipped";
            }
            $featured_image = get_field('featured_image',  $property);
            $propertyTitle = get_the_title($property);
            $propertySnippet = get_field('overview_intro',  $property);
            $propertyIntro = get_field('cabins_intro',  $property);


            ?>
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__picture product-cabins__cabin__picture<?php echo $flipClass ?>">
                    <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                </div>
                <div class="product-cabins__cabin__content product-cabins__cabin__content<?php echo $flipClass ?>">
                    <div class="product-cabins__cabin__content__title">
                        <span><?php echo ($propertyCount + 1); ?></span>
                        <div class="heading-3 heading-3--underline"><?php echo $propertyTitle; ?></div>
                    </div>
                    <div class="product-cabins__cabin__content__description">
                        <?php echo $propertySnippet; ?>
                        <?php echo $propertyIntro; ?>
                    </div>
                    

                    <div class="product-cabins__cabin__content__cta">
                        <a href="<?php echo get_site_url() . '/cruises/' . get_post_field('post_name', $property); ?>" target="_blank" class="btn-outline" data-tab="tab-prices">Learn More</a>
                    </div>
                </div>
            </div>
            <?php
            $propertyCount++;
            ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="product-cabins__note">
        <div class="attention-box">
            <?php $destination = get_field('destination'); ?>
            <p>All itineraries are completely customizable. Contact our travel specialists to build your perfect <?php echo get_the_title($destination[0]) ?> vacation</p>
        </div>
    </div>

</div>