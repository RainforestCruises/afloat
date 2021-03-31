<?php

$properties = get_field('properties');

$hotels = get_field('hotels');


?>


<?php if ($properties) : ?>
    <div class="product-cabins u-margin-bottom-small">

        <div class="xsub-divider xsub-divider--dark u-margin-bottom-small">
            Cruises & Lodges
        </div>



        <?php foreach ($properties as $property) : ?>
            <?php
            $propertyPost = get_post($property);
            $featured_image = get_field('featured_image',  $property);
            $propertyTitle = get_the_title($property);
            $propertySnippet = get_field('overview_intro',  $property);
            $propertyIntro = get_field('cabins_intro',  $property);
            ?>
            <!-- Product Card -->
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__image-area">
                    <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title">
                        <h3 class="heading-3 heading-3--underline"><?php echo $propertyTitle; ?></h3>
                    </div>

                    <?php echo $propertyIntro; ?>

                </div>
            </div>


            <!-- New -->


        <?php endforeach; ?>



    </div>
<?php endif; ?>
<?php if ($hotels) : ?>
    <div class="product-hotels">

        <div class="xsub-divider xsub-divider--dark u-margin-bottom-small">
            Hotel Options
        </div>
        <div class="sub-divider-text">
            <p><?php echo get_field('hotels_snippet') ?></p>
        </div>



        <div class="product-hotels__slider" id="hotels-slider">
            <?php foreach ($hotels as $hotel) : ?>
                <?php
                $hotelPost = get_post($hotel);
                $featured_image = get_field('featured_image',  $hotelPost);
                $hotelTitle = get_field('navigation_title',  $hotelPost);
                $priceLevelPost = get_field('price_level',  $hotelPost);
                $hotelLocations = get_field('locations', $hotelPost);

                $hotelCity = null;
                if ($hotelLocations) {
                    $hotelCity = $hotelLocations[0];
                }

                $hotelPriceLevel = null;
                if ($priceLevelPost) {
                    $hotelPriceLevel = get_the_title($priceLevelPost);
                }

                ?>

                <div class="card-square">
                    <div class="card-square__title-group">
                        <div class="card-square__title-group__level">
                            <?php echo $hotelPriceLevel; ?>
                        </div>
                        <div>
                            <div class="card-square__title-group__name">
                                <?php echo  $hotelTitle ?>
                            </div>
                            <div class="card-square__title-group__subtext">
                                <?php echo get_field('navigation_title', $hotelCity) ?>
                            </div>
                        </div>

                    </div>
                    <img class="card-square__image" src="<?php echo $featured_image['url']; ?>" alt="">
                </div>

            <?php endforeach; ?>
        </div>


        <!-- <div class="product-cabins__note">
            <div class="attention-box">
                <?php $destination = get_field('destination'); ?>
                <p>All itineraries are completely customizable. Contact our travel specialists to build your perfect vacation</p>
            </div>
        </div> -->

    </div>

<?php
endif; ?>