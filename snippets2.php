<!-- TAB CONTENT -->
<!-- Itineraries -->
<?php
$count = 1;
foreach ($cruise_data['Itineraries'] as $itinerary) :

    if ($charter_only == true && $itinerary['IsSample'] == false) :
        //skip non sample itineraries
        $count++;
        continue;
    endif;
?>
    <!-- Itinerary -->
    <div class="product-itineraries__itinerary  tab-content <?php echo ($count == 1 ? 'current' : ''); ?>" id="tab-itinerary-<?php echo $count ?>">
        <div class="product-itineraries__itinerary__title">
            <h2 class="sub-divider product-itineraries__itinerary__title__main">
                <?php echo $itinerary['Name'] ?>
            </h2>
            <h3 class="product-itineraries__itinerary__title__subtitle">
                <?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night
            </h3>
        </div>




        <!-- D2D -->
        <div class="product-itineraries__itinerary__d2d">
            <h3 class="heading-3">
                <?php echo $args['propertyType'] ?> Itinerary
            </h3>
            <!-- Days  -->
            <!-- First Day style set inline for slide toggle to function correctly -->

            <div class="product-itineraries__itinerary__d2d__days">
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
                        <!-- Day -->
                        <div class="product-itineraries__itinerary__d2d__days__day <?php echo $dayCount == 1 ? 'product-itineraries__itinerary__d2d__days__day--active' : ''; ?> ">

                            <?php if ($img != null) { ?>
                                <div class="product-itineraries__itinerary__d2d__days__day__image-content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                    <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges">
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__count-badge">
                                            <span>Day <?php echo $day['DayNumber']; ?></span> / <?php echo $itinerary['LengthInDays']; ?>
                                        </div>
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__location-badge">
                                            <?php echo $day['Location']; ?>
                                        </div>
                                    </div>

                                    <?php echo '<img src="' . $img['ImageUrl'] . '" alt="' . $img['AltText'] . '" class="product-itineraries__itinerary__d2d__days__day__image-content__img">'; ?>
                                </div>
                            <?php } ?>
                            <div class="product-itineraries__itinerary__d2d__days__day__count">
                                <span>Day <?php echo $day['DayNumber']; ?></span> / <?php echo $itinerary['LengthInDays']; ?>
                            </div>
                            <h5 class="product-itineraries__itinerary__d2d__days__day__header">
                                <?php echo $day['Title']; ?>
                            </h5>
                            <div class="product-itineraries__itinerary__d2d__days__day__snippet" <?php echo $dayCount == 1 ? 'style="display: none;"' : ''; ?>>
                                <p>
                                    <?php
                                    echo substr(strip_tags($day['Excerpt']), 0, 160);
                                    ?>...
                                </p>
                            </div>
                            <div class="product-itineraries__itinerary__d2d__days__day__content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                <?php echo $day['Excerpt'] ?>
                            </div>
                            <button class="btn-expand btn-expand--down product-itineraries__itinerary__d2d__days__day__button">
                                <svg class="btn-expand--arrow-main">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                                <svg class="btn-expand--arrow-animate">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                            </button>
                        </div>
                <?php
                        $dayCount++;
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <aside class="product-itineraries__itinerary__side-content">
            <!-- Details - Availability / Prices -->
            <div class="product-itineraries__itinerary__side-content__detail">


                <?php if (get_post_type() == 'rfc_cruises' && $charter_view == false) { ?>
                    <!-- Dates -->
                    <div class="product-itineraries__itinerary__side-content__detail__widget">
                        <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                            <!-- Title -->
                            <h4 class="heading-4">
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
                        <div class="product-itineraries__itinerary__side-content__detail__widget__legend">
                            <div class="product-itineraries__itinerary__side-content__detail__widget__legend__item product-itineraries__itinerary__side-content__detail__widget__legend__item--available">
                                Available
                            </div>
                            <div class="product-itineraries__itinerary__side-content__detail__widget__legend__item product-itineraries__itinerary__side-content__detail__widget__legend__item--sold-out">
                                Sold Out
                            </div>
                            <button class="product-itineraries__itinerary__side-content__detail__widget__legend__item product-itineraries__itinerary__side-content__detail__widget__legend__item--button text-button goto-dates" href="#dates">
                                View Dates
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php } ?>


                <?php if ($charter_view == false) : ?>
                    <!-- Prices -->
                    <div class="product-itineraries__itinerary__side-content__detail__widget">
                        <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                            <h4 class="heading-4">
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
                        <?php foreach ($rateYears as $rateYear) { ?>
                            <div class="price-grid price-grid__<?php echo $rateYear['Year'] ?>" data-tab="<?php echo $count; ?>">
                                <?php $rateYears = $itinerary['RateYears']; ?>
                                <?php foreach ($rateYear['Rates'] as $rate) { ?>
                                    <div class="price-grid__item">
                                        <div class="price-grid__item__cabin">
                                            <?php echo  $rate['Cabin'] ?>
                                        </div>
                                        <div class="price-grid__item__price">
                                            <?php echo "$ " . number_format($rate['WebAmount'], 0);  ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>
                <?php else : ?>
                    <div class="product-itineraries__itinerary__side-content__detail__widget">
                        <div class="charter-info-box">
                            This itinerary is only a sample. Charter itineraries are completely customizable. Speak with one of our travel specialists for details and charter availability.
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Inclusions -->
                <div class="product-itineraries__itinerary__side-content__detail__widget">
                    <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                        <h4 class="heading-4" id="InclusionsTitle" data-tab="<?php echo $count; ?>">
                            What's Included
                        </h4>
                    </div>
                    <div class="inclusions-area">
                        <!-- Inclusions List -->
                        <div class="inclusions-area__itinerary-inclusions" id="inclusions-list" data-tab="<?php echo $count; ?>">
                            <ul class="list-svg">
                                <?php foreach ($itinerary['Inclusions'] as $inclusion) { ?>
                                    <li>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                        <span><?php echo $inclusion['Description'] ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-exclusions" value="<?php echo $count; ?>">
                                    View List of Exclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Exclusions List -->
                        <div class="inclusions-area__itinerary-inclusions inclusions-area__itinerary-inclusions--hidden" id="exclusions-list" data-tab="<?php echo $count; ?>">
                            <ul class="list-svg">
                                <?php foreach ($itinerary['Exclusions'] as $exclusion) { ?>
                                    <li>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                        <span><?php echo $exclusion['Description'] ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-inclusions" value="<?php echo $count; ?>">
                                    View List of Inclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
<?php $count++;
endforeach; ?>

<!-- Sort -->
<?php
function sortDays($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($a->DayNumber, $b->DayNumber);
    }
}
?>


<!--  -->
<div class="product-itineraries__nav__list__item <?php echo ($count == 1 ? 'current' : ''); ?>" data-tab="tab-itinerary-<?php echo $count ?>" id="tab-itinerary-<?php echo $count ?>-nav">


    <!--  -->

    <!-- Nav -->
    <div class="product-itineraries__nav">

        <!-- Attributes -->
        <div class="product-itineraries__nav__list" id="itineraries-slider-nav">
            <?php
            $count = 1;
            foreach ($cruise_data['Itineraries'] as $item) {

                if ($charter_only == true && $item['IsSample'] == false) :
                    //skip non sample itineraries
                    $count++;
                    continue;
                endif;
            ?>
                <div class="product-itineraries__nav__list__item">
                    <?php echo $item['LengthInDays'] ?>-Day
                </div>
            <?php
                $count++;
            } ?>
        </div>
        <!-- <div id="sentinal-itineraries"></div> -->
    </div>
    <!-- End Nav -->
    <div class="product-itineraries__slider-area">
        <div class="product-itineraries__slider-area__slider" id="itineraries-slider">

            <div class="product-itinerary-item">
                Itinerary 1
            </div>
            <div class="product-itinerary-item">
                Itinerary 2
            </div>
            <div class="product-itinerary-item">
                Itinerary 3
            </div>

        </div>
    </div>
















    <?php
    $count = 1;
    foreach ($cruise_data['Itineraries'] as $item) {

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
    } ?>