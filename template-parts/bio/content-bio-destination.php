<?php
$destinations = get_field('destinations');
$firstDestinationGroup = array_slice($destinations, 0, 2);
?>



<div class="bio-destination">
    <div class="bio-destination__content">

        <?php foreach ($firstDestinationGroup as $destination) :
            $category = $destination['category'];
            $name = $destination['name'];
            $image = $destination['image'];
            $description = $destination['description'];
            $link = $destination['link'] . $destination['anchor'];
        ?>

            <!-- Bucket List -->
            <div class="bio-place">
                <div class="bio-place__image">
                    <img <?php afloat_image_markup($image['id'], 'featured-large'); ?>>
                </div>
                <h2 class="bio-place__title">
                    <?php echo $category; ?>
                </h2>
                <div class="bio-place__name">
                    <?php echo $name; ?> </div>
                <div class="bio-place__description">
                    <?php echo $description; ?>
                </div>
                <?php if ($link != null) : ?>
                    <a class="bio-place__link" href="<?php echo $link; ?>">

                        <span>
                            Discover <?php echo $name; ?>
                        </span>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>

</div>