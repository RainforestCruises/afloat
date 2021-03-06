<?php
$publications = get_field('publications');
$testimonials = get_field('testimonials');

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
        <div class="home-testimonials__testimonials__slider" id="main-testimonials">
            <?php if ($testimonials) :
                foreach ($testimonials as $t) :
                    $t_image = $t['image'];
                    $t_person_name = $t['person_name'];
                    $t_snippet = $t['snippet'];
            ?>
                    <!-- Testimonial -->
                    <div class="home-testimonial">
                        <div class="home-testimonial__content">
                            <div class="home-testimonial__content__snippet">
                                <?php echo $t_snippet ?>
                            </div>
                            <div class="home-testimonial__content__person">
                                - <?php echo $t_person_name ?>
                            </div>
                        </div>
                        <div class="home-testimonial__image-area">
                            <img src="<?php echo esc_url($t_image['url']); ?>" alt="">
                        </div>
                    </div>

            <?php endforeach;
            endif; ?>
        </div>




    </div>
</div>