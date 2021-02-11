<?php
$destination = $args['destination'];

$experiencesArgs = array(
    'post_type' => 'rfc_experiences',
    'posts_per_page' => -1
);

$experiences = get_posts($experiencesArgs);

$selectedTravelType = get_field('travel_type');
$selectedExperience = get_field('experience');
$itinerary_length_min = 1;
$itinerary_length_max = 14;
if(get_field('itinerary_length_min') != null) {
    $itinerary_length_min = get_field('itinerary_length_min');
};
if(get_field('itinerary_length_max') != null) {
    $itinerary_length_max = get_field('itinerary_length_max');
};

?>

<form class="search-sidebar" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
    <div class="search-sticky-wrapper">
        <div class="search-sidebar__title">
            <span>Filter</span>
        </div>
        <div class="search-sidebar__controls">
            <div class="search-control">
                <span class="search-control__label-text">Travel Dates</span>
                <input class="search-control__datetimepicker" type="text" name="departure-dates" id="departure-dates" readonly>
            </div>
            <label class="search-control" for="travel-select">
                <span class="search-control__label-text">Travel Type</span>
                <select class="search-control__select" id="travel-select" name="travel-select">
                    <option></option>

                    <option value="any">Any</option>

                    <?php echo ($selectedTravelType == "rfc_tours") ? '<option value="rfc_tours" selected="selected">Tours</option>' : '<option value="rfc_tours" >Tours</option>' ?>

                    <?php echo ($selectedTravelType == "rfc_cruises") ? '<option value="rfc_cruises" selected="selected">Cruises</option>' : '<option value="rfc_cruises">Cruises</option>' ?>
                    <?php echo ($selectedTravelType == "rfc_lodges") ? '<option value="rfc_lodges" selected="selected">Lodges</option>' : '<option value="rfc_lodges">Lodges</option>' ?>

                </select>
            </label>
            <label class="search-control" for="location-select">
                <span class="search-control__label-text">Location</span>
                <select class="search-control__select" id="location-select" name="location-select">
                    <option></option>
                    <option value="0">Any</option>
                    <?php
                    $locations = get_field('locations', $destination);
                    ?>
                    <?php foreach ($locations as $location) { ?>

                        <option value="<?php echo $location->ID ?>"><?php echo get_field('navigation_title', $location) ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label class="search-control" for="experience-select">
                <span class="search-control__label-text">Experience</span>
                <select class="search-control__select" id="experience-select" name="experience-select">
                    <option></option>
                    <option value="0">Any</option>
                    <?php
                    ?>
                    <?php foreach ($experiences as $e) :
                        if ($e->ID == $selectedExperience->ID) : ?>
                            <option value="<?php echo $e->ID ?>" selected="selected"><?php echo get_the_title($e) ?></option>
                        <?php else : ?>
                            <option value="<?php echo $e->ID ?>"><?php echo get_the_title($e) ?></option>
                        <?php endif; ?>
                    <?php endforeach;
                    ?>
                </select>
            </label>


            <div class="search-control">
                <span class="search-control__label-text">Itinerary Length</span>
                <input class="search-control__range-slider" type="text" name="range-slider" id="range-slider">
            </div>
        </div>
        <!-- Direct to function within functions.php -->
        <input type="hidden" name="action" value="mainSearch">
        <input type="hidden" name="startDate" id="startDate" value="">
        <input type="hidden" name="endDate" id="endDate" value="">
        <input type="hidden" name="minLength" id="minLength" value="">
        <input type="hidden" name="maxLength" id="maxLength" value="">
        <input type="hidden" name="destination" id="destination" value="<?php echo $destination->ID ?>">
        <input type="hidden" name="searchType" id="searchType" value="destination">


    </div>
</form>

<script>
 var preselectMinLength = "<?php echo $itinerary_length_min ?>";
 var preselectMaxLength = "<?php echo $itinerary_length_max ?>";

</script>