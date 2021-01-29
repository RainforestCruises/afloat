<?php
$intro_image = get_field('intro_image');
$intro_testimonials = get_field('intro_testimonials');
console_log($intro_image['ID']);
$intro_image = image_get_intermediate_size($intro_image['ID'], 'thumbnail' );
?>
<div class="home-intro">
            <div class="home-intro__top">
                <img class="home-intro__top__img" src="<?php  echo esc_url($intro_image['url']); ?>" alt="">
                <div class="home-intro__top__content">
                    <div class="home-intro__top__content__pretitle">
                        <?php echo get_field('intro_pretitle'); ?>
                    </div>
                    <div class="home-intro__top__content__title">
                        <?php echo get_field('intro_title'); ?>
                    </div>
                    <div class="home-intro__top__content__testimonials" id="intro-testimonials">
                        <?php if ($intro_testimonials) :
                            foreach ($intro_testimonials as $i) :
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