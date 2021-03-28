    <!-- H2 Title -->
    <h2 class="page-divider u-margin-bottom-small">
        Accommodations
    </h2>

    <div class="product-areas">
        <div class="product-areas__slider-nav">
            <?php
            $areaImages = get_field('areas_gallery');
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
                    <div class="product-areas__slider__item" >
                        <img src="<?php echo esc_html($areaImage['url']); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>