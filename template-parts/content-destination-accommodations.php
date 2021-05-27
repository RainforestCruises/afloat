<?php

$cruises_image = get_field('cruises_image');
$lodges_image = get_field('lodges_image');
$cruises_snippet = get_field('cruises_snippet');
$lodges_snippet = get_field('lodges_snippet');
$title = $args['title'];


?>
<div class="destination-accommodations">
    <div class="destination-accommodations__header">
        <div class="destination-accommodations__header__title page-divider">
            Accommodation
        </div>
        <div class="destination-accommodations__header__sub-text">
            <?php echo get_field('accommodations_title_subtext') ?>
        </div>
    </div>
    <div class="destination-accommodations__group">
        <!-- Card -->
        <a class="accommodations-card" href="<?php echo get_field('lodge_accommodation_search_link'); ?>">
            <div class="accommodations-card__image">
                <?php if ($lodges_image) : ?>
                    <img <?php afloat_responsive_image($lodges_image['id'], 'featured-medium', array('featured-medium', 'featured-small')); ?> alt="">
                <?php endif; ?>
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                    <?php echo $title; ?> Lodges
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $lodges_snippet; ?>
                </div>
            </div>
        </a>
        <!-- Card -->
        <a href="<?php echo get_field('cruise_accommodation_search_link'); ?>" class="accommodations-card">
            <div class="accommodations-card__image">
                <?php if ($cruises_image) : ?>
                    <img <?php afloat_responsive_image($cruises_image['id'], 'featured-medium', array('featured-medium', 'featured-small')); ?> alt="">
                <?php endif; ?>
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                    <?php echo $title; ?> Cruises
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $cruises_snippet; ?>
                </div>
            </div>
        </a>
    </div>


</div>