<?php
$functionArgs = $args;

$postsFromSearch = $functionArgs->products;
$sortOrder = $functionArgs->sortOrder;
$startDate = $functionArgs->startDate;
$endDate = $functionArgs->endDate;
$minLength = $functionArgs->minLength;
$maxLength = $functionArgs->maxLength;
$pageNumber = $functionArgs->pageNumber;


$startDateString = strtotime($startDate);
$endDateString = strtotime($endDate);

$startYear =  date("Y", $startDateString);


$results = [];
foreach ($postsFromSearch as $post) {
    $cruise_data = get_field('cruise_data', $post);
    $lowest = $cruise_data['LowestPrice'];
    $highest = $cruise_data['HighestPrice'];
    $postType = get_post_type($post);
    $tourLength = 0;

    if ($postType == 'rfc_tours') {
        $pricePackages = get_field('price_packages', $post);
        $lowest = lowest_tour_price($pricePackages, $startYear);
        $tourLength = get_field('length', $post);
    }

    $results[] = (object) array(
        'postObject' => $post,
        'cruise_data' => $cruise_data,
        'lowestPrice' => $lowest,
        'highestPrice' => $highest,
        'postType' => $postType,
        'tourLength' => $tourLength

    );
}
if ($sortOrder == 'ASC') {
    usort($results, "sortPrice");
}

if ($sortOrder == 'DESC') {
    usort($results, "sortPriceDescending");
}


$filteredResults = [];
foreach ($results as $result) :
    $featured_image = get_field('featured_image', $result->postObject);
    $cruise_data = get_field('cruise_data', $result->postObject);

    $hasAvailability = false;
    $hasRange = false;




    if ($result->postType == 'rfc_tours') {

        //Availability
        $hasAvailability = true;

        //Range
        if (($result->tourLength >= $minLength) && ($result->tourLength <= $maxLength)) {
            $hasRange = true;
        }
    } else {
        foreach ($cruise_data['Itineraries'] as $itinerary) {

            //Range
            if (($itinerary['LengthInDays'] >= $minLength) && ($itinerary['LengthInDays'] <= $maxLength)) {
                $hasRange = true;
            }

            //Availability
            foreach ($itinerary['Departures'] as $departure) {
                if ((strtotime($departure['DepartureDate']) >= strtotime($startDate)) && (strtotime($departure['DepartureDate']) <= strtotime($endDate))) {
                    $hasAvailability = true;
                }
            }
        }
    }

    if ($hasAvailability == false || $hasRange == false) {
        continue;
    } else {
        $filteredResults[] = $result;
    }




//NOTES
//loop all to get count 
//create filtered list
//use for pagination
endforeach;



?>

<?php
$resultsPerPage = 10;
$resultsTotal = count($filteredResults);

$pageCount = floor($resultsTotal / $resultsPerPage);
if ($resultsTotal % $resultsPerPage != 0) {
    $pageCount++;
};

$startIndex = (($pageNumber - 1) * $resultsPerPage);
console_log($pageNumber);

if($pageNumber != 'all'){
    $filteredResults = array_slice($filteredResults, $startIndex, $resultsPerPage);

}else{
    $filteredResults = array_slice($filteredResults, 0, 50);

}

foreach ($filteredResults as $filteredResult) :
    $featured_image = get_field('featured_image', $filteredResult->postObject);
    $cruise_data = $filteredResult->cruise_data;
?>
    <!-- Result -->
    <a class="search-result" href="<?php echo get_permalink($filteredResult->postObject); ?>">
        <div class="search-result__image">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
        </div>
        <div class="search-result__content">
            <div class="search-result__content__tag">
                <?php if (($filteredResult->postType == 'rfc_tours') && (get_field('best_selling', $filteredResult->postObject) == true)) : ?>
                    <div class="badge-solid badge-solid--small">
                        Best-Seller
                    </div>
                <?php endif; ?>

                <?php if (check_if_promo($cruise_data, $startDateString, $endDateString, $minLength, $maxLength) == true) : ?>
                    <div class="badge-solid badge-solid--red badge-solid--small">
                        Promo
                    </div>
                <?php endif; ?>
            </div>
            <div class="search-result__content__length">
                <?php if ($filteredResult->postType == 'rfc_tours') { ?>
                    <?php echo get_field('length', $filteredResult->postObject) ?>-Day Tour
                <?php } else if ($filteredResult->postType == 'rfc_cruises') { ?>
                    <?php echo $cruise_data['LowestLengthInDays']; ?>-<?php echo $cruise_data['HighestLengthInDays']; ?> Day Cruise
                <?php } else if ($filteredResult->postType == 'rfc_lodges') { ?>
                    Lodge & Land Tour
                <?php } ?>
            </div>
            <div class="search-result__content__title">
                <?php if ($filteredResult->postType == 'rfc_tours') : ?>
                    <?php echo get_field('tour_name', $filteredResult->postObject) ?>
                <?php else : ?>
                    <?php echo get_the_title($filteredResult->postObject) ?>
                <?php endif; ?>

            </div>
            <div class="search-result__content__description">
                <?php echo get_field('top_snippet', $filteredResult->postObject) ?>
            </div>
            <div class="search-result__content__info">
                <div class="search-result__content__info__price">
                    <div class="search-result__content__info__price__starting">
                        Starting from
                    </div>
                    <div class="search-result__content__info__price__amount">
                        <?php echo "$" . number_format($filteredResult->lowestPrice, 0);  ?>
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
    </a>
<?php endforeach; ?>


<form class="search-results__grid__pagination" form="search-form">
    <?php
    if ($pageCount != 1 && $pageNumber != 'all') : ?>
        <div class="search-results__grid__pagination__pages-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--back-button btn-circle btn-circle--left btn-circle--small  <?php echo ($pageNumber == 1) ? 'btn-circle--disabled' : ''; ?>" style="margin-right: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg>
            </button>
            <?php
            for ($k = 1; $k <= $pageCount; $k++) :
            ?>
                <button class="btn-circle btn-circle--small  <?php echo ($pageNumber == $k) ? 'btn-circle--current' : ''; ?> search-results__grid__pagination__pages-group__button " value="<?php echo $k ?>">
                    <?php echo $k ?>
                </button>
            <?php endfor;
            ?>
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--next-button btn-circle btn-circle--right btn-circle--small <?php echo ($pageNumber == $pageCount) ? 'btn-circle--disabled' : ''; ?>" style="margin-left: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </button>
        </div>
        <div class="search-results__grid__pagination__show-all-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--all-button btn-outline btn-outline--small btn-outline--dark">
                Show All
            </button>
        </div>

    <?php endif; ?>
    <input type="hidden" name="pageNumber" id="pageNumber" form="search-form" value="1">
</form>
<div id="pageNumberDisplay" style="display: none;" value="<?php echo $pageNumber ?>"> </div>
<div id="totalResultsDisplay" style="display: none;" value="<?php echo $resultsTotal ?>"> </div>


<?php
function sortPrice($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($a->lowestPrice, $b->lowestPrice);
    }
}
function sortPriceDescending($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($b->lowestPrice, $a->lowestPrice);
    }
}
?>