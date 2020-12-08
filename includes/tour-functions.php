<?php

//Get lowest price (Price From)
function lowest_tour_price($price_packages, $fromYear)
{

    $priceList = [];

    if ($price_packages) {
        foreach ($price_packages as $price_package) {
            if ($price_package['year'] >= $fromYear) {
                $priceList[] = $price_package['price'];
            }
        }
    }

    $lowestPrice = 0;
    if ($priceList) {
        sort($priceList);
        $lowestPrice = $priceList[0];
    }

    return $lowestPrice;
}

function tours_available($destination, $experience)
{
    $count = 0;
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_tours',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destination', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'experiences', // name of custom field
                'value' => '"' . $experience->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );
    $tourPosts = get_posts($postCriteria);
    $count = count($tourPosts);

    return $count;
}
