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
        //preselections
        $formTravelStyles = array('rfc_cruises', 'rfc_tours', 'rfc_lodges');

        //page variables
        $searchType = $args['searchType'];
        $destination = $args['destination'];
        $region = $args['region'];

        $destinations = [];
        $experiences = [];

        $regionId = $region->ID;
        $destinationId = null;
        if($searchType == 'destination'){
            $destinationId = $destination->ID;
        }


        
        $posts = getSearchPosts($formTravelStyles,  $destinations, $experiences, $searchType, $destinationId, $regionId); //Stage I

        $formDates = null;
        $formMinLength = null;
        $formMaxLength = null;
        $formattedResults = formatFilterSearch($posts, $formMinLength, $formMaxLength, $formDates); //Stage II

       
        get_template_part('template-parts/content', 'primary-search-results', $formattedResults);

        ?>
    </div>
</div>