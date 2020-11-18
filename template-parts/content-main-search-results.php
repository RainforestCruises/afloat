<?php
$functionArgs = $args;

$postsFromSearch = $functionArgs->products;
$sortOrder = $functionArgs->sortOrder;
$startDate = $functionArgs->startDate;
$endDate = $functionArgs->endDate;
$minLength = $functionArgs->minLength;
$maxLength = $functionArgs->maxLength;


$results = [];
foreach ($postsFromSearch as $post) {
    $cruise_data = get_field('cruise_data', $post);
    $lowest = $cruise_data['LowestPrice'];
    $highest = $cruise_data['HighestPrice'];
    $postType = get_post_type($post);
    if ($postType == 'rfc_tours') {
        $lowest = '5000';
    }

    $results[] = (object) array(
        'postObject' => $post,
        'cruise_data' => get_field('cruise_data', $post),
        'lowestPrice' => $lowest,
        'highestPrice' => $highest,
        'postType' => $postType,

    );
}
if ($sortOrder == 'ASC') {
    usort($results, "sortPrice");
}

if ($sortOrder == 'DESC') {
    usort($results, "sortPriceDescending");
}

console_log($results);
foreach ($results as $result) {
    $featured_image = get_field('featured_image', $result->postObject);
    $cruise_data = get_field('cruise_data', $result->postObject);

    $hasAvailability = false;
    $hasRange = false;




    if ($result->postType == 'rfc_tours') {
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

        if ($hasAvailability == false || $hasRange == false) {
            continue;
        }
    }

//NOTES
//loop all to get count 
//create filtered list
//use for pagination
?>



    <!-- Result -->
    <a class="search-result" href="<?php echo get_permalink($result->postObject); ?>" >
        <div class="search-result__image">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
        </div>
        <div class="search-result__content">
            <div class="search-result__content__tag">
                <div class="badge-solid badge-solid--small">
                    Popular
                </div>
            </div>
            <div class="search-result__content__length">
                <?php if ($result->postType == 'rfc_tours') { ?>
                    Tour Package
                <?php } else if ($result->postType == 'rfc_cruises') { ?>
                    <?php echo $cruise_data['LowestLengthInDays']; ?>-<?php echo $cruise_data['HighestLengthInDays']; ?> Day Cruise
                <?php } else if ($result->postType == 'rfc_lodges') { ?>
                    Lodge & Land Tour
                <?php } ?>
            </div>
            <div class="search-result__content__title">
                <?php echo get_the_title($result->postObject) ?>
            </div>
            <div class="search-result__content__description">
                <?php echo get_field('top_snippet', $result->postObject) ?>
            </div>
            <div class="search-result__content__info">
                <div class="search-result__content__info__price">
                    <div class="search-result__content__info__price__starting">
                        Starting from
                    </div>
                    <div class="search-result__content__info__price__amount">
                        <?php echo "$" . number_format($result->lowestPrice, 0);  ?>
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



<?php }
?>









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