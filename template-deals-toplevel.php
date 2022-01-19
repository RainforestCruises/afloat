<?php
/*Template Name: Deals - Top Level*/
//wp_enqueue_script('page-deals', get_template_directory_uri() . '/js/page-deals.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php


$pageTitle = get_the_title();

$categories = get_posts(array(
    'post_type' => 'rfc_deal_categories',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

?>

<main class="deals-page">

    <!-- Content -->
    <section class="deals-page__section-hero">
        <?php
        get_template_part('template-parts/content', 'deals-hero');
        ?>
    </section>
    <section class="deals-page__section-best">
        <?php
        get_template_part('template-parts/content', 'deals-best');
        ?>
    </section>

</main>



<?php get_footer(); ?>