<?php
$cruise_data = $args['cruiseData'];
$deck_plan = get_field('deck_plan');

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
            <?php echo get_field('cabins_intro'); ?>

        </div>


    </div>
    <div id="sentinal-cabins"></div>

    <!-- H2 Title -->
    <h2 class="page-divider u-margin-bottom-small">
        Suites & Cabins
    </h2>

    <!-- Cabins -->
    <?php
    $cabins = $cruise_data['CabinDTOs'];
    $cabinCount = 0;
    if ($cabins) : ?>

        <?php foreach ($cabins as $cabin) : ?>
            <?php
            $occupancy = $cabins[$cabinCount]['PrimaryOccupancy'];
            if ($cabins[$cabinCount]['SecondaryEnabled'] == true) {
                $occupancy = $occupancy + $cabins[$cabinCount]['SecondaryOccupancy'];
            }

            //For Flip, every other row, just change picture and content with --flipped
            $flipClass = "";
            if ($cabinCount % 2 != 0) {
                $flipClass = "--flipped";
            }

            ?>
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__picture product-cabins__cabin__picture<?php echo $flipClass ?>">
                    <img class="product-cabins__cabin__picture__img" src="<?php echo esc_html($cabins[$cabinCount]['ImageDTOs'][0]['ImageUrl']); ?>" alt="">
                </div>
                <div class="product-cabins__cabin__content product-cabins__cabin__content<?php echo $flipClass ?>">
                    <div class="product-cabins__cabin__content__title">
                        <span><?php echo ($cabinCount + 1); ?></span>
                        <h3 class="heading-3 heading-3--underline"><?php echo ($cabins[$cabinCount]['Name']); ?></h3>
                    </div>
                    <div class="product-cabins__cabin__content__feature-grid">
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Guests
                            </h5>
                            <span><?php echo $occupancy; ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Size
                            </h5>
                            <span><?php echo ($cabins[$cabinCount]['Size']); ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Beds
                            </h5>
                            <span><?php echo ($cabins[$cabinCount]['Beds']); ?></span>
                        </div>
                    </div>
                    <?php echo ($cabins[$cabinCount]['Features']); ?>
                    <div class="product-cabins__cabin__content__cta">
                        <button class="btn-outline goto-prices" href="#prices">Check Prices</button>
                    </div>
                </div>
            </div>
            <?php
            $cabinCount++;
            ?>
        <?php endforeach; ?>
    <?php endif; ?>


        <?php if ($deck_plan) { ?>
            <h2 class="page-divider product-cabins__page-divider">
                Technical Information
            </h2>
            <div class="product-cabins__deckplan u-margin-bottom-big">

                <div class="product-cabins__deckplan__picture">
                    <div class="product-cabins__deckplan__picture__title">
                        <h3 class="heading-3 heading-3--underline"><?php echo (get_post_type() == 'rfc_cruises') ? 'Deck Plan' : 'Property Layout' ?></h3>
                    </div>
                    <a class="product-cabins__deckplan__picture" id="map-lightbox" href="<?php echo esc_url($deck_plan['url']); ?>" title="Deckplan">
                        <img class="product-cabins__deckplan__picture__img" src="<?php echo esc_url($deck_plan['url']); ?>" alt="">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                        </svg>
                    </a>
                </div>


                <div class="product-cabins__deckplan__content">
                    <div class="product-cabins__deckplan__content__title">
                        <h3 class="heading-3 heading-3--underline">Features</h3>
                    </div>

                    <?php
                    $ship_features = get_field('ship_features');
                    if ($ship_features) : ?>

                        <ul class="product-cabins__ship-info__content__list">
                            <li class="product-cabins__ship-info__content__item">
                                <span>Number of Cabins: </span>
                                <p><?php echo $ship_features['number_of_cabins']; ?></p>
                            </li>
                            <li class="product-cabins__ship-info__content__item">
                                <span>Capacity: </span>
                                <p><?php echo $ship_features['capacity']; ?> passengers</p>
                            </li>
                            <li class="product-cabins__ship-info__content__item">
                                <span>Interconnectable Cabins: </span>
                                <p><?php echo $ship_features['interconnectable_cabins']; ?></p>
                            </li>
                            <li class="product-cabins__ship-info__content__item">
                                <span>Air-Conditioning: </span>
                                <p><?php echo $ship_features['air_conditioning']; ?></p>
                            </li>
                            <li class="product-cabins__ship-info__content__item">
                                <span>Bathrooms: </span>
                                <p><?php echo $ship_features['bathrooms']; ?></p>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>
        <?php } ?>



</div>