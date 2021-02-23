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

    <section class="experience-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'experience-hero');
        ?>
    </section>

    <div class="experience-page__section-region" id="south-america">
        <?php
        get_template_part('template-parts/content', 'experience-region');
        ?>
    </div>



</div>

<?php get_footer(); ?>


<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>