<div class="home-intro__top__content__testimonials__testimonial">
                            <div class="home-intro__top__content__testimonials__testimonial__image">
                                <img src="<?php echo esc_url($i_image['url']); ?>" alt="<?php echo get_post_meta($i_image['id'], '_wp_attachment_image_alt', TRUE) ?>">
                            </div>
                            <div class="home-intro__top__content__testimonials__testimonial__snippet">
                                <?php echo $i_snippet; ?>
                            </div>
                        </div>