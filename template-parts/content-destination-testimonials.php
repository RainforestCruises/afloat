<div class="destination-testimonials">
    <div class="destination-testimonials__header page-divider">
        Testimonials
    </div>
    <div class="destination-testimonials__slider" id="testimonials-slider">
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
                <div class="destination-testimonial">
                    <div class="destination-testimonial__content">
                        <div class="destination-testimonial__content__snippet">
                            <?php echo $t ?>
                        </div>
                        <div class="destination-testimonial__content__person">
                            - <?php echo $t_person ?>
                        </div>
                    </div>

                    <div class="destination-testimonial__image-area ">
                        <img <?php afloat_responsive_image($t_image['id'], 'vertical-medium', array('vertical-medium')); ?> alt="">
                    </div>
                </div>

        <?php
            endforeach;

        endif; ?>
    </div>
</div>