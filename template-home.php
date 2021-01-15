<?php
/*Template Name: Home*/
get_header(); ?>

<?php

$intro_image = get_field('intro_image');
?>

<div class="home-page">
    <!-- Hero -->
    <section class="home-page__section-hero" id="top">
        <!-- Destination Hero -->
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
                    <div class="home-intro__top__content__testimonial">
                        <div class="home-intro__top__content__testimonial__image">
                            Img
                        </div>
                        <div class="home-intro__top__content__testimonial__snippet">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi blanditiis sequi commodi. Excepturi, earum perferendis consectetur tenetur dolorum nisi libero et itaque totam, iste distinctio, incidunt non nobis enim consequatur.
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-intro__bottom">
                <div class="home-intro__bottom__feature">
                    feature
                </div>
                <div class="home-intro__bottom__feature">
                    feature
                </div>
                <div class="home-intro__bottom__feature">
                    feature
                </div>
            </div>
            <div class="home-intro__cta">
                CTA
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