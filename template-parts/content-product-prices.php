<?php
$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];
$charter_view = false;
$charter_only = false;

$featured_image = get_field('featured_image');


if ($args['propertyType'] == 'Cruise') {
    if ($args['charter_view'] == true) {
        $charter_view = true;
    }
    if ($args['charter_only'] == true) {
        $charter_only = true;
    }
}



?>
<div class="product-prices">
    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <?php if ($charter_view == false) : ?>
                <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <?php else : ?>
                <div class="product-intro__info__starting-price">Charter: <span><?php echo "$" . number_format($args['charter_daily_price'], 0); ?> </span> <span class="u-small-text"> / Day</span></div>
            <?php endif; ?> <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('prices_intro'); ?>

        </div>

    </div>

    <div id="sentinal-prices"></div>
    <h2 class="page-divider product-prices__divider">
        <?php echo ($charter_view) ? 'Charter Pricing' : 'Price List'; ?>
    </h2>

    <?php
    if (!$charter_view) :
        $itineraries = $cruise_data['Itineraries'];
        $pricesImagery = get_field('prices_imagery');
        $itinerariesCount = 0;
        if ($itineraries) :
            foreach ($itineraries as $itinerary) :
                $flipClass = "";
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
            endforeach;
        endif;

    else :
        //charter
        $vessel_capacity = get_field('vessel_capacity');
        $charter_daily_price = get_field('charter_daily_price');
        $charter_snippet = get_field('charter_snippet');

        $price_per_person = 0;
        if ($charter_daily_price > 0) {
            $price_per_person = $charter_daily_price / $vessel_capacity;
        }
        ?>

        <div class="product-prices__charter">

            <!-- Text -->
            <div class="product-prices__charter__text">
                <img class="product-prices__charter__text__img" src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                <div class="product-prices__charter__text__title">
                    <?php echo get_the_title() ?> Charter
                </div>
                <div class="product-prices__charter__text__snippet">
                    <?php echo $charter_snippet ?>
                </div>
            </div>

            <!-- Info -->
            <div class="product-prices__charter__info">
                <div class="product-prices__charter__info__info-group">
                    <div class="product-prices__charter__info__info-group__title">
                        Vessel Capacity
                    </div>
                    <div class="product-prices__charter__info__info-group__data">
                        <?php echo $vessel_capacity ?> Guests
                    </div>
                </div>
                <div class="product-prices__charter__info__info-group">
                    <div class="product-prices__charter__info__info-group__title">
                        Price Per Night
                    </div>
                    <div class="product-prices__charter__info__info-group__data">
                        <?php echo "$ " . number_format($charter_daily_price, 0);  ?>
                    </div>
                </div>
                <div class="product-prices__charter__info__info-group product-prices__charter__info__info-group--border-top">
                    <div class="product-prices__charter__info__info-group__title">
                        Price Per Person / Night
                    </div>
                    <div class="product-prices__charter__info__info-group__data">
                        <?php echo "$ " . number_format($price_per_person, 0);  ?>
                    </div>
                </div>
                <div class="product-prices__charter__info__small-print">
                    Sample Itinerary Pricing Per Person:
                </div>
                <div class="product-prices__charter__info__estimates">
                    <?php foreach ($cruise_data['Itineraries'] as $itinerary) :

                        if ($charter_only == false) {
                            $nights = $itinerary['LengthInNights'];
                            $price = $nights * $price_per_person;
                        } else {

                            if ($itinerary['IsSample'] == true) {
                                $nights = $itinerary['LengthInNights'];
                                $price = $nights * $price_per_person;
                            } else {
                                continue;
                            }
                        }

                    ?>
                        <div class="product-prices__charter__info__estimates__itinerary">
                            <div class="product-prices__charter__info__estimates__itinerary__title">
                                <?php echo $nights ?>-Night
                            </div>
                            <div class="product-prices__charter__info__estimates__itinerary__price">
                                <?php echo "$ " . number_format($price, 0);  ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>



                </div>
                <div class="product-prices__charter__info__fine-print">
                    Pricing based on 100% occupancy
                </div>

            </div>
        </div>

    <?php endif; ?>

    <?php if (get_post_type() == 'rfc_cruises' && !$charter_view) { ?>
        <div class="product-prices__btn  u-margin-bottom-medium u-margin-top-medium">
            <button class="btn-outline goto-dates" href="#dates">View Availability</button>
        </div>

    <?php } ?>


    <?php
    get_template_part('template-parts/content', 'product-prices-extra', $args);
    ?>
</div>