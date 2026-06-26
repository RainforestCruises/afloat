<?php

$press = get_field('Press');
$releases = get_field('releases');

?>

<div class="about-difference">
    <h2 class="destination-main__packages__header__title page-divider" style="margin-bottom: 4rem;">
        In The Press
    </h2>
    <div class="about-difference__slider-area">
        <div class="about-difference__slider-area__slider" id="difference-slider">
            <?php
            if ($press) :
                foreach ($press as $slide) :
            ?>
                    <div class="difference-card">
                        <div class="difference-card__bg">
                            <?php $image =  $slide['image'] ?>
                            <img <?php afloat_image_markup($image['id'], 'full-hero-large'); ?>>

                        </div>
                        <div class="difference-card__content">
                            <a href="<?php echo $slide['link'] ?>" target="_blank">
                                <h3 class="difference-card__content__title">
                                    <?php echo $slide['title'] ?>
                                </h3>

                            </a>

                            <div class="difference-card__content__snippet">
                                <?php echo $slide['snippet'] ?>
                            </div>
                        </div>
                    </div>

            <?php
                endforeach;
            endif;

            ?>
        </div>

    </div>


    <h2 class="destination-main__packages__header__title page-divider" style="margin-bottom: 4rem; margin-top: 8rem;">
        Press Releases
    </h2>
    <div class="destination-secondary__best-selling__slider" id="featured-slider">
        <?php
        foreach ($releases as $p) :
            $featured_image = get_field('featured_image', $p);
            $imageID = '';
            if ($featured_image) {
                $imageID = $featured_image['ID'];
            }
            $guideCategories = get_field('categories', $p);


        ?>
            <a class="product-card" href="<?php echo get_permalink($p); ?>">

                <div class="product-card__image-area">
                    <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>

                    <ul class="product-card__image-area__destinations">
                        <?php if ($guideCategories) :
                            foreach ($guideCategories as $c) : ?>
                                <li>
                                    <?php
                                    $catTitle = get_the_title($c);
                                    echo trim($catTitle);
                                    ?>
                                </li>
                        <?php endforeach;
                        endif;  ?>
                    </ul>

                </div>

                <div class="product-card__bottom">
                    <div class="product-card__bottom__title-group">
                        <h3 class="product-card__bottom__title-group__product-name">
                            <?php echo get_field('navigation_title', $p); ?>
                        </h3>
                    </div>
                    <div style="font-size: 1.4rem; padding: 2rem 1rem">
                        <?php
                        echo get_the_excerpt($p);
                        ?>
                    </div>

                </div>
            </a>

        <?php endforeach; ?>
    </div>

</div>