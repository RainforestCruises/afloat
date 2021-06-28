<?php

$regions = get_field('regions');
$experience = get_field('experience_post');
$is_charter = get_field('is_charter');

$count = 0;

?>



<?php foreach ($regions as $r) :
    $region_post = $r['region_post'];
    $destinations = $r['destinations'];



    $count++;


?>

    <div class="experience-region">
        <div class="experience-region__content">
            <div class="experience-region__content__accent-title">
                <?php echo get_field('navigation_title', $region_post) ?>
            </div>
            <div class="experience-region__content__text">

                <div class="experience-region__content__text__title-group">
                    <h4 class="experience-region__content__text__title-group__subtitle">
                        <?php echo $r['subtitle'] ?>
                    </h4>
                    <h2 class="experience-region__content__text__title-group__title">
                        <?php echo $r['title'] ?>
                    </h2>
                </div>
                <div class="experience-region__content__text__snippet">
                    <?php echo $r['snippet'] ?>
                </div>
                <div class="experience-region__content__text__travel-types">

                    <div class="experience-region__content__text__travel-types__group">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                        </svg>

                        <?php
                        if (!$is_charter) : ?>
                            <a href="<?php echo $r['explore_link'] . '?travel_style=rfc_cruises' ?>"><?php echo cruises_available_region($region_post, $experience, false) ?> Cruises Available</a>
                        <?php else : ?>
                            <a href="<?php echo $r['explore_link']  ?>"><?php echo cruises_available_region($region_post, null, true) ?> Cruises Available</a>
                        <?php endif;
                        ?>

                    </div>
                    <?php if (!$is_charter) : ?>
                        <div class="experience-region__content__text__travel-types__group">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                            </svg>
                            <a href="<?php echo $r['explore_link'] . '?travel_style=rfc_tours' ?>"><?php echo tours_available_region($region_post, $experience) ?> Tours Available</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="experience-region__content__text__cta">
                    <a class="btn-cta-square" href="<?php echo $r['explore_link'] ?>"">
                    <span>
                    Explore
                    </span>
                        
                        <svg>
                            <use xlink:href=" <?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="experience-region__content__image">
                <!-- responsive -->
                <img <?php afloat_responsive_image($r['image']['id'], 'vertical-medium', array('vertical-medium')); ?> alt="">

            </div>
        </div>

        <div class="experience-region__slider-area">

            <div class="experience-region__slider-area__slider" id="region-slider-<?php echo $count; ?>">
                <?php foreach ($destinations as $d) :
                    $cardImage = $d['image'];
                    $destinationPost = $d['destination_post']
                ?>

                    <!-- Tour Card -->
                    <a class="wide-slider-card" href="<?php echo $d['search_link'] ?>">
                        <div class="wide-slider-card__image">
                            <img <?php afloat_responsive_image($cardImage['id'], 'wide-slider-medium', array('wide-slider-medium', 'wide-slider-small')); ?> alt="">
                        </div>


                        <div class="wide-slider-card__content">
                            <div class="wide-slider-card__content__tag-area">
                                <?php if ($d['tag'] != "") : ?>
                                    <div class="wide-slider-card__content__tag-area__tag">
                                        <?php echo $d['tag'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="wide-slider-card__content__text-area">
                                <h3 class="wide-slider-card__content__text-area__title">
                                    <?php echo get_field('navigation_title', $destinationPost) ?>
                                </h3>
                                <h5 class="wide-slider-card__content__text-area__info">
                                    <div class="wide-slider-card__content__text-area__info__length">

                                        <?php
                                        if (!$is_charter) :
                                            echo tours_available($destinationPost, $experience) . ' Tours / ' . cruises_available_experience($destinationPost, $experience) . ' Cruises Available';
                                        else :
                                            echo cruises_available_charter($destinationPost) . ' Cruises Available';
                                        endif;
                                        ?>


                                    </div>
                                </h5>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
<?php endforeach; ?>