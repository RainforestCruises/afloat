<?php
/*Template Name: Experiences*/
wp_enqueue_script('page-experience', get_template_directory_uri() . '/js/page-experience.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php

$experience = get_field('experience_post');

?>

<div class="experience-page">

    <!-- Hero -->
    <section class="experience-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'experience-hero');
        ?>
    </section>

    <!-- Intro -->
    <section class="experience-page__section-intro" id="top">
        <?php
        get_template_part('template-parts/content', 'experience-intro');
        ?>
    </section>

    <!-- Regions -->
    <section class="experience-page__section-region" id="south-america">
        <?php
        get_template_part('template-parts/content', 'experience-region');
        ?>
    </section>

    <div class="svg-divider">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
        </svg>
    </div>
    <?php
    get_template_part('template-parts/content', 'shared-newsletter');
    ?>

</div>

<?php get_footer(); ?>


<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>