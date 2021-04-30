<?php
/*Template Name: About*/


wp_enqueue_script('page-about', get_template_directory_uri() . '/js/page-about.js', array('jquery'), false, true);

?>

<?php
get_header();

?>

<!-- About Page Container -->
<section class="about-page">



    <!-- Mission -->
    <section class="about-page__section-mission" id="mission">
        <?php
        get_template_part('template-parts/content', 'about-mission');
        ?>
    </section>

    <!-- Difference -->
    <section class="about-page__section-difference" id="differece">
        <?php
        get_template_part('template-parts/content', 'about-difference');
        ?>
    </section>

    <!-- Team -->
    <section class="about-page__section-team" id="team">
        <?php
        get_template_part('template-parts/content', 'about-team');
        ?>
    </section>

    <!-- Corporate -->
    <section class="about-page__section-corporate" id="corporate">
        <?php
        get_template_part('template-parts/content', 'about-corporate');
        ?>
    </section>

</section>




<?php get_footer(); ?>

<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>