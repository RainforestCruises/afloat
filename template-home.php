<?php
/*Template Name: Home*/
wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
get_header();

?>


<div class="home-page">

    <!-- Hero -->
    <section class="home-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'home-hero');
        ?>

    </section>

    <!-- Intro -->
    <section class="home-page__section-intro" id="intro">
        <?php
        get_template_part('template-parts/content', 'home-intro');
        ?>
    </section>

    <!-- Destinations -->
    <section class="home-page__section-destinations" id="destinations">
        <?php
        get_template_part('template-parts/content', 'home-destinations');
        ?>
    </section>

    <!-- Featured Cruises -->
    <section class="home-page__section-featured">
        <?php
        get_template_part('template-parts/content', 'home-featured-cruises');
        ?>
    </section>

    <!-- Featured Bucket List -->
    <section class="home-page__section-featured">
        <?php
        get_template_part('template-parts/content', 'home-featured-bucket-list');
        ?>
    </section>

    <!-- Testimonials -->
    <section class="home-page__section-testimonials">
        <?php
        get_template_part('template-parts/content', 'home-testimonials');
        ?>
    </section>

</div>


<?php get_footer(); ?>


<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>