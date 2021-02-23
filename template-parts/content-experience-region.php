<?php

$regions = get_field('regions');

$first = $regions[0];

$picture = $first['image'];

?>


<div class="experience-region">

    <div class="experience-region__content">

        <div class="experience-region__content__text">

            <div class="experience-region__content__text__title-group">
                <div class="experience-region__content__text__title-group__subtitle">
                    Unrivaled Something
                </div>
                <div class="experience-region__content__text__title-group__title">
                    South America
                </div>
            </div>
            <div class="experience-region__content__text__snippet">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem saepe voluptates mollitia exercitationem nulla animi dolorum? Explicabo odit nihil quas ab recusandae tenetur assumenda autem, voluptas ipsa reiciendis nemo reprehenderit.
            </div>
            <div class="experience-region__content__text__travel-types">
                <div class="experience-region__content__text__travel-types__group">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                    </svg>
                    <a href="">19 Tours Available</a>
                </div>
                <div class="experience-region__content__text__travel-types__group">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                    </svg>
                    <a href="">35 Cruises Available</a>
                </div>
            </div>
            <div class="experience-region__content__text__cta">
                <button class="btn-cta-square">
                    Explore
                    <svg>
                        <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-right"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="experience-region__content__image">
            <img src="<?php echo esc_url($picture['url']); ?>" alt="">

        </div>
    </div>

</div>