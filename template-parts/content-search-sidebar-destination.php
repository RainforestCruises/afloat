<?php
$destination = $args['destination'];
?>

<form class="search-sidebar" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
    <div class="search-sticky-wrapper">
        <div class="search-sidebar__title">
            <span>Filter</span>
            <button>Reset</button>
        </div>
        <div class="search-sidebar__controls">
            <label class="search-control" for="location-select">
                <span class="search-control__label-text">Location</span>
                <select class="search-control__select" id="location-select" name="location-select">
                    <option></option>
                    <option value="0">Any</option>
                    <?php
                    console_log($destination->ID);
                    $locations = get_field('locations', $destination);
                    console_log($locations);

                    ?>
                    <?php foreach ($locations as $location) { ?>

                        <option value="<?php echo $location->ID ?>"><?php echo get_field('navigation_title', $location) ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <div class="search-control">
                <span class="search-control__label-text">Travel Dates</span>
                <input class="search-control__datetimepicker" type="text" name="departure-dates" id="departure-dates" readonly>
            </div>
            <label class="search-control" for="travel-select">
                <span class="search-control__label-text">Travel Type</span>
                <select class="search-control__select" id="travel-select" name="travel-select">
                    <option></option>
                    <option value="any">Any</option>
                    <option value="rfc_tours">Tours</option>
                    <option value="rfc_cruises">Cruises</option>
                    <option value="rfc_lodges">Lodges</option>
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