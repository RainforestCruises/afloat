<?php
/*Template Name: Home*/
wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);

get_header(); ?>

<?php

$intro_image = get_field('intro_image');
$intro_testimonials = get_field('intro_testimonials');

?>

<div class="home-page">
    <!-- Hero -->
    <section class="home-page__section-hero" id="top">
        <!--  Hero -->
        <div class="home-hero">
            <img src="<?php echo bloginfo('template_url') ?>/css/img/test-images/peru-01.jpg" alt="" class="home-hero__bg">
            <div class="home-hero__content">
                <div class="home-hero__content__title-group">
                    <div class="home-hero__content__title-group__title">
                        An Experience Far From Ordinary
                    </div>
                    <div class="home-hero__content__title-group__divider">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                        </svg>
                    </div>
                    <div class="home-hero__content__title-group__subtitle">
                        Tailor Made Adventure Travel
                    </div>
                </div>
                <div class="home-hero__content__cta">
                    <button class="home-hero__content__cta__button">
                        Explore Destinations
                    </button>
                </div>
                <form class="home-hero__content__search-form">
                    <!-- Destination -->
                    <div class="home-hero__content__search-form__form-group">
                        <div class="home-hero__content__search-form__form-group__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                            </svg>
                        </div>
                        <div class="home-hero__content__search-form__form-group__input-group">
                            <label for="destination" class="home-hero__content__search-form__form-group__input-group__label">Destination</label>
                            <input class="home-hero__content__search-form__form-group__input-group__input" id="destination" tabindex="1" placeholder="Where would you like to go?">

                            </input>
                        </div>

                    </div>

                    <!-- Dates -->
                    <div class="home-hero__content__search-form__form-group">
                        <div class="home-hero__content__search-form__form-group__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-event-confirm"></use>
                            </svg>
                        </div>
                        <div class="home-hero__content__search-form__form-group__input-group">
                            <label for="dates" class="home-hero__content__search-form__form-group__input-group__label">Travel
                                Date</label>
                            <input type="text" class="home-hero__content__search-form__form-group__input-group__input" id="dates" tabindex="1" placeholder="When would you like to travel?" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Intro -->
    <section class="home-page__section-intro" id="intro">
        <div class="home-intro">
            <div class="home-intro__top">
                <img class="home-intro__top__img" src="<?php echo esc_url($intro_image['url']); ?>" alt="">
                <div class="home-intro__top__content">
                    <div class="home-intro__top__content__pretitle">
                        <?php echo get_field('intro_pretitle'); ?>
                    </div>
                    <div class="home-intro__top__content__title">
                        <?php echo get_field('intro_title'); ?>
                    </div>
                    <div class="home-intro__top__content__testimonials" id="intro-testimonials">
                        <?php if ($intro_testimonials) :
                        foreach($intro_testimonials as $i) :
                            //$i = $intro_testimonials[0];
                            $i_image = $i['avatar'];
                            $i_snippet = $i['snippet'];
                        ?>
                            <div class="home-intro__top__content__testimonials__testimonial">
                                <div class="home-intro__top__content__testimonials__testimonial__image">
                                    <img src="<?php echo esc_url($i_image['url']); ?>" alt="">
                                </div>
                                <div class="home-intro__top__content__testimonials__testimonial__snippet">
                                    <?php echo $i_snippet; ?>
                                </div>
                            </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                </div>
            </div>
            <div class="home-intro__bottom">
                <div class="home-intro__bottom__feature">
                    <div class="home-intro__bottom__feature__icon">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                        </svg>
                    </div>
                    <div class="home-intro__bottom__feature__title">
                        <?php echo get_field('first_title'); ?>
                    </div>
                    <div class="home-intro__bottom__feature__snippet">
                        <?php echo get_field('first_snippet'); ?>
                    </div>
                </div>
                <div class="home-intro__bottom__feature">
                    <div class="home-intro__bottom__feature__icon">
                    <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-money-bag"></use>
                        </svg>
                    </div>
                    <div class="home-intro__bottom__feature__title">
                        <?php echo get_field('second_title'); ?>
                    </div>
                    <div class="home-intro__bottom__feature__snippet">
                        <?php echo get_field('second_snippet'); ?>
                    </div>
                </div>
                <div class="home-intro__bottom__feature">
                    <div class="home-intro__bottom__feature__icon">
                    <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-laugh-17"></use>
                        </svg>
                    </div>
                    <div class="home-intro__bottom__feature__title">
                        <?php echo get_field('third_title'); ?>
                    </div>
                    <div class="home-intro__bottom__feature__snippet">
                        <?php echo get_field('third_snippet'); ?>
                    </div>
                </div>
            </div>
            <div class="home-intro__cta">
                <button class="btn-outline">Learn More</button>
            </div>

        </div>
    </section>

    <!-- Destinations -->
    <section class="home-page__section-destinations" id="destinations">
        <div class="home-destinations">
            Destinations
        </div>
    </section>
</div>


<?php get_footer(); ?>