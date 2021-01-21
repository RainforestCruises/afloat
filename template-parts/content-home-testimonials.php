<?php
$publications = get_field('publications');

?>

<div class="home-testimonials">
    <div class="home-testimonials__publications-title">
        As Featured In:
    </div>
    <div class="home-testimonials__publications">
        <?php if ($publications) :
            foreach ($publications as $p) :
                $p_image = $p['image'];
        ?>

                <div class="home-testimonials__publications__logo-area">
                    <img src="<?php echo esc_url($p_image['url']); ?>" alt="">
                </div>


        <?php endforeach;
        endif; ?>
    </div>
    <div class="home-testimonials__testimonials">
        <div class="home-testimonial">
            <div class="home-testimonial__content">
                <div class="home-testimonial__content__snippet">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus quisquam eum magni ipsa, commodi id delectus porro quo vero, et omnis a.
                </div>
                <div class="home-testimonial__content__person">
                    - Laura Bobby
                </div>
            </div>
            <div class="home-testimonial__image-area">
                <img src="<?php echo bloginfo('template_url') ?>/css/img/test-images/test-1.jpg" alt="">
            </div>
        </div>
    </div>
</div>