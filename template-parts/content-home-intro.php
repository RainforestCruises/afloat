<?php
$intro_image = get_field('intro_image');
$intro_testimonials = get_field('intro_testimonials');

?>





<div class="home-intro">
    <div class="home-intro__top">
        <div class="home-intro__top__image-area">
            <img <?php afloat_responsive_image($intro_image['id'], 'vertical-medium', array('vertical-medium')); ?> alt="" class="home-intro__top__img">

        </div>

        <div class="home-intro__top__content">
            <h2 class="home-intro__top__content__pretitle">
                <?php echo get_field('intro_pretitle'); ?>
            </h2>
            <h3 class="home-intro__top__content__title">
                <?php echo get_field('intro_title'); ?>
            </h3>
            <div class="home-intro__top__content__testimonials">
                <?php if ($intro_testimonials) :
                        //$i = $intro_testimonials[0];
                        $i_image = $intro_testimonials[0]['avatar'];
                        $i_snippet = $intro_testimonials[0]['snippet'];
                ?>
                        <div class="home-intro__top__content__testimonials__testimonial">
                            <div class="home-intro__top__content__testimonials__testimonial__image">
                                <img src="<?php echo esc_url($i_image['url']); ?>" alt="">
                            </div>
                            <div class="home-intro__top__content__testimonials__testimonial__snippet">
                                <?php echo $i_snippet; ?>
                            </div>
                        </div>
              
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="home-intro__bottom">
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('first_icon'); ?>
            </div>
            <h4 class="home-intro__bottom__feature__title">
                <?php echo get_field('first_title'); ?>
            </h4>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('first_snippet'); ?>
            </div>
        </div>
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('second_icon'); ?>
            </div>
            <h4 class="home-intro__bottom__feature__title">
                <?php echo get_field('second_title'); ?>
            </h4>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('second_snippet'); ?>
            </div>
        </div>
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('third_icon'); ?>
            </div>
            <h4 class="home-intro__bottom__feature__title">
                <?php echo get_field('third_title'); ?>
            </h4>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('third_snippet'); ?>
            </div>
        </div>
    </div>
  

</div>