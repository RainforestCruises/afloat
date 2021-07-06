<img <?php afloat_responsive_image($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?> alt="">


<div class="home-hero__bottom">

        <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="scroll-down" href="#intro">
            <svg class="btn-circle--arrow-main">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
            </svg>
            <svg class="btn-circle--arrow-animate">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
            </svg>
        </button>
  

        <div class="home-hero__bottom__slide-nav" id="home-hero__bottom__slide-nav">
            <!-- Slider -->
            <?php foreach ($hero_slider as $s) :
                $sliderTitle = $s['title'];
                $sliderDestination = $s['destination'];
                $sliderDestinationPostId = get_the_id($sliderDestination);
            ?>
                <h5 class="home-hero__bottom__slide-nav__slide" postId="<?php echo $sliderDestinationPostId ?>">
                    <?php echo $sliderTitle; ?>
                </h5>

            <?php endforeach; ?>
        </div>
    </div>