<?php
// Time
$months = array();
$currentMonth = (int)date('m');
$monthLimit = 18;

for ($x = $currentMonth; $x < $currentMonth + $monthLimit; $x++) {

    $object = new stdClass();
    $object->monthName = date('F', mktime(0, 0, 0, $x, 1));
    $object->monthNumber = date('m', mktime(0, 0, 0, $x, 1));
    $object->year = date('Y', mktime(0, 0, 0, $x, 1));

    $months[] = $object;
}

//page variables
$searchType = $args['searchType'];
$destinationId = $args['destinationId'];
$regionId = $args['regionId'];

//preselections
$selectedTravelTypes = $args['travelTypes'];
$selectedExperiences = $args['experiences'];
$selectedDestinations = $args['destinations'];
$selectedDepartures = $args['departures'];



//Build Filter Lists
$experiencesArgs = array(
    'post_type' => 'rfc_experiences',
    'posts_per_page' => -1
);

$experiences = get_posts($experiencesArgs);
$destinations = null; //can be location or destination depending on search type
$isBucketList = false;

if ($searchType == 'destination') {
    $destinations = get_field('locations', $destinationId); //locations
    $isBucketList = get_field('is_bucket_list', $destinationId); //to hide location filters
}

if ($searchType == 'region') {
    $destinationsArgs = array(
        'post_type' => 'rfc_destinations', //destinations
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        "meta_key" => "region",
        "meta_value" => $regionId,
    );
    $destinations = get_posts($destinationsArgs);
}


//do next
$itinerary_length_min = 1;
$itinerary_length_max = 21;
if (get_field('itinerary_length_min') != null) {
    $itinerary_length_min = get_field('itinerary_length_min');
};
if (get_field('itinerary_length_max') != null) {
    $itinerary_length_max = get_field('itinerary_length_max');
};

?>

<aside class="search-sidebar">

  
    <!-- Departure Date Filter -->
    <div class="filter">
        <div class="filter__heading" id="departure-filter-heading">
            <div class="filter__heading__text">
                Departure Date
            </div>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List  add expanded if selection-->
            <ul class="filter__content__list  filter__content__list--fixedHeight" id="departure-filter-list">

                <?php
                $count = 1;
                foreach ($months as $m) :
                    $currentItemValue = $m->year . '-' . $m->monthNumber;
                ?>
                    <li class="filter__content__list__item">
                        <div class="form-checkbox">
                            <input class="checkbox departure-checkbox <?php echo ($count > 6) ? 'checkbox-expand-group' : ''; ?>" type="checkbox" id="departure-checkbox-<?php echo $count; ?>" value="<?php echo $currentItemValue; ?>" <?php echo ($selectedDepartures != null ? (in_array($currentItemValue, $selectedDepartures) ? 'checked' : '') : '') ?>>
                            <label for="departure-checkbox-<?php echo $count; ?>"><?php echo $m->monthName . " " . $m->year; ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
            <div class="filter__content__show-more">
                <button id="departure-show-more">Show More</button>
            </div>
            <!-- Extras here, button etc-->
        </div>
    </div>

    <!-- Travel Style Filter -->
    <div class="filter">
        <div class="filter__heading">
            <div class="filter__heading__text">
                Travel Style
            </div>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-1" value="rfc_tours" <?php echo (in_array('rfc_tours', $selectedTravelTypes) ? 'checked' : '') ?>>
                        <label for="travel-style-checkbox-1" tabindex="1">Tours</label>
                    </div>
                </li>
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-2" value="rfc_cruises" <?php echo (in_array('rfc_cruises', $selectedTravelTypes) ? 'checked' : '') ?>>
                        <label for="travel-style-checkbox-2" tabindex="2">Cruises</label>
                    </div>
                </li>
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-3" value="rfc_lodges" <?php echo (in_array('rfc_lodges', $selectedTravelTypes) ? 'checked' : '') ?>>
                        <label for="travel-style-checkbox-3" tabindex="3">Lodges</label>
                    </div>
                </li>
                <li class="filter__content__list__item filter__content__list__item--divider">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="charterCheckbox" value="charter_cruises" <?php echo (in_array('charter_cruises', $selectedTravelTypes) ? 'checked' : '') ?>>
                        <label for="charterCheckbox" tabindex="4">Charter Cruises</label>
                    </div>
                </li>
            </ul>
            <!-- Extras here, button etc-->
        </div>
    </div>

    <!-- Destinations/Locations Filter -->
    <div class="filter">
        <div class="filter__heading">
            <div class="filter__heading__text">
                Destinations
            </div>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">

                <?php
                $count = 1;
                foreach ($destinations as $d) : ?>
                    <li class="filter__content__list__item">
                        <div class="form-checkbox">
                            <input class="checkbox destination-checkbox" type="checkbox" id="destination-checkbox-<?php echo $count; ?>" value="<?php echo $d->ID ?>" <?php echo ($selectedDestinations != null ? (in_array($d->ID, $selectedDestinations) ? 'checked' : '') : '') ?>>
                            <label for="destination-checkbox-<?php echo $count; ?>"><?php echo get_field('navigation_title', $d) ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
        </div>
    </div>

    <!-- Experiences Filter -->
    <div class="filter">
        <div class="filter__heading">
            <div class="filter__heading__text">
                Experiences
            </div>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">

                <?php
                $count = 1;
                foreach ($experiences as $e) :
                ?>
                    <li class="filter__content__list__item">
                        <div class="form-checkbox">
                            <input class="checkbox experience-checkbox" type="checkbox" id="experience-checkbox-<?php echo $count; ?>" value="<?php echo $e->ID ?>" <?php echo ($selectedExperiences != null ? (in_array($e->ID, $selectedExperiences) ? 'checked' : '') : '') ?>>
                            <label for="experience-checkbox-<?php echo $count; ?>" tabindex="1"><?php echo get_the_title($e) ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
        </div>
    </div>

    <!-- Length Filter -->
    <div class="filter">
        <div class="filter__heading">
            <div class="filter__heading__text">
                Itinerary Length
            </div>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <input class="filter__content__range-slider" type="text" name="range-slider" id="range-slider">
        </div>
    </div>

</aside>