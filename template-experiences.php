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

    <section class="experience-page__section-region" id="south-america">
        <?php
        get_template_part('template-parts/content', 'experience-region');
        ?>
    </section>


    <section class="travel-guide-newsletter">
        <div class="travel-guide-newsletter__content">
            <div class="travel-guide-newsletter__content__title">
                <?php echo get_field('newsletter_title', 'options'); ?>
            </div>
            <div class="travel-guide-newsletter__content__text">
                <?php echo get_field('newsletter_snippet', 'options'); ?>
            </div>
            <div class="travel-guide-newsletter__content__email">
                <input type="text" placeholder="Enter your email" class="travel-guide-newsletter__content__email__input">
                <button class="travel-guide-newsletter__content__email__button">Submit</button>
            </div>
        </div>
        <div class="travel-guide-newsletter__image">
        <?php $newsletter_image = get_field('newsletter_image', 'options'); ?>
            <img src="<?php echo esc_url($newsletter_image['url']); ?>" alt="">
        </div>
    </section>

</div>

<?php get_footer(); ?>


<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>