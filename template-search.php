<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);

?>



<?php
get_header();
?>




<div class="search-page">

    <!-- Hero -->
    <section class="search-page__section-hero" id="top">
        <!-- Search Hero -->
        <div class="search-hero">
            <img src="img/search-hero/search-05.jpg" alt="" class="search-hero__bg">
        </div>
    </section>

    <!-- Content -->
    <div class="search-page__section-content" id="content">
        <div class="search-content">
            <div class="search-content__sidebar">
                <div class="search-content__sidebar__panel">
                    <div class="search-content__sidebar__panel__input-group">
                        <label for="destination" class="search-content__sidebar__panel__input-group__label">Destination</label>
                        <select class="search-content__sidebar__panel__input-group__input" id="destination" tabindex="1">
                            <optgroup class="optgroup-label" label="Adventure Cruises">
                                <option>Amazon River</option>
                                <option>Galapagos Islands</option>
                                <option>Indonesian Archipelago</option>
                            </optgroup>
                            <optgroup class="optgroup-label" label="South America">
                                <option>Peru</option>
                                <option>Ecuador</option>
                                <option>Brazil</option>
                            </optgroup>
                            <optgroup class="optgroup-label" label="Asia">
                                <option>Cambodia</option>
                                <option>Vietnam</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="search-content__sidebar__panel__input-group">
                        <label for="travel-type" class="search-content__sidebar__panel__input-group__label">Travel Type</label>
                        <select class="search-content__sidebar__panel__input-group__input" id="travel-type" tabindex="1">
                            <option>Any</option>
                            <option>Tour Packages</option>
                            <option>Cruises</option>
                            <option>Lodges</option>
                            <option>Hotels</option>
                        </select>
                    </div>
                    <div class="search-content__sidebar__panel__input-group">
                        <label for="travel-style" class="search-content__sidebar__panel__input-group__label">Style</label>
                        <select class="search-content__sidebar__panel__input-group__input" id="travel-style" tabindex="1">
                            <option>Any</option>
                            <option>Family</option>
                            <option>Adventure</option>
                            <option>Cultural</option>
                            <option>Luxury</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="search-content__results">
                <div class="search-content__results__top-section">
                    <div class="search-content__results__top-section__title">
                        Results
                    </div>
                    <div class="search-content__results__top-section__filter">
                        <label for="sort-by">
                            Sort By:
                        </label>
                        <select id="sort-by" tabindex="1">
                            <option>Popularity</option>
                            <option>Price: High to Low</option>
                            <option>Price: Low to High</option>
                        </select>
                    </div>
                </div>
                <div class="search-content__results__grid">

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/Aria-Amazon.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/Delfin-III-Amazon-Cruise.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/zafiro-cruise-amazon.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/Aria-Amazon.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/Delfin-III-Amazon-Cruise.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card-square">
                        <div class="card-square__title-group">
                            <div class="card-square__title-group__name">
                                Aqua Mekong
                            </div>
                            <div class="card-square__title-group__country">
                                Cambodia / Vietnam
                            </div>
                        </div>
                        <img src="img/products/zafiro-cruise-amazon.jpg" alt="product" class="card-square__img">
                        <div class="card-square__bottom">
                            <div class="card-square__bottom__header">
                                Indonesian Archipelago
                            </div>
                            <div class="card-square__bottom__description">
                                Exploring the Magical Mekong Delta Aboard the Region’s Finest Vessel
                            </div>
                            <div class="card-square__bottom__last-section">
                                <div class="card-square__bottom__length">
                                    <span class="card-square__bottom__length__numbers">6-8</span>
                                    <span class="card-square__bottom__length__text">Days</span>
                                </div>
                                <div class="card-square__bottom__price">
                                    <div class="card-square__bottom__price__text">
                                        From
                                    </div>
                                    <div class="card-square__bottom__price__numbers">
                                        $4,960
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-content__results__bottom-section">
                    <button class="btn-outline ">
                        Load More Results
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>