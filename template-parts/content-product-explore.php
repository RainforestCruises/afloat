<div class="areas-slider">
    <div class="areas-slider__slider-nav" id="areas-slider__slider-nav">
        <?php
        $areaImages = get_field('areas_gallery');
        if ($areaImages) : ?>
            <?php foreach ($areaImages as $areaImage) : ?>
                <div class="areas-slider__slider-nav__item">
                    <?php echo esc_html($areaImage['title']); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="areas-slider__slider-for">
        <?php
        if ($areaImages) : ?>
            <?php foreach ($areaImages as $areaImage) : ?>
                <div class="areas-slider__slider-for__item" id="areas-slider__slider-for">
                    <img class="areas-slider__slider-for__item__img" src="<?php echo esc_html($areaImage['url']); ?>" alt="">
                    <div class="areas-slider__slider-for__item__title"><?php echo esc_html($areaImage['title']); ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>