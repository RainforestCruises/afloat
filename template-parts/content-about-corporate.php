<?php

$badges = get_field('badges');

?>

<div class="about-partners">
    <div class="about-partners__content">
        <div class="about-partners__content__title">
            Our Partners 
        </div>
        <div class="about-partners__content__snippet">
            <?php echo get_field('partners_snippet'); ?>

        </div>
    </div>
</div>

<div class="about-corporate">
    <div class="about-corporate__grey">
        <div class="about-corporate__grey__content">
            <div class="about-corporate__grey__content__corporate-info">
                <div class="about-corporate__grey__content__corporate-info__title">
                    Corporate Information
                </div>
                <div class="about-corporate__grey__content__corporate-info__snippet">
                    <?php echo get_field('corporate_snippet'); ?>
                </div>
            </div>
            <div class="about-corporate__grey__content__contact-details">
                <div class="about-corporate__grey__content__contact-details__title">
                    Contact Details
                </div>
                <div class="about-corporate__grey__content__contact-details__snippet">
                    <?php echo get_field('contact_details'); ?>
                </div>
            </div>
            <div class="about-corporate__grey__content__badge-area">
                <?php foreach ($badges as $badge) : ?>

                    <img <?php afloat_responsive_image($badge['id'], 'square-small', array('square-small')); ?> alt="">

                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <div class="about-corporate__image-area">
        <?php $background_image = get_field('background_image'); ?>
        <img <?php afloat_responsive_image($background_image['id'], 'full-hero-small', array('full-hero-small')); ?> alt="">

    </div>

</div>