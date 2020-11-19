<?php
$cruise_data = get_field('cruise_data');
$featured_image = get_field('featured_image');
$startingPrice = 0;

?>




<div class="product-overview">
    <!-- Intro -->
    <div class="product-intro">
        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <div class="product-intro__info__cta">

                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('overview_intro'); ?>
        </div>

    </div>
    <div id="sentinal-overview"></div>
    <div class="page-divider  u-margin-bottom-none product-overview__divider">
        <?php echo $args['propertyType'] ?> Overview
    </div>
    <!-- Description -->
    <div class="product-overview__description u-margin-bottom-medium">
        <div class="product-overview__description__detail">
            <div class="product-overview__description__detail__picture">
                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                <div class="product-overview__description__detail__picture__title">
                    <?php echo get_the_title() ?>
                </div>
            </div>
            <!-- Highlights ACF REPEATER -->
            <div class="product-overview__description__detail__highlights">
                <div class="heading-3 heading-3--underline">Highlights</div>
                <ul class="list-svg">
                    <?php if (have_rows('highlights')) : ?>
                        <?php while (have_rows('highlights')) : the_row(); ?>
                            <li>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                                <span><?php echo get_sub_field('highlight'); ?></span>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="product-overview__description__text drop-cap-1  u-margin-bottom-medium">
            <p> <?php echo get_field('overview_content') ?>
            </p>
        </div>
    </div>

    <div class="product-overview__btn  u-margin-bottom-medium">
        <button class="btn-outline goto-itineraries" href="#itineraries">View Itineraries</button>
    </div>
</div>