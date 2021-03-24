<?php
$cruise_data = get_field('cruise_data');
$featured_image = get_field('featured_image');
$charter_view = false;

if ($args['propertyType'] == 'Cruise') {
    if ($args['charter_view'] == true) {
        $charter_view = true;
    }
}
?>


<div class="product-overview">

    <!-- Intro -->
    <div class="product-intro">
        <!-- Info -->
        <div class="product-intro__info">
            <?php if ($charter_view == false) : ?>
                <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <?php else : ?>
                <div class="product-intro__info__starting-price">Charter: <span><?php echo "$" . number_format($args['charter_daily_price'], 0); ?> </span> <span class="u-small-text"> / Day</span></div>
            <?php endif; ?>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('overview_intro'); ?>
        </div>
    </div>


    <!-- H2 Title -->
    <div id="sentinal-overview"></div>
    <h2 class="page-divider product-overview__divider">
        <?php echo $args['propertyType'] ?> Overview
    </h2>

    <!-- Description  -->
    <div class="product-overview__description u-margin-bottom-medium">
        <div class="product-overview__description__detail">
            <div class="product-overview__description__detail__picture">
                <img class="product-overview__description__detail__picture__img" src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                <div class="product-overview__description__detail__picture__title">
                    <?php echo get_the_title() ?>
                </div>
            </div>
            <!-- Highlights ACF REPEATER -->
            <aside class="product-overview__description__detail__highlights">
                <h3 class="heading-3 heading-3--underline">Highlights</h3>
                <ul class="list-svg">
                    <?php if (have_rows('highlights')) : ?>
                        <?php while (have_rows('highlights')) : the_row(); ?>
                            <li>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                                </svg>
                                <span><?php echo get_sub_field('highlight'); ?></span>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </aside>
        </div>
        <div class="product-overview__description__text drop-cap-1 ">
            <?php echo get_field('overview_content') ?>
        </div>
    </div>

    <div class="product-overview__btn  u-margin-bottom-medium">
        <button class="btn-outline goto-itineraries" href="#itineraries">View Itineraries</button>
    </div>
</div>