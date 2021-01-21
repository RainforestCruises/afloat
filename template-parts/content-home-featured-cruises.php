<?php
$featured_cruise_destinations = get_field('featured');

?>

<div class="home-featured">
    <div class="home-featured__header">
        <div class="home-featured__header__title page-divider">
            Cruise Destinations
        </div>
        <div class="home-featured__header__sub-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero aperiam nostrum eum excepturi et quas neque soluta iusto quae, eligendi cumque dicta dolore sed reprehenderit iure ex, blanditiis nesciunt eos.
        </div>
    </div>
    <div class="home-featured__content-area">
        <div class="home-featured__content-area__slider" id="featured-cruises">
            <?php if ($featured_cruise_destinations) :
                foreach ($featured_cruise_destinations as $c) :
                    $cruise_page = $c['cruise_page']; //get permalink
                    $c_snippet = $c['snippet'];
                    $c_title = $c['title'];
                    $c_image = $c['image'];
            ?>
                    <!-- Cruise Item -->
                    <div class="home-featured-item">
                        <div class="home-featured-item__title">
                            <?php echo $c_title ?>
                        </div>
                        <div class="home-featured-item__content">
                            <div class="home-featured-item__content__text">
                                <?php echo $c_snippet ?>
                            </div>
                            <div class="home-featured-item__content__cta">
                                <button class="goto-button goto-button--dark">Learn More
                                    <svg>
                                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="home-featured-item__image-area">
                            <img src="<?php echo esc_url($c_image['url']); ?>" alt="">
                        </div>
                    </div>

            <?php endforeach;
            endif; ?>



        </div>

    </div>
</div>