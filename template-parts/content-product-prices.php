<?php
$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];

?>
<div class="product-prices">
    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($cruise_data['LowestPrice'], 0); ?></span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('prices_intro'); ?>

        </div>

    </div>

    <div id="sentinal-prices"></div>
    <h2 class="page-divider ">
        Price List
    </h2>

    <?php
    $itineraries = $cruise_data['Itineraries'];
    $pricesImagery = get_field('prices_imagery');
    $itinerariesCount = 0;
    if ($itineraries) : ?>

        <?php foreach ($itineraries as $itinerary) : ?>

            <?php $flipClass = "";
            if ($itinerariesCount % 2 != 0) {
                $flipClass = "--flipped";
            } ?>

            <!-- Price Group -->
            <div class="product-prices__price-group <?php echo ($itinerariesCount == 0) ? ('') : ('u-margin-top-medium') ?>">
                <div class="product-prices__price-group__picture product-prices__price-group__picture<?php echo $flipClass ?>">
                    <img src="<?php echo esc_html($pricesImagery[$itinerariesCount]['url']); ?>" alt="">
                </div>
                <div class="product-prices__price-group__name product-prices__price-group__name<?php echo $flipClass ?>">
                    <h4 class="product-prices__price-group__name__length">
                        <?php echo ($itineraries[$itinerariesCount]['LengthInDays']); ?> Day / <?php echo ($itineraries[$itinerariesCount]['LengthInNights']); ?> Night
                    </h4>
                    <div class="product-prices__price-group__name__subtitle">
                        <h3 class="heading-3 heading-3--underline">
                            <?php echo ($itineraries[$itinerariesCount]['Name']); ?>
                        </h3>
                    </div>
                </div>
                <div class="product-prices__price-group__card-group product-prices__price-group__card-group<?php echo $flipClass ?>">

                    <?php
                    $rateYears = $itineraries[$itinerariesCount]['RateYears'];
                    $rateYearsCount = 0;
                    if ($rateYears) : ?>
                        <?php foreach ($rateYears as $rateYear) :
                            if ($rateYearsCount < 2) {
                        ?>
                                <!-- Card 2020 -->
                                <div class="product-prices__price-group__card-group__card">
                                    <!-- Reg Season -->
                                    <h4 class="product-prices__price-group__card-group__card__year">
                                        <?php echo ($rateYear['Year']); ?>
                                    </h4>
                                    <h5 class="product-prices__price-group__card-group__card__season">
                                        Regular Season
                                    </h5>
                                    <div class="product-prices__price-group__card-group__card__cabin-list">
                                        <?php $rates = $rateYear['Rates']; ?>
                                        <?php if ($rates) {
                                            foreach ($rates as $rate) : ?>
                                                <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__cabin">
                                                        <?php echo ($rate['Cabin']); ?>
                                                    </div>
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__prices">
                                                        <?php echo "$ " . number_format($rate['WebAmount'], 0);  ?>

                                                        <?php if ($rate['IsSingle'] == true) { ?>
                                                            <span class="single-info">Single Pricing</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php endforeach;
                                        } else { ?>
                                            <div class="product-prices__price-group__card-group__card__cabin-list__item">Call for Pricing</div>

                                        <?php }; ?>
                                    </div>

                                    <?php if ($rateYear['HasHighSeason'] == true) { ?>
                                        <!-- High Season -->
                                        <h5 class="product-prices__price-group__card-group__card__season">
                                            High Season
                                        </h5>
                                        <div class="product-prices__price-group__card-group__card__cabin-list">
                                            <?php foreach ($rates as $rate) : ?>
                                                <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__cabin">
                                                        <?php echo ($rate['Cabin']); ?>
                                                    </div>
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__prices">
                                                        <?php echo "$ " . number_format($rate['HighSeasonWeb'], 0);  ?>
                                                        <?php if ($rate['IsSingle'] == true) { ?>
                                                            <span class="single-info">Single Pricing</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($rateYear['HasLowSeason'] == true) { ?>
                                        <!-- High Season -->
                                        <h5 class="product-prices__price-group__card-group__card__season">
                                            Low Season
                                        </h5>
                                        <div class="product-prices__price-group__card-group__card__cabin-list">
                                            <?php foreach ($rates as $rate) : ?>
                                                <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__cabin">
                                                        <?php echo ($rate['Cabin']); ?>
                                                    </div>
                                                    <div class="product-prices__price-group__card-group__card__cabin-list__item__prices">
                                                        <?php echo "$ " . number_format($rate['LowSeasonWeb'], 0);  ?>
                                                        <?php if ($rate['IsSingle'] == true) { ?>
                                                            <span class="single-info">Single Pricing</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php
                            }
                            $rateYearsCount++;
                        endforeach;
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php $itinerariesCount++;
        endforeach; ?>
    <?php endif; ?>

    <?php if (get_post_type() == 'rfc_cruises') { ?>
        <div class="product-prices__btn  u-margin-bottom-medium u-margin-top-medium">
            <button class="btn-outline goto-dates" href="#dates">View Availability</button>
        </div>

    <?php } ?>

        
    <?php
     get_template_part('template-parts/content', 'product-prices-extra', $args);
    ?>
</div>