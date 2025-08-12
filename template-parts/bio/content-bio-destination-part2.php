<?php
$destination_favorite = get_field('destination_favorite');
$destination_favorite_image = get_field('destination_favorite_image');
$destination_favorite_description = get_field('destination_favorite_description');
$destination_favorite_link = get_field('destination_favorite_link');

$destination_hotel = get_field('destination_hotel');
$destination_hotel_image = get_field('destination_hotel_image');
$destination_hotel_description = get_field('destination_hotel_description');
$destination_hotel_link = get_field('destination_hotel_link');



?>


<div class="bio-destination">
    <div class="bio-destination__content">

        <!-- favorite -->
        <div class="bio-place">
            <div class="bio-place__image">
                <img <?php afloat_image_markup($destination_favorite_image['id'], 'featured-large'); ?>>
            </div>
            <h2 class="bio-place__title">
                My Most favorite Trip
            </h2>
            <div class="bio-place__name">
                <?php echo $destination_favorite; ?>
            </div>
            <div class="bio-place__description">
                <?php echo $destination_favorite_description; ?>
            </div>
            <a class="bio-place__link" href="<?php echo $destination_favorite_link; ?>">

                <span>
                    Discover <?php echo $destination_favorite; ?>
                </span>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </a>
        </div>

        <!-- Bucket List -->
        <div class="bio-place">
            <div class="bio-place__image">
                <img <?php afloat_image_markup($destination_hotel_image['id'], 'featured-large'); ?>>
            </div>
            <h2 class="bio-place__title">
                My Favorite Hotel
            </h2>
            <div class="bio-place__name">
                <?php echo $destination_hotel; ?>
            </div>
            <div class="bio-place__description">
                <?php echo $destination_hotel_description; ?>
            </div>
            <a class="bio-place__link" href="<?php echo $destination_hotel_link; ?>">

                <span>
                    Discover <?php echo $destination_hotel; ?>
                </span>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </a>
        </div>

    </div>

</div>