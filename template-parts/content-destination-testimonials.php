<div class="home-testimonials">
    <h2 class="home-testimonials__publications-title">
        Testimonials
    </h2>
    <div class="home-testimonials__testimonials">
        <div class="home-testimonials__testimonials__slider" id="testimonials-slider">
            <?php
            $testimonials = get_field('testimonials');
            if ($testimonials) :
                foreach ($testimonials as $testimonial) :
                    $t = $testimonial['testimonial'];
                    $t_person = $testimonial['person'];
                    $t_image = $testimonial['image'];
            ?>
                    <!-- Slide -->
                    <!-- Testimonial -->
                    <div class="testimonial">
                        <div class="testimonial__content">
                            <div class="testimonial__content__snippet">
                                <?php echo $t ?>
                            </div>
                            <div class="testimonial__content__person">
                                - <?php echo $t_person ?>
                            </div>
                        </div>

                        <div class="testimonial__image-area ">
                            <img <?php afloat_responsive_image($t_image['id'], 'vertical-medium', array('vertical-medium')); ?>>
                        </div>
                    </div>

            <?php
                endforeach;

            endif; ?>
        </div>
    </div>
</div>