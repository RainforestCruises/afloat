    <?php
    $areaImages = get_field('areas_gallery');
    ?>


    <!-- H2 Title -->
    <h2 class="page-divider page-divider--padding u-margin-bottom-small">
        Accommodations
    </h2>


    <!-- Common Areas Gallery -->
    <div class="product-areas">
        <div class="product-areas__slider-nav">
            <?php
            if ($areaImages) : ?>
                <?php foreach ($areaImages as $areaImage) : ?>
                    <div class="product-areas__slider-nav__item">
                        <?php echo esc_html($areaImage['title']); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="product-areas__slider">
            <?php
            if ($areaImages) : ?>
                <?php foreach ($areaImages as $areaImage) : ?>
                    <div class="product-areas__slider__item">
                        <img <?php afloat_responsive_image($areaImage['id'], 'featured-large', array('featured-large', 'featured-medium')); ?> alt="">

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>