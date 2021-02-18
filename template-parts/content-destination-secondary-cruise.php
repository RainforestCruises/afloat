<?php

$tours = $args['tours'];
$currentYear = date("Y");

$destination = get_field('destination_post');
$tour_experiences = get_field('tour_experiences');
?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <div class="destination-secondary__header__title page-divider">
            Cruise Packages
        </div>
        <div class="destination-secondary__header__sub-text">
        <?php echo get_field('tour_package_title_subtext') ?> 
               </div>
    </div>
    <div class="destination-main__packages">
        <div class="destination-main__packages__best-selling">

            <div class="destination-main__packages__best-selling__slider" id="main-slider">
                <?php foreach ($tours as $t) : ?>
                    <?php
                     $best_selling = get_field('best_selling', $t);

                     if ($best_selling) :
                    $hero_image = get_field('best_selling_image', $t);
                    $countries  = get_field('destinations', $t);
                    $price_packages = get_field('price_packages', $t);
                    $lowest = lowest_tour_price($price_packages, $currentYear);

                    ?>
                    <!-- Tour Card -->
                    <a class="tours-card" href="<?php echo get_permalink($t); ?>">
                        <?php if ($hero_image) { ?>
                            <div class="tours-card__image">
                                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
                            </div>
                        <?php } ?>

                        <div class="tours-card__content">
                            <div class="tours-card__content__tag-area">
                                <div class="tours-card__content__tag-area__tag">
                                    Best Seller
                                </div>

                            </div>
                            <div class="tours-card__content__text-area">
                                <div class="tours-card__content__text-area__country">
                                <?php foreach ($countries as $c) : 
                                        $isCountry = get_field('is_country', $c);
                                        if($isCountry) : ?>
                                        <li>
                                            <?php echo get_the_title($c); ?>
                                        </li>

                                    <?php endif; endforeach; ?>
                                </div>
                                <div class="tours-card__content__text-area__title">
                                    <?php echo get_field('tour_name', $t) ?>
                                </div>
                                <div class="tours-card__content__text-area__info">
                                    <div class="tours-card__content__text-area__info__length">
                                        <?php echo get_field('length', $t) ?>-Day Tour
                                    </div>
                                    <div class="tours-card__content__text-area__info__price">
                                        From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                <?php endif; endforeach; ?>
            </div>
        </div>
    </div>
    
    <?php $tour_lengths = get_field('tour_lengths') ?>

    <div class="destination-main__lengths">
    <?php if ($tour_lengths) : ?>
        <?php foreach ($tour_lengths as $length) :
            $link = $length['search_link'];
            
            if($length['min_days'] == $length['max_days']){
                $range = $length['min_days'];              
            }else{
                $range = $length['min_days'] . '-' . $length['max_days'];
            }        
        ?>
            <button class="btn-outline" onclick="location.href='<?php echo $link ?>'"><?php echo $range ?> Days</button>
        <?php endforeach; endif; ?>
        <button class="btn-outline btn-outline--dark " href="#">View All Tours</button>
    </div>


</div>