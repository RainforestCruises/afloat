<?php
$reviews = get_field('reviews');
?>

<div class="bio-reviews">
    <h2 class="bio-reviews__title">
        What My Clients Say
    </h2>
    <div class="bio-reviews__testimonials">
        <div class="bio-reviews__testimonials__slider" id="reviews-slider">
            <?php

            if ($reviews) :
                foreach ($reviews as $review) :
                    $description = $review['description'];
                    $person = $review['person'];
                    $date = $review['date'];
            ?>
                    <!-- Slide -->
                    <!-- Testimonial -->
                    <div class="bio-testimonial">
                        <svg class="bio-testimonial__quote">
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                        </svg>

                        <div class="bio-testimonial__snippet">
                            <?php echo $description ?>
                        </div>
                        <div class="bio-testimonial__stars">
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
                        <div class="bio-testimonial__person">
                            - <?php echo $person ?>, <?php echo $date ?>
                        </div>
                    </div>

            <?php
                endforeach;
            endif; ?>
        </div>
    </div>
</div>