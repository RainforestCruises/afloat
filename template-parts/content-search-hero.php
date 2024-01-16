<?php

$hero_image = get_field('hero_image');
$hero_title = get_field('hero_title');
$hero_snippet = get_field('hero_snippet');
$features = get_field('features');
$publications = get_field('publications', 'options');

?>

<!-- Hero -->
<section class="experience-page__section-hero" id="top">

    <!--  Hero -->
    <div class="experience-hero">
        <div class="experience-hero__bg">
            <img <?php afloat_image_markup($hero_image['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?>>

        </div>


        <div class="experience-hero__content">
            <div class="experience-hero__content__title-group">
                <div class="experience-hero__content__title-group__divider">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                    </svg>
                </div>
                <h1 class="experience-hero__content__title-group__title">
                    <?php echo $hero_title ?>
                </h1>
            </div>
            <div class="experience-hero__content__snippet">
                <?php echo $hero_snippet ?>
            </div>
            <div class="experience-hero__content__cta">
                <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#intro">
                    <svg class="btn-circle--arrow-main">
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                    </svg>
                    <svg class="btn-circle--arrow-animate">
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                    </svg></button>
            </div>
        </div>

    </div>

</section>

<section class="experience-page__section-intro">
    <!--  Intro -->
    <div class="experience-intro">
        <?php foreach ($features as $feature) : ?>
            <div class="experience-intro__feature">
                <div class="experience-intro__feature__icon">
                    <?php echo $feature['icon']; ?>
                </div>
                <h2 class="experience-intro__feature__title">
                    <?php echo $feature['title']; ?>
                </h2>
                <div class="experience-intro__feature__snippet">
                    <?php echo $feature['snippet']; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="search-testimonials">
    <h2 class="search-testimonials__title">
        As Featured In
    </h2>
    <div class="search-testimonials__publications">
        <?php if ($publications) :
            foreach ($publications as $p) :
                $p_image = $p['image'];
        ?>

                <div class="search-testimonials__publications__logo-area">
                    <img src="<?php echo esc_url($p_image['url']); ?>" alt="<?php echo get_post_meta($p_image['id'], '_wp_attachment_image_alt', TRUE) ?>">
                </div>
        <?php endforeach;
        endif; ?>
    </div>
    </div>
   
</section>