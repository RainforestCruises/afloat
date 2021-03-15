<?php
/*Template Name: Expedition / Bucket */
wp_enqueue_script('page-experience', get_template_directory_uri() . '/js/page-experience.js', array('jquery'), false, true);
?>

<?php
get_header();
?>


<div class="experience-page">

    <!-- Hero -->
    <section class="experience-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'experience-hero');
        ?>
    </section>


    <!-- Sections -->
    <section class="experience-page__section-region" id="intro">
        <?php
        get_template_part('template-parts/content', 'experience-region-expedition');
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