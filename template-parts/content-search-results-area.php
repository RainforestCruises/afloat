<?php

//first load
$resultsObject = getSearchPosts($args['travelTypes'],  $args['destinations'], $args['experiences'], $args['searchType'], $args['destinationId'], $args['regionId'], $args['lengthMin'], $args['lengthMax'], $args['departures'], $args['sorting'], $args['pageNumber']);
$resultCount = $resultsObject['resultsCount'];

?>

<div class="search-results">
    <div class="search-results__top-section" id="search-results-top">
        <div class="search-results__top-section__result-count" id="response-count">

            Found <?php echo $resultCount; ?> <?php echo ($resultCount == 1) ? 'Result' : 'Results'; ?>

        </div>

        <div class="search-results__top-section__controls" id="sort-control">
            <label class="sort-control" for="result-sort">
                <span class="sort-control__label-text">Sort by</span>
                <select class="sort-control__select" id="result-sort" name="result-sort">
                    <option value="popularity">Popularity</option>
                    <option value="high">Price High to Low</option>
                    <option value="low">Price Low to High</option>
                </select>
            </label>
        </div>
    </div>
    <div class="search-results__grid" id="response">


        <?php
        get_template_part('template-parts/content', 'search-results-content', $resultsObject);
        ?>

    </div>

    


</div>