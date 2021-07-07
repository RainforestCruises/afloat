<?php

$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];
console_log($cruise_data);
$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

// if(get_post_type() == 'rfc_cruises') {
//     $charter_min_days = $args['charter_min_days'];

// }

$charter_view = false;
$charter_only = false;


if ($args['propertyType'] == 'Cruise') {
    if ($args['charter_view'] == true) {
        $charter_view = true;
    }

    if ($args['charter_only'] == true) {
        $charter_only = true;
    }
}
?>






<?php //total count of all itineraries
$totalCount = 0;
foreach ($cruise_data['Itineraries'] as $item) :
    if ($charter_only == true && $item['IsSample'] == false) :
        $totalCount++;
        continue;
    endif;

    if ($args['propertyType'] == 'Lodge' && $item['IsSample'] == false) :

        $totalCount++;
        continue; //skip non sample itineraries for charter only vessels
    endif;

    $totalCount++;
endforeach;
?>

<!-- Itineraries -->
<div class="product-itineraries">

    <h2 class="page-divider">
        Itineraries
    </h2>



    <!-- Itinerary Slider Nav -->
    <div class="product-itineraries__nav">
        <div class="product-itineraries__nav__counter" id="itineraries-slider-counter"><?php echo '1 / ' . $totalCount ?></div>

        <div class="product-itineraries__nav__slider" id="itineraries-slider-nav">
            <?php
            $count = 1;
            foreach ($cruise_data['Itineraries'] as $item) :

                if ($charter_only == true && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    //$count++;
                    continue;
                endif;

                if ($args['propertyType'] == 'Lodge' && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    //$count++;
                    continue;
                endif;
            ?>
                <div class="product-itineraries__nav__slider__item">
                    <?php echo $item['LengthInDays'] ?>-Day
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

                if ($args['propertyType'] == 'Lodge' && $itinerary['IsSample'] == false) :
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
                                    <?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night - <?php echo $itinerary['Name'] ?>
                                </h3>

                            </div>

                            <!-- Map -->
                            <?php $itineraryImages = $itinerary['MapImageDTOs']; ?>
                            <a class="itinerary-map-image" href="<?php echo $itineraryImages[0]['ImageUrl']; ?>" title="<?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night - <?php echo $itinerary['Name'] ?>">
                                <?php if ($itineraryImages) : ?>
                                    <img src="<?php echo $itineraryImages[0]['ImageUrl']; ?>" alt="">

                                <?php endif ?>
                            </a>
                        </div>

                        <!-- Side Info Area -->
                        <div class="product-itinerary-slide__top__side-info">
                            <div class="product-itinerary-slide__top__side-info__tabs">
                                <div class="product-itinerary-slide__top__side-info__tabs__item current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">Overview</div>
                                <div class="product-itinerary-slide__top__side-info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">Inclusions</div>
                                <div class="product-itinerary-slide__top__side-info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">Exclusions</div>
                            </div>

                            <!-- Overview-->
                            <div class="product-itinerary-slide__top__side-info__content current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">
                                <div class="side-info-panel" itinerary-tab="<?php echo $count; ?>" tab-type="all">
                                    <!-- Dates -->
                                    <?php if (get_post_type() == 'rfc_cruises' && $charter_view == false) : ?>
                                        <div class="product-itinerary-slide__top__side-info__content__widget noborder">
                                            <div class="product-itinerary-slide__top__side-info__content__widget__top-section">
                                                <!-- Title -->
                                                <h4 class="product-itinerary-slide__top__side-info__content__widget__top-section__title">
                                                    Availability
                                                </h4>
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
                                                            <?php if ($departureMonth['HasDepartures'] == false) { ?>
                                                                <li class="date-grid__item date-grid__item--sold-out " itinerary-id="<?php echo $itinerary['Id']; ?>" itinerary-tab="<?php echo $count; ?>" departure-year="<?php echo $departureYear['Year'] ?>" departure-month="<?php echo $departureMonth['Month'] ?>">
                                                                    <?php echo $departureMonth['MonthNameShort']; ?>
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
                                                        Promo
                                                    </div>
                                                    <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors__item product-itinerary-slide__top__side-info__content__widget__legend__colors__item--available ">
                                                        Available
                                                    </div>
                                                    <div class="product-itinerary-slide__top__side-info__content__widget__legend__colors__item product-itinerary-slide__top__side-info__content__widget__legend__colors__item--sold-out">
                                                        Sold Out
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Prices -->
                                    <?php if ($charter_view == false) :
                                        $rateYears = $itinerary['RateYears'];
                                        $display_policies = get_field('display_policies');
                                        $display_special_note = get_field('display_special_note');
                                    ?>
                                        <div class="product-itinerary-slide__top__side-info__content__widget">
                                            <div class="product-itinerary-slide__top__side-info__content__widget__top-section">
                                                <h4 class="product-itinerary-slide__top__side-info__content__widget__top-section__title">
                                                    Prices

                                                    <?php if ($display_policies || $display_special_note) : ?>
                                                        <svg class="price-notes">
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-info-circle">
                                                            </use>
                                                        </svg>
                                                    <?php endif; ?>
                                                </h4>

                                                <!-- Select-Box -->
                                                <div class="product-itinerary-slide__select-group">


                                                    <?php
                                                    //just check first rate year for all seasons -- only defines what goes in dropdown
                                                    $hasHighSeason =  $rateYears[0]['HasHighSeason'];
                                                    $hasLowSeason =  $rateYears[0]['HasLowSeason'];
                                                    $hasSeasons = false;
                                                    if ($hasHighSeason || $hasLowSeason) {
                                                        $hasSeasons = true;
                                                    }
                                                    ?>

                                                    <?php if ($hasSeasons) : ?>
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
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- Price-Grid  -->

                                            <?php foreach ($rateYears as $rateYear) : ?>

                                                <div class="price-grid price-grid__<?php echo $rateYear['Year'] ?>" data-tab="<?php echo $count; ?>">


                                                    <!-- Regular Season -->
                                                    <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="regular">

                                                        <div class="price-grid__grid">

                                                            <div class="price-grid__grid__title">
                                                                <div class="price-grid__grid__title__text">
                                                                    Cabin Type
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
                                                                        <?php echo priceFormat($rate['WebAmount']); ?>
                                                                    </div>
                                                                    <div class="price-grid__grid__single-price">
                                                                        <?php echo priceFormat($rate['SingleWebAmount']); ?>
                                                                    </div>
                                                                <?php
                                                                //if single cabin
                                                                else : ?>
                                                                    <div class="price-grid__grid__double-price">
                                                                        N/A
                                                                    </div>
                                                                    <div class="price-grid__grid__single-price">
                                                                        <?php echo priceFormat($rate['WebAmount']); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>

                                                        </div>
                                                    </div>

                                                    <!-- High Season -->
                                                    <?php if ($rateYear['HasHighSeason'] == true) : ?>
                                                        <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="high" style="display: none;">

                                                            <div class="price-grid__grid">
                                                                <div class="price-grid__grid__title">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Cabin Type
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
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Low Season -->
                                                    <?php if ($rateYear['HasLowSeason'] == true) : ?>
                                                        <div class="season-panel" itinerary-tab="<?php echo $count; ?>" data-tab="low" style="display: none;">

                                                            <div class="price-grid__grid">

                                                                <div class="price-grid__grid__title">
                                                                    <div class="price-grid__grid__title__text">
                                                                        Cabin Type
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
                                                        </div>
                                                    <?php endif; ?>


                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                        <?php if (get_post_type() == 'rfc_lodges') : ?>
                                            <div class="product-itinerary-slide__top__side-info__content__widget">
                                                <div class="charter-info-snippet">
                                                    <?php echo get_field('itinerary_snippet'); ?>
                                                    <p>
                                                        <?php echo get_field('lodge_note', 'options'); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="product-itinerary-slide__top__side-info__content__fine-print">
                                                Availability on request
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php //charter
                                        $vessel_capacity = get_field('vessel_capacity');
                                        $number_of_cabins = get_field('number_of_cabins');
                                        $display_charter_policies = get_field('display_policies');
                                        $charter_daily_price = get_field('charter_daily_price');
                                        $charter_snippet = get_field('charter_snippet');

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
                                                        Vessel Capacity
                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__data">
                                                        <?php echo $vessel_capacity ?> Guests
                                                        <div>
                                                            <?php echo $number_of_cabins ?> Cabins
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="charter-pricing__overall__info-group">
                                                    <div class="charter-pricing__overall__info-group__title">
                                                        Price Per Day
                                                        <?php if ($display_charter_policies) : ?>
                                                            <svg class="price-notes">
                                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-info-circle">
                                                                </use>
                                                            </svg>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="charter-pricing__overall__info-group__data">
                                                        <?php echo "$ " . number_format($charter_daily_price, 0);  ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SNIPPET -->
                                        <div class="product-itinerary-slide__top__side-info__content__widget" style="margin-bottom: 0rem">
                                            <div class="charter-info-snippet">
                                                <?php echo $charter_snippet ?>
                                                <p>
                                                    <?php echo get_field('charter_note', 'options'); ?>
                                                </p>

                                            </div>
                                        </div>

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
                                <h4 class="product-itinerary-slide__top__side-info__content__inclusions-title">What's Incuded</h4>
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
                                <h4 class="product-itinerary-slide__top__side-info__content__inclusions-title">What's Excluded</h4>
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

                        </div>
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
                                usort($days, "sortDays");
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

                                                    <img src="<?php echo $img['ImageUrl'] ?>" alt="<?php echo $img['AltText'] ?>">
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





<!-- Sort by Day Number -->
<?php
function sortDays($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($a->DayNumber, $b->DayNumber);
    }
}
?>