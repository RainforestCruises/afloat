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
        <div class="accommodations-card">
            <div class="accommodations-card__image">
                <img src="<?php echo esc_url($lodges_image['url']); ?>" alt="">
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                <?php echo $title; ?> Lodges
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $lodges_snippet; ?>
                </div>
            </div>
        </div>
        <!-- Card -->
        <div class="accommodations-card">
            <div class="accommodations-card__image">
                <img src="<?php echo esc_url($cruises_image['url']); ?>" alt="">
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                <?php echo $title; ?> Cruises
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $cruises_snippet; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="destination-accommodations__btn ">
        <button class="btn-outline  " href="#">View All Accommodation</button>
    </div>

</div>