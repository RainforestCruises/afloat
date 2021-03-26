<?php

$cruise_data = $args['cruiseData'];
$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];

$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

$charter_min_days = $args['charter_min_days'];

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
<!-- <div id="sentinal-itineraries"></div> -->
<div class="product-itineraries">

    <h2 class="page-divider">
        Itineraries
    </h2>

    <!-- Nav -->
    <div class="product-itineraries__nav">     
        <div class="product-itineraries__nav__slider" id="itineraries-slider-nav">
                <div class="product-itineraries__nav__slider__item">
                    1-Day
                </div>
                <div class="product-itineraries__nav__slider__item">
                    2-Day
                </div>
                <div class="product-itineraries__nav__slider__item">
                    3-Day
                </div>
                <div class="product-itineraries__nav__slider__item">
                    4-Day
                </div>
                <div class="product-itineraries__nav__slider__item">
                    5-Day
                </div>
        </div>        
    </div>
    <!-- End Nav -->


    <!-- Content -->
    <div class="product-itineraries__content">
        <div class="product-itineraries__content__slider" id="itineraries-slider">

            <div class="product-itinerary-slide">
                Itinerary 1
            </div>
            <div class="product-itinerary-slide">
                Itinerary 2
            </div>
            <div class="product-itinerary-slide">
                Itinerary 3
            </div>
            <div class="product-itinerary-slide">
                Itinerary 4
            </div>
            <div class="product-itinerary-slide">
                Itinerary 5
            </div>

        </div>
    </div>



</div>