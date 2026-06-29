<?php
/*Template Name: Press*/


wp_enqueue_script('page-about', get_template_directory_uri() . '/js/page-about.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-about',
    'page_vars',
    array(
      'templateUrl' =>  $templateUrl
    )
  );
?>

<?php
get_header();

?>

<!-- About Page Container -->
<main class="about-page">

    <!-- Intro -->
    <section class="about-page__section-mission" id="intro">
        <?php
        get_template_part('template-parts/press/content', 'press-intro');
        ?>
    </section>

    <!-- Difference -->
    <section class="about-page__section-difference" id="differece">
        <?php
        get_template_part('template-parts/press/content', 'press-releases');
        ?>
    </section>

    <!-- Team -->
    <section class="about-page__section-team" id="team">
        <?php
        get_template_part('template-parts/press/content', 'press-team');
        ?>
    </section>

    <!-- Newsletter -->
    <section class="about-page__section-newsletter" id="newsletter">
        <?php
        get_template_part('template-parts/press/content', 'press-newsletter');
        ?>
    </section>

</main>


<?php get_footer(); ?>

