<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<div class="search-page">
    <div class="search-content">
        <div class="search-sidebar">
            <div class="search-sidebar__title">
                <span>Filter</span>
                <button>Reset</button>
            </div>
            <div class="search-sidebar__controls">
                <label class="search-control" for="itinerary-select">
                    <span class="search-control__label-text">Itinerary</span>
                    <select class="search-control__select" id="itinerary-select" name="itinerary-select">
                        <option></option>
                        <option value="0">Any</option>
                        <option value="1">Text</option>
                        <option value="2">Text 3</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="search-results">
            <div class="search-results__top-section">
                <div class="search-results__top-section__result-count">
                    11 Results
                </div>
                <div class="search-results__top-section__controls">
                    <label class="search-control" for="result-sort">
                        <span class="search-control__label-text">Sort</span>
                        <select class="search-control__select" id="result-sort" name="result-sort">
                            <option></option>
                            <option value="0">Any</option>
                            <option value="1">Text</option>
                            <option value="2">Text 3</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="search-results__grid">
               <!-- Result -->
                <div class="search-result search-result--highlight">
                    <div class="search-result__image">
                        <img src="<?php echo get_template_directory_uri() . '/css/img/test-images/delfin-i.jpg' ?>" alt="">
                    </div>
                    <div class="search-result__content">
                        <div class="search-result__content__tag">
                            <div class="badge-solid badge-solid--small">
                                Popular
                            </div>
                        </div>
                        <div class="search-result__content__length">
                            4-8 Day Cruise
                        </div>
                        <div class="search-result__content__title">
                            Amazon River Cruise
                        </div>
                        <div class="search-result__content__description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae vel iusto doloribus modi suscipit, veniam harum officia ipsa quos.
                        </div>
                        <div class="search-result__content__info">
                            <div class="search-result__content__info__price">
                                <div class="search-result__content__info__price__starting">
                                    Starting from
                                </div>
                                <div class="search-result__content__info__price__amount">
                                    $4,900
                                </div>
                                <div class="search-result__content__info__price__currency">
                                    USD
                                </div>
                            </div>
                            <div class="search-result__content__info__icons">
                                Icons
                            </div>
                        </div>
                    </div>
                </div>
                
               <!-- Result -->
                <div class="search-result">
                    <div class="search-result__image">
                        <img src="<?php echo get_template_directory_uri() . '/css/img/test-images/delfin-i.jpg' ?>" alt="">
                    </div>
                    <div class="search-result__content">
                        <div class="search-result__content__tag">
                            <div class="badge-solid badge-solid--small">
                                Popular
                            </div>
                        </div>
                        <div class="search-result__content__length">
                            4-8 Day Cruise
                        </div>
                        <div class="search-result__content__title">
                            Amazon River Cruise
                        </div>
                        <div class="search-result__content__description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae vel iusto doloribus modi suscipit, veniam harum officia ipsa quos.
                        </div>
                        <div class="search-result__content__info">
                            <div class="search-result__content__info__price">
                                <div class="search-result__content__info__price__starting">
                                    Starting from
                                </div>
                                <div class="search-result__content__info__price__amount">
                                    $4,900
                                </div>
                                <div class="search-result__content__info__price__currency">
                                    USD
                                </div>
                            </div>
                            <div class="search-result__content__info__icons">
                                Icons
                            </div>
                        </div>
                    </div>
                </div>
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