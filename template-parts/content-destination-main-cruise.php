<?php
$destination = $args['destination'];
$region = $args['region'];

$locations = $args['locations'];
$destinations = $args['destinations'];
$activities = $args['activities'];
$cruise_locations = get_field('cruise_countries');
//activities


$cruises = $args['cruises'];
$currentYear = date("Y");


$tours = $args['tours'];
$tour_experiences = $args['tour_experiences'];
$currentYear = date("Y");
$destinationType = $args['destinationType'];

$background_map = get_field('background_map');
?>

<div class="destination-main">

    <!-- Map Background -->
    <div class="destination-main__bg">
        <img src="<?php echo esc_url($background_map['url']); ?>" alt="">
    </div>

    <!-- Intro -->
    <div class="destination-main__intro">
        <div class="destination-main__intro__description">
            <div class="destination-main__intro__description__title">
                <?php echo get_field('intro_title') ?>

            </div>
            <div class="destination-main__intro__description__text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsam tempore ullam illo quasi quod. Totam libero doloremque accusantium iusto vero distinctio ipsa consequuntur in nulla? Consectetur sit deleniti dolor.
            </div>
        </div>
        <div class="destination-main__intro__lists">
            <div class="destination-main__intro__lists__locations">
                <div class="destination-main__intro__lists__locations__title">
                    Destinations
                </div>
                <ul class="destination-main__intro__lists__locations__list">
                    <?php if ($destinationType == 'destination' || $destinationType == 'cruise') {
                        foreach ($locations as $s) : ?>
                            <li>
                                <a href="#"><?php echo ($s->navigation_title); ?></a>
                            </li>
                        <?php endforeach;
                    } else if ($destinationType == 'region') {
                        foreach ($destinations as $d) : ?>
                            <li>
                                <a href="#"><?php echo ($d->navigation_title); ?></a>
                            </li>
                    <?php endforeach;
                    } ?>

                </ul>

            </div>
            <div class="destination-main__intro__lists__experiences">
                <div class="destination-main__intro__lists__experiences__title">
                    Experiences
                </div>
                <ul class="destination-main__intro__lists__experiences__list">
                    <?php foreach ($activities as $a) : ?>
                            <li>
                                <a href="#"><?php echo ($a->navigation_title); ?></a>
                            </li>
                        <?php endforeach; ?>
                </ul>

            </div>

        </div>
    </div>

    <!-- Cruises -->
    <div class="destination-main__packages">
        <div class="destination-main__packages__header">
            <div class="destination-main__packages__header__title page-divider">
                Cruises
            </div>
            <div class="destination-main__packages__header__sub-text">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
            </div>
        </div>



        <!-- Best Selling -->
        <div class="destination-main__packages__best-selling">
            <div class="destination-main__packages__best-selling__slider" id="main-slider">


                <?php foreach ($cruises as $c) : ?>
                    <?php
                    $hero_image = get_field('hero_image', $c);
                    $destinations  = get_field('destinations', $c);
                    //$price_packages = get_field('price_packages', $c);
                    $cruise_data = get_field('cruise_data', $c);
                    $lowest = lowest_property_price($cruise_data, 0, $currentYear);

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
                                    <?php countriesInDestinations($destinations, " / ") ?>
                                </div>
                                <div class="tours-card__content__text-area__title">
                                    <?php echo get_the_title($c) ?>
                                </div>
                                <div class="tours-card__content__text-area__info">
                                    <div class="tours-card__content__text-area__info__length">
                                    <?php echo itineraryRange($cruise_data, " - ") ?> Day Cruises
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
    <div class="destination-main__experiences">
        <?php
        if ($cruise_locations) {
            foreach ($cruise_locations as $c) {
                $location = $c['country'];
                $background_image = $c['background_image'];
        ?>
                <div class="category-card">
                    <div class="category-card__image">
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="">
                    </div>

                    <div class="category-card__content">
                        <div class="category-card__content__title">
                            <?php echo get_field('navigation_title', $location); ?> Cruises
                        </div>
                        <div class="category-card__content__availability">
                            <?php 
                                echo cruises_available_location($location) . ' Cruises Available';
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <div class="destination-main__lengths">
        <button class="btn-outline btn-outline--dark " href="#">View All Cruises</button>
    </div>
</div>