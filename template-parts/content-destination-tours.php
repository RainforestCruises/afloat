<?php
$destination = $args['destination'];
$locations = $args['locations'];
$tours = $args['tours'];
$tour_experiences = $args['tour_experiences'];
$currentYear = date("Y");

?>

<div class="destination-tours">

    <!-- Map Background -->
    <div class="destination-tours__bg">
        <img src="<?php echo bloginfo('template_url') ?>/css/img/test-images/map-peru-outline.png" alt="">
    </div>

    <!-- Intro -->
    <div class="destination-tours__intro">
        <div class="destination-tours__intro__description">
            <div class="destination-tours__intro__description__title">
                Travel In Peru
            </div>
            <div class="destination-tours__intro__description__text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsam tempore ullam illo quasi quod. Totam libero doloremque accusantium iusto vero distinctio ipsa consequuntur in nulla? Consectetur sit deleniti dolor.
            </div>
        </div>
        <div class="destination-tours__intro__lists">
            <div class="destination-tours__intro__lists__locations">
                <div class="destination-tours__intro__lists__locations__title">
                    Destinations
                </div>
                <ul class="destination-tours__intro__lists__locations__list">
                    <?php foreach ($locations as $s) : ?>
                        <li>
                            <a href="#"><?php echo ($s->post_title); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
            <div class="destination-tours__intro__lists__experiences">
                <div class="destination-tours__intro__lists__experiences__title">
                    Experiences
                </div>
                <ul class="destination-tours__intro__lists__experiences__list">
                    <?php if (have_rows('tour_experiences')) : ?>
                        <?php while (have_rows('tour_experiences')) : the_row(); 
                        $experience = get_sub_field('experience'); 
                        ?>
                            <li>       
                                <a href="#"><?php echo get_the_title($experience); ?></a>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>

            </div>

        </div>
    </div>

    <!-- Packages -->
    <div class="destination-tours__packages">
        <div class="destination-tours__packages__header">
            <div class="destination-tours__packages__header__title page-divider">
                Tour Packages
            </div>
            <div class="destination-tours__packages__header__sub-text">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
            </div>
        </div>



        <!-- Best Selling -->
        <div class="destination-tours__packages__best-selling">
            <div class="destination-tours__packages__best-selling__slider" id="tours-slider">


                <?php foreach ($tours as $t) : ?>
                    <?php
                    $hero_image = get_field('hero_image', $t);
                    $countries  = get_field('countries', $t);
                    $price_packages = get_field('price_packages', $t);
                    $lowest = lowest_tour_price($price_packages, $currentYear);

                    ?>
                    <!-- Tour Card -->
                    <div class="tours-card">
                        <div class="tours-card__image">
                            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
                        </div>
                        <div class="tours-card__content">
                            <div class="tours-card__content__tag-area">
                                <div class="tours-card__content__tag-area__tag">
                                    Best Seller
                                </div>
                            </div>
                            <div class="tours-card__content__title-area">
                                <div class="tours-card__content__title-area__country">
                                    <?php foreach ($countries as $c) : ?>
                                        <li>
                                            <?php echo get_the_title($c); ?>
                                        </li>

                                    <?php endforeach; ?>
                                </div>
                                <div class="tours-card__content__title-area__title">
                                    <?php echo get_field('length', $t) ?>-Day <?php echo get_field('tour_name', $t) ?>
                                </div>
                                <div class="tours-card__content__title-area__price">
                                    From <?php echo "$" . number_format($lowest, 0); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>



            </div>
        </div>

    </div>

    <!-- Categories -->
    <div class="destination-tours__categories">
        <div class="category-card">
            <div class="category-card__image">
                <img src="<?php echo bloginfo('template_url') ?>/css/img/test-images/classic-peru-hero.jpg" alt="">
            </div>
            <div class="category-card__content">
                <div class="category-card__content__title">
                    Adventure Tours
                </div>
                <div class="category-card__content__availability">
                    4 Tours Available
                </div>
            </div>
        </div>

      
    </div>
</div>