<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php

$searchType = get_field('search_type');



$destination = null;
$region = null;


if ($searchType == 'region') {
    $region = get_field('region');
} else {
    $region = get_field('region', $destination);
    $destination = get_field('destination');
}


$destinationTitle = get_field('navigation_title', $destination);
$regionTitle = get_field('navigation_title', $region);




$args = array(
    'destination' => $destination,
    'region' => $region,
    'searchType' => $searchType,
);

?>

<div class="search-page">

    <?php
    get_template_part('template-parts/content', 'search-intro');
    ?>

    <!-- Content -->
    <div class="search-page__content">
        <?php

        get_template_part('template-parts/content', 'search-sidebar', $args);  

        get_template_part('template-parts/content', 'search-results');

        ?>
    </div>

    <!-- Bottom -->
    <!-- <div class="search-page__bottom">
        bottom
    </div> -->
</div>



<?php get_footer(); ?>