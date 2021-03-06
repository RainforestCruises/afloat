<?php
$destination = $args['destination'];
$is_bucket_list = get_field('is_bucket_list', $destination);
$locations = $args['locations'];
$activities = $args['activities'];
$title = $args['title'];

$tours = $args['tours'];
$tour_experiences = $args['tour_experiences'];
$currentYear = date("Y");
$destinationType = $args['destinationType'];

$background_map = get_field('background_map');
$highlights = get_field('highlights');

console_log($locations);

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
                <?php echo get_field('intro_text') ?>
            </div>

            <?php
            if ($destinationType == 'region') :
                if ($highlights) : ?>
                    <ul class="destination-main__intro__description__highlights">
                        <?php
                        foreach ($highlights as $h) : ?>
                            <li>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                                </svg>
                                <span>
                                    <?php echo $h['highlight'] ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
            <?php endif;
            endif; ?>

        </div>
        <div class="destination-main__intro__lists">
            <div class="destination-main__intro__lists__locations">
                <div class="destination-main__intro__lists__locations__title">
                    Destinations
                </div>
                <ul class="destination-main__intro__lists__locations__list">
                    <?php
                    if ($locations) :
                        foreach ($locations as $l) : ?>
                            <?php $location = ($destinationType == 'region') ? $l['destination'] : $l['location'] ?>
                            <li>
                                <?php echo get_field('navigation_title', $location); ?>
                            </li>
                    <?php endforeach;
                    endif;

                    ?>

                </ul>

            </div>
            <div class="destination-main__intro__lists__experiences">
                <div class="destination-main__intro__lists__experiences__title">
                    <?php echo ($destinationType == 'destination') ? 'Things to do' : 'Experiences' ?>
                </div>
                <ul class="destination-main__intro__lists__experiences__list">

                    <?php if ($destinationType == 'destination') {
                        if ($activities) :
                            foreach ($activities as $a) : ?>
                                <?php $activity = $a['activity'] ?>
                                <li>
                                    <?php echo get_field('navigation_title', $activity); ?>
                                </li>
                        <?php endforeach;
                        endif; ?>
                        <?php } else if ($destinationType == 'region') {
                        if (have_rows('tour_experiences')) : ?>
                            <?php while (have_rows('tour_experiences')) : the_row();
                                $experience = get_sub_field('experience');
                            ?>
                                <li>
                                    <?php echo get_the_title($experience); ?>
                                </li>
                            <?php endwhile; ?>
                    <?php endif;
                    } ?>
                </ul>
            </div>

        </div>
    </div>

    <!-- Packages -->
    <div class="destination-main__packages">
        <div class="destination-main__packages__header">
            <div class="destination-main__packages__header__title page-divider">
                <?php echo $title ?> <?php echo ($is_bucket_list) ? ' Tour Packages' : ' Vacation Packages' ?>
            </div>
            <div class="destination-main__packages__header__sub-text">
                <?php echo get_field('tour_package_title_subtext') ?>
            </div>
        </div>



        <!-- Best Selling -->
        <div class="destination-main__packages__best-selling">
            <div class="destination-main__packages__best-selling__slider" id="main-slider">


                <?php foreach ($tours as $t) : ?>
                    <?php
                    $best_selling = get_field('best_selling', $t);

                    if ($best_selling) :
                        $hero_image = get_field('best_selling_image', $t);
                        $countries  = get_field('destinations', $t);
                        $price_packages = get_field('price_packages', $t);
                        $lowest = lowest_tour_price($price_packages, $currentYear);

                    ?>
                        <!-- Tour Card -->
                        <a class="tours-card" href="<?php echo get_permalink($t); ?>">
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
                                        <?php foreach ($countries as $c) :
                                            $isCountry = get_field('is_country', $c);
                                            if ($isCountry) : ?>
                                                <li>
                                                    <?php echo get_the_title($c); ?>
                                                </li>

                                        <?php endif;
                                        endforeach; ?>
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
                        </a>
                <?php endif;
                endforeach; ?>



            </div>
        </div>

    </div>

    <!-- experiences -->
    <div class="destination-main__experiences">
        <?php
        if ($tour_experiences) {
            foreach ($tour_experiences as $e) {
                $experience = $e['experience'];
                $background_image = $e['background_image'];
                $search_link = $e['search_link'];

        ?>
                <a class="category-card" href="<?php echo $search_link ?>">
                    <div class="category-card__image">
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="">
                    </div>

                    <div class="category-card__content">
                        <div class="category-card__content__title">
                            <?php echo get_the_title($experience); ?> Tours
                        </div>
                        <div class="category-card__content__availability">
                            <?php if ($destinationType == 'region') {
                                echo tours_available_region($destination, $experience) . ' Tours Available';
                            } else if ($destinationType == 'destination') {
                                echo tours_available($destination, $experience) . ' Tours Available';
                            } ?>
                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>
    </div>
    <?php
    $tour_lengths = get_field('tour_lengths');
    $tour_search_link = get_field('tour_search_link');
    ?>

    <div class="destination-main__lengths">
        <?php if ($tour_lengths) : ?>
            <?php foreach ($tour_lengths as $length) :
                $link = $length['link'];
                $buttonText = $length['button_text'];            
            ?>
                <a class="btn-outline" href="<?php echo $link; ?>"><?php echo $buttonText ?></a>
        <?php endforeach;
        endif;
        ?>
        <a class="btn-outline btn-outline--dark " href="<?php echo $tour_search_link; ?>">View All Tours</a>
    </div>
</div>