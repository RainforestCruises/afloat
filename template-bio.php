<?php
/*Template Name: Bio*/
get_header();

wp_enqueue_script('page-bio', get_template_directory_uri() . '/js/page-bio.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-bio',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);


?>


<main class="bio-page">

    <!-- Content -->
    <section class="bio-page__section-hero">
        <?php
        get_template_part('template-parts/bio/content', 'bio-hero');
        ?>
    </section>
    <section class="bio-page__section-introduction">
        <?php
        get_template_part('template-parts/bio/content', 'bio-introduction');
        ?>
    </section>
    <section class="bio-page__section-destination">
        <?php
        get_template_part('template-parts/bio/content', 'bio-destination');
        ?>
    </section>
    <section class="bio-page__section-reviews">
        <?php
        get_template_part('template-parts/bio/content', 'bio-reviews');
        ?>
    </section>
    <section class="bio-page__section-destination">
        <?php
        get_template_part('template-parts/bio/content', 'bio-destination-part2');
        ?>
    </section>
    <section class="bio-page__section-tips">
        <?php
        get_template_part('template-parts/bio/content', 'bio-tips');
        ?>
    </section>
    <section class="bio-page__section-articles">
        <?php
        get_template_part('template-parts/bio/content', 'bio-articles');
        ?>
    </section>
</main>


<?php get_footer(); ?>