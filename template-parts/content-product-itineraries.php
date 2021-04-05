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
        <div class="product-itineraries__nav__counter" id="itineraries-slider-counter">Itinerary: <?php echo '1 / ' . $totalCount ?></div>

        <div class="product-itineraries__nav__slider" id="itineraries-slider-nav">
            <?php
            $count = 1;
            foreach ($cruise_data['Itineraries'] as $item) :

                if ($charter_only == true && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    $count++;
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
                    $count++;
                    continue; //skip non sample itineraries for charter only vessels
                endif;
            ?>

                <!-- Itineraries Slide Item-->
                <div class="product-itinerary-slide">

                    <!-- Map / Side Info - Top Section -->
                    <div class="product-itinerary-slide__top">

                        <!-- Map Area -->
                        <div class="product-itinerary-slide__top__map-area">
                            <div class="product-itinerary-slide__top__map-area__title">
                                <?php echo $itinerary['Name'] ?> - <?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night
                            </div>
                            <!-- Map -->
                            <?php $itineraryImages = $itinerary['MapImageDTOs']; ?>
                            <a class="" id="itinerary-map-image" href="<?php echo $itineraryImages[0]['ImageUrl']; ?>" title="<?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night - <?php echo $itinerary['Name'] ?>">
                                <?php if ($itineraryImages) : ?>
                                    <img src="<?php echo $itineraryImages[0]['ImageUrl']; ?>" alt="">

                                <?php endif ?>
                            </a>
                        </div>

                        <!-- Side Info Area -->
                        <div class="product-itinerary-slide__top__info">
                            <div class="product-itinerary-slide__top__info__tabs">
                                <div class="product-itinerary-slide__top__info__tabs__item current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">Overview</div>
                                <div class="product-itinerary-slide__top__info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">Inclusions</div>
                                <div class="product-itinerary-slide__top__info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">Exclusions</div>
                            </div>

                            <!-- Overview-->
                            <div class="product-itinerary-slide__top__info__content current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">

                                <!-- Dates -->
                                <?php if (get_post_type() == 'rfc_cruises' && $charter_view == false) : ?>
                                    <div class="product-itinerary-slide__top__info__content__widget">
                                        <div class="product-itinerary-slide__top__info__content__widget__top-section">
                                            <!-- Title -->
                                            <h4 class="product-itinerary-slide__top__info__content__widget__top-section__title">
                                                Availability
                                            </h4>
                                            <!-- Select-Box -->
                                            <div class="itinerary-year-select-group">
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
                                                        <li class="date-grid__item">
                                                            <?php echo $departureMonth['MonthNameShort']; ?>
                                                        </li>
                                                    <?php } else { ?>
                                                        <?php if ($departureMonth['HasDepartures'] == false) { ?>
                                                            <li class="date-grid__item date-grid__item--sold-out">
                                                                <?php echo $departureMonth['MonthNameShort']; ?>
                                                            </li>
                                                        <?php } else { ?>
                                                            <li class="date-grid__item date-grid__item--available">
                                                                <?php echo $departureMonth['MonthNameShort']; ?>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                        <div class="product-itinerary-slide__top__info__content__widget__legend">
                                            <div class="product-itinerary-slide__top__info__content__widget__legend__item product-itinerary-slide__top__info__content__widget__legend__item--available">
                                                Available
                                            </div>
                                            <div class="product-itinerary-slide__top__info__content__widget__legend__item product-itinerary-slide__top__info__content__widget__legend__item--sold-out">
                                                Sold Out
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Prices -->
                                <?php if ($charter_view == false) : ?>
                                    <div class="product-itinerary-slide__top__info__content__widget">
                                        <div class="product-itinerary-slide__top__info__content__widget__top-section">
                                            <h4 class="product-itinerary-slide__top__info__content__widget__top-section__title">
                                                Prices
                                            </h4>
                                            <?php if (get_post_type() == 'rfc_lodges') { ?>
                                                <?php $yearCount = 0; ?>
                                                <!-- Select-Box -->
                                                <div class="itinerary-year-select-group">
                                                    <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
                                                        <?php while ($yearCount <= 1) { ?>
                                                            <option><?php echo ($currentYear + $yearCount) ?></option>
                                                        <?php $yearCount++;
                                                        } ?>
                                                    </select>
                                                </div>

                                            <?php } ?>
                                        </div>
                                        <!-- Price-Grid  -->
                                        <?php $rateYears = $itinerary['RateYears']; ?>
                                        <?php foreach ($rateYears as $rateYear) : ?>
                                            <div class="price-grid price-grid__<?php echo $rateYear['Year'] ?>" data-tab="<?php echo $count; ?>">
                                                <div class="price-grid__header">
                                                    <div class="price-grid__header__title">
                                                        Accommodation Level
                                                    </div>
                                                    <div class="price-grid__header__details">
                                                        <div class="price-grid__header__details__item">
                                                            Double
                                                        </div>
                                                        <!-- Add single -->
                                                    </div>
                                                </div>
                                                <?php $rateYears = $itinerary['RateYears']; ?>
                                                <?php foreach ($rateYear['Rates'] as $rate) : ?>



                                                    <div class="price-grid__row">
                                                        <div class="price-grid__row__title">
                                                            <?php echo  $rate['Cabin'] ?>
                                                        </div>
                                                        <div class="price-grid__row__details">
                                                            <div class="price-grid__row__details__item">
                                                                <?php echo "$ " . number_format($rate['WebAmount'], 0);  ?>
                                                            </div>
                                                            <!-- Add single -->
                                                        </div>

                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                <?php else : ?>
                                    <div class="product-itinerary-slide__top__info__content__widget">
                                        <div class="charter-info-box">
                                            This itinerary is only a sample. Charter itineraries are completely customizable. Speak with one of our travel specialists for details and charter availability.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Inclusions -->
                            <div class="product-itinerary-slide__top__info__content" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">
                                <h4>What's Incuded</h4>
                                <ul class="product-itinerary-slide__top__info__content__inclusions-list">
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
                            <div class="product-itinerary-slide__top__info__content" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">
                                <h4>What's Excluded</h4>
                                <ul class="product-itinerary-slide__top__info__content__inclusions-list">

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
                                            <div class="product-itinerary-slide__bottom__days__item__content__title">
                                                <?php echo $day['Title']; ?>
                                            </div>
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