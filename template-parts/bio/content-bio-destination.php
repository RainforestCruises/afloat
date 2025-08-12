<?php
$destination_memorable = get_field('destination_memorable');
$destination_memorable_image = get_field('destination_memorable_image');
$destination_memorable_description = get_field('destination_memorable_description');
$destination_memorable_link = get_field('destination_memorable_link');

$destination_bucket_list = get_field('destination_bucket_list');
$destination_bucket_list_image = get_field('destination_bucket_list_image');
$destination_bucket_list_description = get_field('destination_bucket_list_description');
$destination_bucket_list_link = get_field('destination_bucket_list_link');



?>


<div class="bio-destination">
    <div class="bio-destination__content">

        <!-- Memorable -->
        <div class="bio-place">
            <div class="bio-place__image">
                <img <?php afloat_image_markup($destination_memorable_image['id'], 'featured-large'); ?>>
            </div>
            <h2 class="bio-place__title">
                My Most Memorable Trip
            </h2>
            <div class="bio-place__name">
                <?php echo $destination_memorable; ?>
            </div>
            <div class="bio-place__description">
                <?php echo $destination_memorable_description; ?>
            </div>
            <a class="bio-place__link" href="<?php echo $destination_memorable_link; ?>">

                <span>
                    Discover <?php echo $destination_memorable; ?>
                </span>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </a>
        </div>

        <!-- Bucket List -->
        <div class="bio-place">
            <div class="bio-place__image">
                <img <?php afloat_image_markup($destination_bucket_list_image['id'], 'featured-large'); ?>>
            </div>
            <h2 class="bio-place__title">
                On My Bucket List
            </h2>
            <div class="bio-place__name">
                <?php echo $destination_bucket_list; ?>
            </div>
            <div class="bio-place__description">
                <?php echo $destination_bucket_list_description; ?>
            </div>
            <a class="bio-place__link" href="<?php echo $destination_bucket_list_link; ?>">

                <span>
                    Discover <?php echo $destination_bucket_list; ?>
                </span>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </a>
        </div>

    </div>

</div>