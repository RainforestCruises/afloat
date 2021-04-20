<?php

$currentPost = get_post($args['productId']); //needed because AJAX loading
$cruise_data = get_field('cruise_data', $currentPost);


$currentYear = date("Y");
$currentMonth = date("m");


$timePhrase = "";




$startDate = strtotime($args['selectedYear'] . '-' . $args['selectedMonth']);
$endDate = strtotime(($args['selectedYear'] . '-' . $args['selectedMonth']) . " +1 month");
$timePhrase = " in " . date('F Y', $startDate);


//filter itineraries if selection
$itineraries = $cruise_data['Itineraries'];
$selectedItinerary;


//Need ID of selected itinerary, will always be one itinerary loop not needed...
foreach ($itineraries as $itinerary) {
    if ($itinerary['Id'] == $args['selectedItinerary']) {
        $selectedItinerary = $itinerary;
    }
}


console_log($selectedItinerary);
$departures = $selectedItinerary['Departures'];
$filteredDepartures = [];

$hasPromo = false;
foreach ($departures as $departure) {
    $dateString = strtotime($departure['DepartureDate']);
    if ($dateString >= $startDate && $dateString <= $endDate) {
        $filteredDepartures[] = $departure;
        if ($departure['HasPromo'] == true) {
            $hasPromo = true;
        }
    }
}



?>

<div class="side-info-panel__departure-grid__grid">
    <div class="side-info-panel__departure-grid__grid__heading-title">
        Date
    </div>
    <div class="side-info-panel__departure-grid__grid__heading-title">
        Season
    </div>

    <div class="side-info-panel__departure-grid__grid__heading-title">
        Price Range
    </div>
    <div class="side-info-panel__departure-grid__grid__heading-title">
    </div>
    <?php foreach ($filteredDepartures as $result) :

        $nights = $selectedItinerary['LengthInNights'];

        $departureStartDate = strtotime($result['DepartureDate']);

        $departureEndDate = strtotime($result['DepartureDate'] . " +" . $nights . " days");

    ?>

        <div class="side-info-panel__departure-grid__grid__date">
            <div>
                <?php echo date("M j", $departureStartDate); ?> &mdash; &nbsp;
            </div>
            <div>
                <?php echo date("M j", $departureEndDate); ?>
            </div>


        </div>
        <div class="side-info-panel__departure-grid__grid__season">
            <div>
                <?php
                if ($result['IsHighSeason'] == true) { //SEASON
                    echo 'High';
                } else if ($result['IsLowSeason'] == true) {
                    echo 'Low';
                } else {
                    echo 'Regular';
                }
                ?>
            </div>
            <?php if ($result['HasPromo'] == true) : ?>
                <div class="promo-div">Promo</div>
            <?php endif; ?>

        </div>

        <div class="side-info-panel__departure-grid__grid__price-range">
            <div>
                <?php echo "$ " . number_format($result['LowestPrice'], 0);  ?> &mdash; &nbsp;
            </div>
            <div>
                <?php echo " " . "$ " . number_format($result['HighestPrice'], 0);  ?>
            </div>

        </div>
        <div class="side-info-panel__departure-grid__grid__cta">
            <button class="btn-cta-round btn-cta-round--small ">
                Book
            </button>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($hasPromo) : ?>
    <div class="side-info-panel__departure-grid__note">
        Contact us for promotion details
    </div>

<?php endif; ?>