<?php

$currentPost = get_post($args['productId']); //needed because AJAX loading
$cruise_data = get_field('cruise_data', $currentPost);

//$cruise_data = get_field('cruise_data');

$currentYear = date("Y");
$currentMonth = date("m");
$limitResults = false;
$limitCount = 4;

$timePhrase = "";

if ($args['selectedYear'] == null && $args['selectedMonth'] == null) { //none selected
    $startDate = strtotime($currentYear . '-' . 01);
    $endDate = strtotime(($currentYear + 2 ) . '-' . 12);
    $limitResults = true;
    $timePhrase = " next to depart";
} else if ($args['selectedYear'] == null) { //month only selected
    $startDate = strtotime($currentYear . '-' . $args['selectedMonth']);
    $endDate = strtotime(($currentYear . '-' . $args['selectedMonth']) . " +1 month");
    $timePhrase = " in " . date('F Y', $startDate);
} else if ($args['selectedMonth'] == null) { //year only selected
    $startDate = strtotime($args['selectedYear'] . '-' . 01);
    $endDate = strtotime($args['selectedYear'] . '-' . 12);
    $limitResults = true;
    $timePhrase = " in " . date('Y', $startDate)  . " next to depart";
} else { //both selected
    $startDate = strtotime($args['selectedYear'] . '-' . $args['selectedMonth']);
    $endDate = strtotime(($args['selectedYear'] . '-' . $args['selectedMonth']) . " +1 month");
    $timePhrase = " in " . date('F Y', $startDate);
}





//filter itineraries if selection
$itineraries = $cruise_data['Itineraries'];
$filteredItineraries = [];

if ($args['selectedItinerary'] != null) {
    
    foreach ($itineraries as $itinerary) {
        if ($itinerary['Id'] == $args['selectedItinerary']) {
            $filteredItineraries[] = $itinerary;
        }
    }
} else {
    $filteredItineraries = $cruise_data['Itineraries'];
}
$itineraryCount = 1;
foreach ($filteredItineraries as $itinerary) {
    $count = 1;
    
    $departures = $itinerary['Departures'];
    $filteredDepartures = [];
    foreach ($departures as $departure) {
        $dateString = strtotime($departure['DepartureDate']);
        if ($dateString >= $startDate && $dateString <= $endDate) {
            if ($limitResults == true) {

                if ($count <= $limitCount) {
                    $filteredDepartures[] = $departure;
                    $count++;
                }
            } else {
                $filteredDepartures[] = $departure;
            }
        }
    }
?>
    <!-- Itinerary Group -->
    <div class="product-dates__search-area__results__itinerary-group">
        <!-- Itinerary -->
        <div class="product-dates__search-area__results__itinerary-group__itinerary">

            <div class="product-dates__search-area__results__itinerary-group__itinerary__title-group">
                <div class="product-dates__search-area__results__itinerary-group__itinerary__title-group__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
                    </svg>
                </div>
                <div class="product-dates__search-area__results__itinerary-group__itinerary__title-group__text">
                    <div class="product-dates__search-area__results__itinerary-group__itinerary__title-group__text__title">
                        <?php echo $itinerary['Name'] ?>
                    </div>
                    <div class="product-dates__search-area__results__itinerary-group__itinerary__title-group__text__subtitle"><?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night</div>
                </div>

            </div>
            <div class="product-dates__search-area__results__itinerary-group__itinerary__description">
                <span class="<?php echo (count($filteredDepartures) == 0) ? ('warning-text') : ''; ?>">
                    There are <?php echo count($filteredDepartures) ?> options available for the <?php echo $cruise_data['Name'] . ' ' . $itinerary['Name'] ?> <?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night cruise <?php echo $timePhrase ?>.
                </span>
            </div>
            <div class="product-dates__search-area__results__itinerary-group__itinerary__cta">
                <button class="btn-outline btn-outline--dark results-goto-itineraries" href="#itineraries" data-tab="tab-itinerary-<?php echo $itineraryCount ?>">Learn More</button>
            </div>
        </div>

        <!-- Departures List -->
        <div class="product-dates__search-area__results__itinerary-group__departures">

            <?php foreach ($filteredDepartures as $result) { ?>
                <!-- Departure -->
                <div class="product-dates__search-area__results__itinerary-group__departures__departure">
                    <!-- Top -->
                    <div class="product-dates__search-area__results__itinerary-group__departures__departure__top">
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__date">

                            <?php echo date("M j", strtotime($result['DepartureDate'])); ?> - <?php echo date("M j, Y", strtotime($result['DepartureDate']  . ' + ' . $itinerary['LengthInNights'] . ' days')); ?>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ship"></use>
                            </svg>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__col">
                            <span class="product-dates__search-area__results__itinerary-group__departures__departure__top__col__heading">Season</span>
                            <?php if ($result['IsHighSeason'] == true) {
                                echo 'High';
                            } else if ($result['IsLowSeason'] == true) {
                                echo 'Low';
                            } else {
                                echo 'Regular';
                            } ?>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__col">
                            <span class="product-dates__search-area__results__itinerary-group__departures__departure__top__col__heading">Price Range</span>
                            <?php echo "$ " . number_format($result['LowestPrice'], 0);  ?> &mdash; <?php echo "$ " . number_format($result['HighestPrice'], 0);  ?>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__col product-dates__search-area__results__itinerary-group__departures__departure__top__col--promo ">
                            <?php if ($result['HasPromo'] == true) { ?>
                                <div class="badge-solid badge-solid--red">Promo</div>
                            <?php } ?>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__top__col product-dates__search-area__results__itinerary-group__departures__departure__top__col--expand">
                            <button class="btn-expand btn-expand--down departure-expand">
                                <svg class="btn-expand--arrow-main">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                                <svg class="btn-expand--arrow-animate">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Bottom -->
                    <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom">
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__info">
                            <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__info__description">
                                <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__info__description__title">
                                    <?php echo $cruise_data['Name']; ?> <?php echo $itinerary['LengthInDays']; ?> Day <?php echo $cruise_data['Region']; ?> Cruise

                                </div>
                                <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__info__description__text">
                                    <?php echo $cruise_data['Name']; ?> <?php echo $itinerary['LengthInDays']; ?> Day <?php echo $itinerary['Name']; ?> Cruise, departing on <?php echo date("l F j, Y", strtotime($result['DepartureDate'])); ?>. <?php echo get_field('top_snippet', $currentPost) ?> Contact our travel specialists to learn more or start a reservation.
                                </div>
                            </div>
                            <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__info__cta">
                                <button class="btn-cta-round">Book Now</button>
                            </div>
                        </div>
                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__cabins">
                            <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__cabins__icon">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-single_bed"></use>
                                </svg>
                            </div>
                            <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__cabins__cabin-group">
                                <?php foreach ($result['Cabins'] as $cabinPrice) { ?>
                                    <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__cabins__cabin-group__cabin">
                                        <div class="product-dates__search-area__results__itinerary-group__departures__departure__bottom__cabins__cabin-group__cabin__heading">
                                            <?php echo $cabinPrice['CabinName'] ?>
                                        </div>
                                        <?php echo "$ " . number_format($cabinPrice['Price'], 0);  ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
<?php $itineraryCount++; } ?>
