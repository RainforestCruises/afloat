<?php

$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];
$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];
$hasDeals = $args['hasDeals'];

$charter_view = false;
$charter_available = false;
$charter_only = false;
$display_fine_print = false;
if ($args['productType'] == 'Cruise') {
    $charter_view = $args['charter_view'];
    $charter_available = $args['charter_available'];
    $charter_only = $args['charter_only'];
    $display_fine_print = get_field('display_fine_print');
}

//total count of all itineraries
$totalCount = 0;
foreach ($cruise_data['Itineraries'] as $item) :

    if ($charter_only == true && $item['IsSample'] == false) :
        $totalCount++;
        continue;
    endif;

    if ($args['productType'] == 'Lodge' && $item['IsSample'] == false) :

        $totalCount++;
        continue; //skip non sample itineraries for charter only vessels
    endif;

    $totalCount++;
endforeach;
?>

<!-- Itineraries -->
<div class="product-itineraries">

    <h2 class="page-divider">
        Itineraries & Prices
    </h2>
    <p style="font-size: 12px; text-align: center">
        All itineraries are subject to change due to seasonal weather conditions (and resultant variations in river and tributary water levels) affecting accessibility to locations. Thus navigation routes, times and excursions may need to be modified at the cruise captain’s or your guide's discretion.
    </p>


    <!-- Itinerary Slider Nav -->
    <div class="product-itineraries__nav">
        <div class="product-itineraries__nav__counter" id="itineraries-slider-counter"><?php echo '1 / ' . $totalCount ?></div>

        <div class="product-itineraries__nav__slider" id="itineraries-slider-nav">
            <?php
            $count = 1;
            foreach ($cruise_data['Itineraries'] as $item) :

                if ($charter_only == true && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    continue;
                endif;

                if ($charter_view == true && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    continue;
                endif;

                if ($charter_view == false && $item['IsCharterOnly'] == true) :
                    //skip charter only itineraries
                    continue;
                endif;

                if ($args['productType'] == 'Lodge' && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    continue;
                endif;
            ?>
                <div class="product-itineraries__nav__slider__item">

                    <?php echo $item['LengthInDays'] ?>-Day
                    <?php
                    $TagText = $item['TagText'];
                    if ($TagText != null) : ?>
                        <span>
                            <?php echo $TagText ?>
                        </span>
                    <?php endif;
                    ?>
                </div>
            <?php
                $count++;
            endforeach; ?>

        </div>
    </div>


    <!-- Itinerary Slider Content -->
    <div class="product-itineraries__content">
        <div class="product-itineraries__content__slider" id="itineraries-slider">
            <?php
            $count = 1; //loop itineraries
            foreach ($cruise_data['Itineraries'] as $itinerary) :
                if ($charter_only == true && $itinerary['IsSample'] == false) :
                    continue; //skip non sample itineraries for charter only vessels
                endif;

                if ($charter_view == true && $itinerary['IsSample'] == false) :
                    //skip non sample itineraries
                    continue;
                endif;

                if ($charter_view == false && $itinerary['IsCharterOnly'] == true) :
                    //skip charter only itineraries
                    continue;
                endif;

                if ($args['productType'] == 'Lodge' && $itinerary['IsSample'] == false) :
                    continue; //skip non sample itineraries for lodges
                endif;

            ?>

                <!-- Itineraries Slide Item-->
                <div class="product-itinerary-slide">

                    <!-- Map / Side Info - Top Section -->
                    <div class="product-itinerary-slide__top">

                        <!-- Map Area -->
                        <div class="product-itinerary-slide__top__map-area">
                            <div class="product-itinerary-slide__top__map-area__title">
                                <h3 class="product-itinerary-slide__top__map-area__title__text">
                                    <?php echo $itinerary['LengthInDays'] ?> Day - <?php echo $itinerary['Name'] ?>
                                </h3>
                                <?php if ($charter_view && $charter_only) : ?>
                                    <div class="product-itinerary-slide__top__map-area__title__badge-area">
                                        <span>
                                            Sample Itinerary
                                        </span>
                                    </div>

                                <?php endif ?>
                            </div>

                            <!-- Map -->
                            <?php $itineraryImages = $itinerary['MapImageDTOs']; ?>
                            <a class="itinerary-map-image" href="<?php echo afloat_dfcloud_image($itineraryImages[0]['ImageUrl']); ?>" title="<?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night - <?php echo $itinerary['Name'] ?>">
                                <?php if ($itineraryImages) : ?>
                                    <img src="<?php echo afloat_dfcloud_image($itineraryImages[0]['ImageUrl']); ?>" alt="itinerary map">
                                <?php endif ?>
                            </a>
                            <?php if (get_field('getting_there') != null) : ?>
                                <button class="btn-outline btn-outline--dark  btn-outline--small getting-there-button">Getting There</button>
                            <?php endif; ?>

                        </div>

                        <!-- Side Info Area -->
                        <aside class="product-itinerary-slide__top__side-info">
                            <div class="product-itinerary-slide__top__side-info__tabs">
                                <h4 class="product-itinerary-slide__top__side-info__tabs__item current" itinerary-tab="<?php echo $count; ?>" tab-type="rates"> <?php echo ($args['productType'] == 'Lodge' || $charter_view == true) ? 'Rates' : 'Dates & Rates'; ?> </h4>
                                <h4 class="product-itinerary-slide__top__side-info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">Inclusions</h4>
                                <h4 class="product-itinerary-slide__top__side-info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">Exclusions</h4>
                            </div>

                            <!-- Dates and Rates -->
                            <div class="product-itinerary-slide__top__side-info__content current" itinerary-tab="<?php echo $count; ?>" tab-type="rates">
                                <div class="side-info-panel" itinerary-tab="<?php echo $count; ?>" tab-type="all">
                                    <!-- Dates -->
                                    <?php if (get_post_type() == 'rfc_cruises' && $charter_view == false) : ?>
                                        <div class="product-itinerary-slide__top__side-info__content__widget noborder">

                                            <?php if ($itinerary['IsOngoing'] == false) : ?>
                                                <div class="product-itinerary-slide__top__side-info__content__widget__top-section">
                                                    <!-- Title -->
                                                    <h5 class="product-itinerary-slide__top__side-info__content__widget__top-section__title">
                                                        Availability
                                                    </h5>
                                                    <!-- Select-Box -->
                                                    <div class="product-itinerary-slide__select-group">
                                                        <label>
                                                            Year:
                                                        </label>

                                                        <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
                                                            <?php foreach ($years as $year) { ?>
                                                                <option><?php echo $year ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Date-Grid  -->
                                                <?php $departureYears = $itinerary['DepartureYears']; ?>
                                                <?php foreach ($departureYears as $departureYear) { ?>

                                                    <ul class="date-grid date-grid__<?php echo $departureYear['Year'] ?>" data-tab="<?php echo $count; ?>">
                                                        <!-- Check if before current year / month, then display as available or sold out (HasDepartures)-->
                                                        <?php foreach ($departureYear['DepartureMonths'] as $departureMonth) { ?>
                                                            <?php if (($departureMonth['Month'] < $currentMonth) && ($departureYear['Year'] == $currentYear)) { ?>
                                                                <li class="date-grid__item" itinerary-id="<?php echo $itinerary['Id']; ?>" itinerary-tab="<?php echo $count; ?>" departure-year="<?php echo $departureYear['Year'] ?>" departure-month="<?php echo $departureMonth['Month'] ?>">
                                                                    <?php echo $departureMonth['MonthNameShort']; ?>
                                                                </li>
                                                            <?php } else { ?>
                                                                <?php if ($departureMonth['HasDepartures'] == false && $departureMonth['IsTBA'] == false) { ?>
                                                                    <li class="date-grid__item date-grid__item--sold-out " itinerary-id="<?php echo $itinerary['Id']; ?>" itinerary-tab="<?php echo $count; ?>" departure-year="<?php echo $departureYear['Year'] ?>" departure-month="<?php echo $departureMonth['Month'] ?>">
                                                                        <?php echo $departureMonth['MonthNameShort']; ?>
                                                                    </li>
                                                                <?php } else if ($departureMonth['HasDepartures'] == false && $departureMonth['IsTBA'] == true) { ?>
                                                                    <li class="date-grid__item date-grid__item--tba " itinerary-id="<?php echo $itinerary['Id']; ?>" itinerary-tab="<?php echo $count; ?>" departure-year="<?php echo $departureYear['Year'] ?>" departure-month="<?php echo $departureMonth['Month'] ?>">
                                                                        <?php echo $departureMonth['MonthNameShort']; ?>
                                                                        <span class="tooltiptext">Dates TBD</span>
                                                                    </li>
                                                                <?php } else { ?>
                                                                    <li class="date-grid__item date-grid__item--available <?php echo ($departureMonth['HasPromos'] == true ? "promo-date" : ""); ?>" itinerary-id="<?php echo $itinerary['Id']; ?>" itinerary-tab="<?php echo $count; ?>" departure-year="<?php echo $departureYear['Year'] ?>" departure-month="<?php echo $departureMonth['Month'] ?>">
                                                                        <?php echo $departureMonth['MonthNameShort']; ?>

                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>


                                                <?php } ?>
                                                <div class="product-itinerary-slide__top__side-info__content__widget__legend">
                                                    <div class="product-itinerary-slide__top__side-info__content__widget__legend__fine-print">
                                                        Select month to view departures
                                                    </div>

                                                    <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors">

                                                        <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors__item product-itinerary-slide__top__side-info__content__widget__legend__colors__item--promo ">
                                                            Deal
                                                        </div>
                                                        <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors__item product-itinerary-slide__top__side-info__content__widget__legend__colors__item--available ">
                                                            Available
                                                        </div>
                                                        <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors__item product-itinerary-slide__top__side-info__content__widget__legend__colors__item--sold-out">
                                                            Sold Out
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?> <!-- Rolling Departures -->
                                                <div class="product-itinerary-slide__top__side-info__content__widget__top-section">
                                                    <!-- Title -->
                                                    <h5 class="product-itinerary-slide__top__side-info__content__widget__top-section__title">
                                                        Availability
                                                    </h5>

                                                </div>
                                                <!-- Rolling Departures Note -->
                                                <div style="font-size: 1.6rem">
                                                    <?php echo get_field('rolling_departures_note', 'options') ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($hasDeals == true) : ?>
                                                <div class="product-itinerary-slide__top__side-info__content__widget__deals-button">
                                                    <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                                        View Deals
                                                    </button>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    <?php endif; ?>

                                    <!-- Prices -->
                                    <?php if ($charter_view == false) :
                                        $rateYears = $itinerary['RateYears'];
                                        $display_policies = get_field('display_policies');
                                        $display_special_note = get_field('display_special_note');
                                    ?>
                                        <div class="product-itinerary-slide__top__side-info__content__widget" style="margin-bottom: 0rem;">
                                            <div class="product-itinerary-slide__top__side-info__content__widget__top-section">
                                                <h5 class="product-itinerary-slide__top__side-info__content__widget__top-section__title">
                                                    Prices (USD)

                                                    <?php if ($display_policies || $display_special_note) : ?>
                                                        <svg class="price-notes">
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-info-circle">
                                                            </use>
                                                        </svg>
                                                    <?php endif; ?>
                                                </h5>

                                                <?php if (get_post_type() == 'rfc_lodges') : ?>
                                                    <!-- Select-Box Years-->
                                                    <div class="product-itinerary-slide__select-group">
                                                        <label>
                                                            Year:
                                                        </label>
                                                        <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
                                                            <?php foreach ($years as $year) { ?>
                                                                <option><?php echo $year ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                <?php endif; ?>

                                                <?php
                                                $hasHighSeason =  $rateYears[0]['HasHighSeason']; //just check first rate year for all seasons -- only defines what goes in dropdown
                                                $hasLowSeason =  $rateYears[0]['HasLowSeason'];
                                                if ($hasHighSeason || $hasLowSeason) : ?>
                                                    <!-- Select-Box Season -->
                                                    <div class="product-itinerary-slide__select-group">
                                                        <label>
                                                            Season:
                                                        </label>
                                                        <select class="season-select" itinerary-tab="<?php echo $count; ?>">
                                                            <option value="regular">Regular</option>
                                                            <?php if ($hasHighSeason) : ?>
                                                                <option value="high">High</option>
                                                            <?php endif; ?>
                                                            <?php if ($hasLowSeason) : ?>
                                                                <option value="low">Low</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                            <!-- Price-Grid  -->

                                            <?php foreach ($rateYears as $rateYear) :
                                                $panelHasRates = count($rateYear['Rates']) > 0 ? true : false;
                                            ?>


                                                <div class="price-grid price-grid__<?php echo $rateYear['Year'] ?>" data-tab="<?php echo $count; ?>">
                                                    <!-- Regular Season -->
                                                    <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="regular">

                                                        <div class="price-grid__grid">

                                                            <div class="price-grid__grid__title">
                                                                <div class="price-grid__grid__title__text">
                                                                    <?php echo ($args['productType'] == 'Lodge') ? 'Room' : 'Cabin'; ?> Type
                                                                </div>
                                                            </div>
                                                            <div class="price-grid__grid__title right">
                                                                <div class="price-grid__grid__title__text">
                                                                    Double
                                                                </div>
                                                            </div>
                                                            <div class="price-grid__grid__title right">
                                                                <div class="price-grid__grid__title__text">
                                                                    Single
                                                                </div>
                                                            </div>


                                                            <?php if ($panelHasRates) : ?>

                                                                <?php foreach ($rateYear['Rates'] as $rate) : ?>
                                                                    <div class="price-grid__grid__cabin-type">
                                                                        <?php echo  $rate['Cabin'] ?>
                                                                    </div>
                                                                    <?php if ($rate['IsSingle'] == false) : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            <?php echo priceFormat($rate['WebAmount']); ?>
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['SingleWebAmount']); ?>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            N/A
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['WebAmount']); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>

                                                            <?php else : ?>
                                                                <div class="price-grid__grid__cabin-type">
                                                                    Contact for <?php echo  $rateYear['Year'] ?> prices
                                                                </div>
                                                                <div class="price-grid__grid__double-price">
                                                                    TBD
                                                                </div>
                                                                <div class="price-grid__grid__single-price">
                                                                    TBD
                                                                </div>
                                                            <?php endif; ?>



                                                        </div>
                                                        <?php
                                                        if (array_key_exists("RegularSeasonText", $rateYear)) :
                                                            if ($rateYear['RegularSeasonText'] != null) : ?>
                                                                <div class="season-panel__range-text">
                                                                    Regular Season: <?php echo $rateYear['RegularSeasonText']; ?>
                                                                </div>
                                                        <?php endif;
                                                        endif; ?>
                                                    </div>

                                                    <!-- High Season -->
                                                    <?php if ($rateYear['HasHighSeason'] == true) : ?>
                                                        <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="high" style="display: none;">

                                                            <div class="price-grid__grid">
                                                                <div class="price-grid__grid__title">
                                                                    <div class="price-grid__grid__title__text">
                                                                        <?php echo ($args['productType'] == 'Lodge') ? 'Room' : 'Cabin'; ?> Type
                                                                    </div>
                                                                </div>
                                                                <div class="price-grid__grid__title right">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Double
                                                                    </div>
                                                                </div>
                                                                <div class="price-grid__grid__title right">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Single
                                                                    </div>
                                                                </div>

                                                                <?php $rateYears = $itinerary['RateYears']; ?>
                                                                <?php foreach ($rateYear['Rates'] as $rate) : ?>
                                                                    <div class="price-grid__grid__cabin-type">
                                                                        <?php echo  $rate['Cabin'] ?>
                                                                    </div>
                                                                    <?php if ($rate['IsSingle'] == false) : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            <?php echo priceFormat($rate['HighSeasonWeb']); ?>
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['SingleHighSeasonWeb']); ?>
                                                                        </div>
                                                                    <?php
                                                                    //if single cabin
                                                                    else : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            N/A
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['HighSeasonWeb']); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>

                                                            </div>
                                                            <?php
                                                            if (array_key_exists("HighSeasonText", $rateYear)) :
                                                                if ($rateYear['HighSeasonText'] != null) : ?>
                                                                    <div class="season-panel__range-text">
                                                                        High Season: <?php echo $rateYear['HighSeasonText']; ?>
                                                                    </div>
                                                            <?php endif;
                                                            endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Low Season -->
                                                    <?php if ($rateYear['HasLowSeason'] == true) : ?>
                                                        <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="low" style="display: none;">

                                                            <div class="price-grid__grid">

                                                                <div class="price-grid__grid__title">
                                                                    <div class="price-grid__grid__title__text">
                                                                        <?php echo ($args['productType'] == 'Lodge') ? 'Room' : 'Cabin'; ?> Type
                                                                    </div>
                                                                </div>
                                                                <div class="price-grid__grid__title right">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Double
                                                                    </div>
                                                                </div>
                                                                <div class="price-grid__grid__title right">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Single
                                                                    </div>
                                                                </div>

                                                                <?php $rateYears = $itinerary['RateYears']; ?>
                                                                <?php foreach ($rateYear['Rates'] as $rate) : ?>
                                                                    <div class="price-grid__grid__cabin-type">
                                                                        <?php echo  $rate['Cabin'] ?>
                                                                    </div>
                                                                    <?php if ($rate['IsSingle'] == false) : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            <?php echo priceFormat($rate['LowSeasonWeb']); ?>
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['SingleLowSeasonWeb']); ?>
                                                                        </div>
                                                                    <?php
                                                                    //if single cabin
                                                                    else : ?>
                                                                        <div class="price-grid__grid__double-price">
                                                                            N/A
                                                                        </div>
                                                                        <div class="price-grid__grid__single-price">
                                                                            <?php echo priceFormat($rate['LowSeasonWeb']); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>

                                                            </div>
                                                            <?php
                                                            if (array_key_exists("LowSeasonText", $rateYear)) :
                                                                if ($rateYear['LowSeasonText'] != null) : ?>
                                                                    <div class="season-panel__range-text">
                                                                        Low Season: <?php echo $rateYear['LowSeasonText']; ?>
                                                                    </div>
                                                            <?php endif;
                                                            endif; ?>
                                                        </div>
                                                    <?php endif; ?>


                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                        <?php if ($display_fine_print) : ?>
                                            <div class="product-itinerary-slide__top__side-info__content__fine-print">
                                                <?php echo removePtags(get_field('fine_print_content')); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($charter_available) : ?>
                                            <div class="product-itinerary-slide__top__side-info__content__fine-print">
                                                Exclusive, private charters of <?php echo get_the_title(); ?> are also available. <a href="<?php echo get_permalink() . '?charter=true' ?>">Click here for details</a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (get_post_type() == 'rfc_lodges') : ?>
                                            <?php if ($hasDeals == true) : ?>
                                                <div class="product-itinerary-slide__top__side-info__content__widget__deals-button u-margin-bottom-medium">
                                                    <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                                        View Deals
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-itinerary-slide__top__side-info__content__widget">
                                                <div class="charter-info-snippet">
                                                    <?php
                                                    if (strip_tags($itinerary['Summary']) != '') {
                                                        echo $itinerary['Summary'];
                                                    } else {
                                                        echo get_field('itinerary_snippet');
                                                    }

                                                    ?>
                                                    <p>
                                                        <?php echo get_field('lodge_note', 'options'); ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="product-itinerary-slide__top__side-info__content__fine-print">
                                                Availability on request
                                            </div>
                                        <?php endif; ?>
                                    <?php else : //charter
                                        $vessel_capacity = get_field('vessel_capacity');
                                        $number_of_cabins = get_field('number_of_cabins');
                                        $display_charter_policies = get_field('display_charter_policies');
                                        $charter_daily_price = get_field('charter_daily_price');
                                        $charter_snippet = get_field('charter_snippet');
                                        $charter_display_full_price = get_field('charter_display_full_price');

                                        $price_per_person = 0;
                                        if ($charter_daily_price > 0) {
                                            $price_per_person = $charter_daily_price / $vessel_capacity;
                                        }

                                        $nights = $itinerary['LengthInNights'];
                                        $price = $nights * $price_per_person;

                                    ?>

                                        <!-- Info -->
                                        <div class="charter-pricing">
                                            <div class="charter-pricing__overall">
                                                <div class="charter-pricing__overall__info-group">
                                                    <div class="charter-pricing__overall__info-group__title">
                                                        <?php echo $itinerary['LengthInDays']  ?>-Day Total (USD)
                                                        <?php if ($display_charter_policies) : ?>
                                                            <svg class="price-notes">
                                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-info-circle">
                                                                </use>
                                                            </svg>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__data">
                                                        <?php
                                                        if (array_key_exists("CharterAmount", $itinerary)) {
                                                            echo "$ " . number_format($itinerary['LengthInDays'] * $itinerary['CharterAmount'], 0);
                                                        } else {
                                                            echo 'TBA'; //not updated from DF
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__title" style="margin-top: 2rem;">
                                                        Price Per Day

                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__data">
                                                        <?php

                                                        if (array_key_exists("CharterAmount", $itinerary)) {
                                                            echo "$ " . number_format($itinerary['CharterAmount'], 0);
                                                        } else {
                                                            echo 'TBA'; //not updated from DF
                                                        }
                                                        ?>

                                                        <div>
                                                            <?php echo Date('Y'); ?> Price
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="charter-pricing__overall__info-group">
                                                    <div class="charter-pricing__overall__info-group__title">
                                                        Vessel Capacity
                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__data">
                                                        <?php echo $vessel_capacity ?> Guests
                                                        <div>
                                                            <?php echo $number_of_cabins ?> Cabins
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php if ($hasDeals == true) : ?>
                                            <div class="product-itinerary-slide__top__side-info__content__widget__deals-button" style="transform: translateY(-2rem);">
                                                <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                                    View Deals
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                        <!-- SNIPPET -->
                                        <div class="product-itinerary-slide__top__side-info__content__widget" style="margin-bottom: 0rem">

                                            <div class="charter-info-snippet">
                                                <?php
                                                if (array_key_exists("CharterSnippet", $itinerary)) {
                                                    if (strip_tags($itinerary['CharterSnippet']) != '') {
                                                        echo $itinerary['CharterSnippet'];
                                                    } else {
                                                        echo $charter_snippet;
                                                    }
                                                } else {
                                                    echo $charter_snippet;
                                                }

                                                ?>

                                                <p>
                                                    <?php echo get_field('charter_note', 'options'); ?>
                                                </p>

                                            </div>
                                        </div>
                                        <?php if (!$charter_only) : ?>
                                            <div class="product-itinerary-slide__top__side-info__content__fine-print">
                                                Shared, small group cruises on <?php echo get_the_title(); ?> are also available. <a href="<?php echo get_permalink() ?>">Click here for details.</a>
                                            </div>
                                        <?php endif; ?>


                                    <?php endif; ?>
                                </div>

                                <!-- Departures -->
                                <div class="side-info-panel" itinerary-tab="<?php echo $count; ?>" tab-type="dates" style="display: none;">
                                    <div class="side-info-panel__top">
                                        <div class="side-info-panel__top__month">
                                            Availability
                                        </div>
                                        <button class="side-info-panel__top__close-button close-button">

                                        </button>
                                    </div>

                                    <div class="side-info-panel__departure-grid">

                                    </div>

                                </div>

                            </div>

                            <!-- Inclusions -->
                            <div class="product-itinerary-slide__top__side-info__content" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">
                                <h5 class="product-itinerary-slide__top__side-info__content__inclusions-title">What's Included</h5>
                                <ul class="product-itinerary-slide__top__side-info__content__inclusions-list">
                                    <?php foreach ($itinerary['Inclusions'] as $inclusion) : ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $inclusion['Description'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Exclusions -->
                            <div class="product-itinerary-slide__top__side-info__content" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">
                                <h5 class="product-itinerary-slide__top__side-info__content__inclusions-title">What's Excluded</h5>
                                <ul class="product-itinerary-slide__top__side-info__content__inclusions-list">

                                    <?php foreach ($itinerary['Exclusions'] as $exclusion) : ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $exclusion['Description'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </aside>
                    </div>

                    <!-- D2D - Bottom Section -->
                    <div class="product-itinerary-slide__bottom">

                        <!-- Slider -->
                        <div class="product-itinerary-slide__bottom__days" id="slider-bottom-days-<?php echo $count ?>">

                            <?php
                            $days = $itinerary['ItineraryDays'];
                            $dayImages = $itinerary['DayImageDTOs'];
                            $dayCount = 1;


                            if ($days) :
                                $dayNumber = array_column($days, 'DayNumber');
                                array_multisort($dayNumber, SORT_ASC, $days);


                                foreach ($days as $day) : ?>
                                    <?php
                                    $img = null;
                                    foreach ($dayImages as $dayImage) {
                                        if ($dayCount == $dayImage['DayNumber']) {
                                            $img = $dayImage;
                                            break;
                                        }
                                    }
                                    ?>

                                    <!-- Day Slide -->
                                    <div class="product-itinerary-slide__bottom__days__item">

                                        <!-- Content -->
                                        <div class="product-itinerary-slide__bottom__days__item__content">
                                            <h4 class="product-itinerary-slide__bottom__days__item__content__title">
                                                <?php echo $day['Title']; ?>
                                            </h4>
                                            <div class="product-itinerary-slide__bottom__days__item__content__text">
                                                <?php echo $day['Excerpt'] ?>
                                            </div>
                                        </div>

                                        <!-- Side / Image -->
                                        <div class="product-itinerary-slide__bottom__days__item__side">
                                            <div class="product-itinerary-slide__bottom__days__item__side__image-area">
                                                <?php if ($img != null) : ?>
                                                    <img src="<?php echo afloat_dfcloud_image($img['ImageUrl']); ?>" alt="<?php echo $img['AltText'] ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="product-itinerary-slide__bottom__days__item__side__detail">
                                                <div class="product-itinerary-slide__bottom__days__item__side__detail__item">
                                                    <div class="product-itinerary-slide__bottom__days__item__side__detail__item__title">
                                                        Location
                                                    </div>
                                                    <div class="product-itinerary-slide__bottom__days__item__side__detail__item__data">
                                                        <?php echo $day['Location']; ?>
                                                    </div>
                                                </div>
                                                <div class="product-itinerary-slide__bottom__days__item__side__detail__item">
                                                    <div class="product-itinerary-slide__bottom__days__item__side__detail__item__title">
                                                        Day
                                                    </div>
                                                    <div class="product-itinerary-slide__bottom__days__item__side__detail__item__data">
                                                        <span><?php echo $day['DayNumber']; ?></span> / <?php echo $itinerary['LengthInDays']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                            <?php
                                    $dayCount++;
                                endforeach;
                            endif; ?>
                        </div>
                        <span class="product-itinerary-slide__bottom__counter">1 / <?php echo ($dayCount - 1); ?></span>

                    </div>
                </div>
            <?php $count++;
            endforeach; ?>
        </div>
    </div>

</div>