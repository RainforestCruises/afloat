<?php
$cruises_image = get_field('cruises_image');

?>

<div class="destination-testimonials">
    <div class="destination-testimonials__header page-divider">
        Testimonials
    </div>
    <div class="destination-testimonials__slider-container">
        <div class="destination-testimonials__slider-container__slider" id="testimonials-slider">
            <?php
            $rows = get_field('testimonials');
            if ($rows) {
                foreach ($rows as $row) {
                    $person = $row['person'];
                    $test = $row['testimonial'];
                    $testimonialImage = $row['image'];
            ?>
                    <!-- Slide -->
                    <div class="testimonial-slide">
                        <div class="testimonial-slide__text">
                            <div class="testimonial-slide__text__stars">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                            </div>
                            <div class="testimonial-slide__text__review">
                                "<?php echo $test; ?>"
                            </div>
                            <div class="testimonial-slide__text__reviewer">
                                - <?php echo $person; ?>
                            </div>
                        </div>
                        <div class="testimonial-slide__image">
                            <img src="<?php echo esc_html($testimonialImage['url']); ?>" alt="">
                        </div>

                    </div>

            <?php
                }
            } ?>
        </div>
    </div>
</div>