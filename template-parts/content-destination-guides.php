<?php
$destination = $args['destination'];
$cruises_image = get_field('cruises_image');

?>

<div class="destination-guides">
    <div class="destination-guides__header page-divider">
        Travel Guides
    </div>
    <div class="destination-guides__grid-container">
        <div class="destination-guides__grid-container__grid">
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--first">
                <img src="<?php echo esc_url($cruises_image['url']); ?>" alt="">
                <div class="destination-guides__grid-container__grid__item__content">
                    <div class="destination-guides__grid-container__grid__item__content__category">
                        Travel Guide
                    </div>
                    <div class="destination-guides__grid-container__grid__item__content__title">
                        Best Time to Visit Peru
                    </div>
                    <div class="destination-guides__grid-container__grid__item__content__link">
                        <button class="goto-button">
                            Read Guide
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                            </svg>
                        </button>

                    </div>
                </div>
            </div>
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--second">

            </div>
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--third">

            </div>
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--fourth">

            </div>
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--fifth">

            </div>
            <div class="destination-guides__grid-container__grid__item destination-guides__grid-container__grid__item--sixth">

            </div>
        </div>
    </div>


</div>