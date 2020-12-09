<?php
$cruises_image = get_field('cruises_image');


?>

<div class="destination-testimonials">
    <div class="destination-testimonials__header page-divider">
        Testimonials
    </div>
    <div class="destination-testimonials__slider-container">
        <div class="destination-testimonials__slider-container__slider" id="testimonials-slider">
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
                        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae cumque adipisci omnis, repudiandae consequatur distinctio rerum officia obcaecati necessitatibus ipsum at placeat ex optio fugiat incidunt pariatur, sint cupiditate deserunt?"
                    </div>
                    <div class="testimonial-slide__text__reviewer">
                        - Mark Johnson
                    </div>
                </div>
                <div class="testimonial-slide__image">
                    <img src="<?php echo esc_url($cruises_image['url']); ?>" alt="">
                </div>
            </div>
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
                        "SLIDE 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae cumque adipisci omnis, repudiandae consequatur distinctio rerum officia obcaecati necessitatibus ipsum at placeat ex optio fugiat incidunt pariatur, sint cupiditate deserunt?"
                    </div>
                    <div class="testimonial-slide__text__reviewer">
                        - Mary Jones
                    </div>
                </div>
                <div class="testimonial-slide__image">
                    <img src="<?php echo esc_url($cruises_image['url']); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>