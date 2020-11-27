<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<div class="search-page">
    <div class="search-page__intro">
        <ol class="search-page__intro__breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Latin America</a>
            </li>
            <li>
                Peru
            </li>
        </ol>
        <div class="search-page__intro__title">
            Peru Travel
        </div>
        <div class="search-page__intro__text" style="display: block;">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam incidunt velit laudantium atque. Doloribus saepe officia, laborum provident deserunt sed, et nisi magnam alias obcaecati reprehenderit quam cumque, vitae nostrum.
        </div>
    </div>
    <div class="search-page__content">

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
    <div class="search-page__bottom">
        bottom
    </div>
</div>



<?php get_footer(); ?>