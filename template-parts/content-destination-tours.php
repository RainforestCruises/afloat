<?php
$destination = $args['destination'];
$region = $args['region'];

$locations = $args['locations'];
$destinations = $args['destinations'];

$tours = $args['tours'];
$tour_experiences = $args['tour_experiences'];
$currentYear = date("Y");
$destinationType = $args['destinationType'];

$background_map = get_field('background_map');
?>

<div class="destination-tours">

    <!-- Map Background -->
    <div class="destination-tours__bg">
        <img src="<?php echo esc_url($background_map['url']); ?>" alt="">
    </div>

    <!-- Intro -->
    <div class="destination-tours__intro">
        <div class="destination-tours__intro__description">
            <div class="destination-tours__intro__description__title">
                <?php echo get_field('intro_title') ?>

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
                    <?php if ($destinationType == 'destination') {
                        foreach ($locations as $s) : ?>
                            <li>
                                <a href="#"><?php echo ($s->hero_title); ?></a>
                            </li>
                        <?php endforeach;
                    } else if ($destinationType == 'region') {
                        foreach ($destinations as $d) : ?>
                            <li>
                                <a href="#"><?php echo ($d->hero_title); ?></a>
                            </li>
                    <?php endforeach;
                    } ?>

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
                        <?php if ($hero_image) { ?>
                            <div class="tours-card__image">
                                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
                            </div>
                        <?php } ?>

                        <div class="tours-card__content">
                            <div class="tours-card__content__tag-area">
                                <div class="tours-card__content__tag-area__tag">
                                    Best Seller
                                </div>

                            </div>
                            <div class="tours-card__content__text-area">
                                <div class="tours-card__content__text-area__country">
                                    <?php foreach ($countries as $c) : ?>
                                        <li>
                                            <?php echo get_the_title($c); ?>
                                        </li>

                                    <?php endforeach; ?>
                                </div>
                                <div class="tours-card__content__text-area__title">
                                    <?php echo get_field('tour_name', $t) ?>
                                </div>
                                <div class="tours-card__content__text-area__info">
                                    <div class="tours-card__content__text-area__info__length">
                                        <?php echo get_field('length', $t) ?>-Day Tour
                                    </div>
                                    <div class="tours-card__content__text-area__info__price">
                                        From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>



            </div>
        </div>

    </div>

    <!-- experiences -->
    <div class="destination-tours__experiences">
        <?php
        if ($tour_experiences) {
            foreach ($tour_experiences as $e) {
                $experience = $e['experience'];
                $background_image = $e['background_image'];
        ?>
                <div class="category-card">
                    <div class="category-card__image">
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="">
                    </div>

                    <div class="category-card__content">
                        <div class="category-card__content__title">
                            <?php echo get_the_title($experience); ?> Tours
                        </div>
                        <div class="category-card__content__availability">
                            <?php if ($destinationType == 'region') {
                                echo tours_available_region($region, $experience) . ' Tours Available';
                            } else if ($destinationType == 'destination') {
                                echo tours_available($destination, $experience) . ' Tours Available';
                            } ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <div class="destination-tours__lengths">
        <button class="btn-outline " href="#">7-Day</button>
        <button class="btn-outline " href="#">10-Day</button>
        <button class="btn-outline " href="#">14-Day</button>
        <button class="btn-outline btn-outline--dark " href="#">View All Tours</button>
    </div>
</div>