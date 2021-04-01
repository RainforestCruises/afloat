

<div class="product-reviews">
<h2 class="page-divider page-divider--padding u-margin-bottom-medium u-margin-top-small">
        Reviews
    </h2>

<div class="product-reviews__slider" id="reviews-slider">
    <?php
    $rows = get_field('testimonials');
    if ($rows) {
        foreach ($rows as $row) {
            $guest_thumbnail = $row['guest_thumbnail'];
            $testimonial_image = $row['testimonial_image'];
    ?>
            <div class="product-reviews__slider__item">
                <div class="product-reviews__slider__item__content">
                    <svg class="product-reviews__slider__item__content__quote">
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                    </svg>
                    <p class="product-reviews__slider__item__content__text"><?php echo $row['guest_review']; ?></p>
                    <h3 class="product-reviews__slider__item__content__date"><?php echo $row['review_date']; ?></h3>
                    <div class="product-reviews__slider__item__content__profile">
                        <img src="<?php echo esc_html($guest_thumbnail['url']); ?>" alt="" class="product-reviews__slider__item__content__profile__img">
                        <div class="product-reviews__slider__item__content__profile__user">
                            <div class="product-reviews__slider__item__content__profile__name">
                                <?php echo $row['guest_name']; ?>
                            </div>
                            <div class="product-reviews__slider__item__content__profile__location">
                                <?php echo $row['guest_location']; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <img src="<?php echo esc_html($testimonial_image['url']); ?>" alt="" class="product-reviews__slider__item__image">
            </div>
    <?php
        }
    } ?>
</div>
</div>
