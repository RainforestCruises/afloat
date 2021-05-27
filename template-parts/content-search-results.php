<div class="search-results">
    <div class="search-results__top-section">
        <div class="search-results__top-section__result-count" id="response-count">

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


        <?php

   

        $posts = getSearchPosts($args['travelTypes'],  $args['destinations'], $args['experiences'], $args['searchType'], $args['destinationId'], $args['regionId'], $args['lengthMin'], $args['lengthMax'], $args['departures']); //Stage I


        get_template_part('template-parts/content', 'primary-search-results', $posts);

        ?>
    </div>
</div>