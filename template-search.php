<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<div class="search-page">
    <div class="search-content">
        <form class="search-sidebar" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
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
        </form>
        <div class="search-results">
            <div class="search-results__top-section">
                <div class="search-results__top-section__result-count">
                    11 Results
                </div>
                <div class="search-results__top-section__controls">
                    <label class="sort-control" for="result-sort">
                        <!-- <span class="sort-control__label-text">Sort</span> -->
                        <select class="sort-control__select" id="result-sort" name="result-sort" form="search-form">
                            <option></option>
                            <option value="REL">Relevance</option>
                            <option value="DESC">Price: High to Low</option>
                            <option value="ASC">Price: Low to High</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="search-results__grid" id="response">



            </div>
            <div class="search-results__bottom-section">
                <button class="btn-outline ">
                    Load More Results
                </button>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>