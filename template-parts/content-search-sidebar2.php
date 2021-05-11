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
$searchType = get_field('search_type');
$destination = null;
$region = null;


//set up search type
$pageLandingTitle = "";
if ($searchType == 'region') {
    $region = get_field('region');
    $pageLandingTitle = get_field('navigation_title', $region);
} else {
    $region = get_field('region', $destination);
    $destination = get_field('destination');
    $pageLandingTitle = get_field('navigation_title', $destination);
}


$experiencesArgs = array(
    'post_type' => 'rfc_experiences',
    'posts_per_page' => -1
);


//for filter lists
$experiences = get_posts($experiencesArgs);
$destinations = null; //can be location or destination depending on search type
$isBucketList = false;

if ($searchType == 'destination') {
    $destinations = get_field('locations', $destination);
    $isBucketList = get_field('is_bucket_list', $destination);
}

if ($searchType == 'region') {

    $destinationsArgs = array(
        'post_type' => 'rfc_destinations',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        "meta_key" => "region",
        "meta_value" => $region->ID,
    );
    $destinations = get_posts($destinationsArgs);
}


//pre-selections
$selectedTravelType = get_field('travel_type');
$selectedExperience = get_field('experience');
$selectedLocation = get_field('location_filter');

$itinerary_length_min = 1;
$itinerary_length_max = 15;
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
            <!-- List -->
            <ul class="filter__content__list" id="departure-filter-list">

                <?php
                $count = 1;
                foreach ($months as $m) : ?>
                    <li class="filter__content__list__item">
                        <div class="form-checkbox">
                            <input class="checkbox departure-checkbox" type="checkbox" id="departure-checkbox-<?php echo $count; ?>" month="<?php echo $m->monthNumber ?>" year="<?php echo $m->year ?>">
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
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-1" value="tours">
                        <label for="travel-style-checkbox-1" tabindex="1">Tours</label>
                    </div>
                </li>
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-2" value="cruises">
                        <label for="travel-style-checkbox-2" tabindex="2">Cruises</label>
                    </div>
                </li>
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox travel-style-checkbox" type="checkbox" id="travel-style-checkbox-3" value="lodges">
                        <label for="travel-style-checkbox-3" tabindex="3">Lodges</label>
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
                            <input class="checkbox destination-checkbox" type="checkbox" id="destination-checkbox-<?php echo $count; ?>" value="<?php echo $d->ID ?>">
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
                            <input class="checkbox experience-checkbox" type="checkbox" id="experience-checkbox-<?php echo $count; ?>" value="<?php echo $e->ID ?>">
                            <label for="experience-checkbox-<?php echo $count; ?>" tabindex="1"><?php echo get_the_title($e) ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
        </div>
    </div>

</aside>

<form class="search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <!-- Direct to function within functions.php -->
    <input type="hidden" name="action" value="mainSearch">
    <input type="hidden" name="startDate" id="startDate" value="">
    <input type="hidden" name="endDate" id="endDate" value="">
    <input type="hidden" name="minLength" id="minLength" value="">
    <input type="hidden" name="maxLength" id="maxLength" value="">
    <input type="hidden" name="region" id="region" value="<?php echo $region->ID ?>">
    <input type="hidden" name="destination" id="destination" value="<?php echo $destination->ID ?>">
    <input type="hidden" name="searchType" id="searchType" value="<?php echo $searchType ?>">
    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>

<script>
    //tour lengths (always a number)
    var preselectMinLength = "<?php echo $itinerary_length_min ?>";
    var preselectMaxLength = "<?php echo $itinerary_length_max ?>";

    //experience
    var preselectExperience = null;
    <?php if ($selectedExperience) : ?>
        preselectExperience = <?php echo $selectedExperience->ID; ?>;
    <?php endif; ?>

    //travel type
    var preselectTravelType = null;
    <?php if ($selectedTravelType) : ?>
        preselectTravelType = "<?php echo $selectedTravelType; ?>";
    <?php endif; ?>

    //location
    var preselectLocation = null;
    <?php if ($selectedLocation) : ?>
        preselectLocation = "<?php echo $selectedLocation->ID; ?>";
    <?php endif; ?>
</script>