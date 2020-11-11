<?php
$functionArgs = $args;

$postsFromSearch = $functionArgs->products;
$sortOrder = $functionArgs->sortOrder;
//$dateRange = $functionArgs->dateRange;


//console_log($dateRange);
$count = 0;

$results = [];
foreach ($postsFromSearch as $post) {
    $cruise_data = get_field('cruise_data', $post);
    $lowest = $cruise_data['LowestPrice'];
    $highest = $cruise_data['HighestPrice'];

    $results[] = (object) array(
        'postObject' => $post, 
        'cruise_data' => get_field('cruise_data', $post),
        'lowestPrice' => $lowest,
        'highestPrice' => $highest,
    );

}
if($sortOrder == 'ASC'){
    usort($results, "sortPrice");
}

if($sortOrder == 'DESC'){
    usort($results, "sortPriceDescending");
}



foreach ($results as $result) {
    $featured_image = get_field('featured_image', $result->postObject);
    $cruise_data = get_field('cruise_data', $result->postObject);
    $count++;

?>



    <!-- Result -->
    <a class="search-result" href="<?php echo get_permalink($result->postObject); ?>" target="_blank">
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
                <?php echo $cruise_data['LowestLengthInDays']; ?>-<?php echo $cruise_data['HighestLengthInDays']; ?> Day Cruise
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
                        <?php echo "$" . number_format($cruise_data['LowestPrice'], 0);  ?>
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
function sortPrice($a, $b) {
    if(is_object($a) && is_object($b)){
        return strcmp($a->lowestPrice, $b->lowestPrice);
    }
}
function sortPriceDescending($a, $b) {
    if(is_object($a) && is_object($b)){
        return strcmp($b->lowestPrice, $a->lowestPrice);
    }
}
?>

