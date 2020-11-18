<?php
$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];

$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

?>

<div class="product-dates">
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
            <?php echo get_field('dates_intro'); ?>
        </div>

    </div>
    <div id="sentinal-dates"></div>

    <div class="product-dates__title page-divider u-margin-bottom-none">
        Availability
    </div>
    <!-- Search Area -->
    <div class="product-dates__search-area">
        <!-- Controls -->
        <form class="product-dates__search-area__controls" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
            <label class="product-dates__search-area__controls__control" for="dates-itinerary-select">
                <span class="product-dates__search-area__controls__control__label-text">Itinerary</span>
                <select id="dates-itinerary-select" name="dates-itinerary-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <option value="0">Any</option>
                    <?php foreach ($cruise_data['Itineraries'] as $itinerary) { ?>
                        <option value="<?php echo $itinerary['Id'] ?>"><?php echo $itinerary['Name'] . ' - ' . $itinerary['ShortName'] ?></option>
                    <?php } ?>
                </select>
            </label>

            <label class="product-dates__search-area__controls__control" for="dates-month-select">
                <span class="product-dates__search-area__controls__control__label-text">Month</span>

                <select id="dates-month-select" name="dates-month-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <?php
                    $monthCount = 1;
                    foreach ($monthNames as $monthName) { ?>
                        <option value="<?php echo $monthCount ?>"><?php echo $monthName ?></option>
                    <?php $monthCount++;
                    } ?>
                </select>

            </label>
            <label class="product-dates__search-area__controls__control" for="dates-year-select">
                <span class="product-dates__search-area__controls__control__label-text">Year</span>
                <select id="dates-year-select" name="dates-year-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <?php foreach ($years as $year) { ?>
                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                    <?php } ?>
                </select>
            </label>


            <!-- Direct to function within functions.php -->
            <input type="hidden" name="action" value="productSearch">
            <input type="hidden" name="productId" value="<?php echo get_the_ID() ?>">

        </form>
        <!-- Results -->
        <div class="product-dates__search-area__results" id="response">
        </div>

    </div>
</div>