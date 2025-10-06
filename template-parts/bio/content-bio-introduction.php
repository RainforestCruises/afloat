<?php
$introduction_title = get_field('introduction_title');
$introduction_text = get_field('introduction_text');
$agent_gallery = get_field('agent_gallery');

?>

<div class="bio-introduction">
    <div class="bio-introduction__content" style="padding-bottom: 8rem !important; padding-top: 6rem !important;">

        <div class="bio-introduction__content__image-area">
            <div class="image-collage">
                <img class="image-collage__primary" <?php afloat_image_markup($agent_gallery[1]['id'], 'featured-medium', array('featured-medium', 'featured-small')); ?>>
                <img class="image-collage__secondary" <?php afloat_image_markup($agent_gallery[2]['id'], 'featured-small', array('featured-small')); ?>>
            </div>
        </div>
        <div class="bio-introduction__content__quote-area">
            <!-- Top - Title/Nav -->
            <div class="bio-introduction__content__quote-area__title">
                <?php echo $introduction_title; ?>

            </div>
            <!-- Slider Area -->
            <div class="bio-introduction__content__quote-area__text">
                <?php echo $introduction_text; ?>
                <svg class="bio-introduction__content__quote-area__text__quote">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                </svg>
            </div>
        </div>


    </div>
</div>