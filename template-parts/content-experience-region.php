<?php

$regions = get_field('regions');
$experience = get_field('experience_post');


$first = $regions[0];

$picture = $first['image'];

$destinations = $first['destinations'];
?>


<div class="experience-region">

    <div class="experience-region__content">
    <div class="experience-region__content__accent-title">
                South America
            </div>
        <div class="experience-region__content__text">
          
            <div class="experience-region__content__text__title-group">
                <div class="experience-region__content__text__title-group__subtitle">
                    Luxury Travel
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

    <div class="experience-region__slider-area">

        <div class="experience-region__slider-area__slider" id="south-america-slider">
            <?php foreach ($destinations as $d) :
                $cardImage = $d['image'];
                $destinationPost = $d['destination_post']
            ?>

                <!-- Tour Card -->
                <a class="experience-card">
                    <div class="experience-card__image">
                        <img src="<?php echo esc_url($cardImage['url']); ?>" alt="">
                    </div>


                    <div class="experience-card__content">
                        <div class="experience-card__content__tag-area">
                        <?php if($d['tag'] != "") :?>
                            <div class="experience-card__content__tag-area__tag">
                            <?php echo $d['tag']?>
                            </div>
                        <?php endif; ?>
                        </div>
                        <div class="experience-card__content__text-area">            
                            <div class="experience-card__content__text-area__title">
                                <?php echo get_field('navigation_title', $destinationPost) ?>
                            </div>
                            <div class="experience-card__content__text-area__info">
                                <div class="experience-card__content__text-area__info__length"> 
                                   <?php echo tours_available($destinationPost, $experience) ?> Tours / 
                                   <?php echo cruises_available_experience($destinationPost, $experience) ?> Cruises Available
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</div>