<?php
$region = $args['region'];
?>

<form class="search-sidebar" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
    <div class="search-sticky-wrapper">
        <div class="search-sidebar__title">
            <span>Filter</span>
            <button>Reset</button>
        </div>
        <div class="search-sidebar__controls">
            <label class="search-control" for="destination-select">
                <span class="search-control__label-text">Destination</span>
                <select class="search-control__select" id="destination-select" name="destination-select">
                    <option></option>
                    <option value="0">Any</option>
                    <?php
                    if ($destinations = get_posts(array(
                        'post_type' => 'rfc_destinations',
                        'posts_per_page' => -1, // to make it simple I use default categories
                        'orderby' => 'title',
                        'order' => 'ASC',
                        "meta_key" => "region",
                        "meta_value" => $region->ID,
                    ))) {
                    ?>
                        <?php foreach ($destinations as $destination) { ?>

                            <option value="<?php echo $destination->ID ?>"><?php echo get_the_title($destination) ?></option>
                    <?php }
                    } ?>
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
    </div>
</form>