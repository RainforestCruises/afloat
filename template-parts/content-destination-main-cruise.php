<?php
$destination = $args['destination'];
$title = $args['title'];

$locations = $args['locations'];
$activities = $args['activities'];

$cruise_locations = get_field('cruise_countries');

$cruises = $args['cruises'];
$currentYear = date("Y");


$currentYear = date("Y");
$destinationType = $args['destinationType'];

$background_map = get_field('background_map');
$highlights = get_field('highlights');

$cruise_experiences = get_field('cruise_experiences');
console_log($activities);

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


        </div>
        <div class="destination-main__intro__lists">
            <div class="destination-main__intro__lists__locations">
                <div class="destination-main__intro__lists__locations__title">
                    Destinations
                </div>
                <ul class="destination-main__intro__lists__locations__list">
                    <?php if ($locations) : ?>
                        <?php foreach ($locations as $l) : ?>
                            <?php $location =  $l['location']; ?>
                            <li>
                                <a href="#"><?php echo $location; ?></a>
                            </li>
                    <?php endforeach;
                    endif; ?>

                </ul>

            </div>
            <div class="destination-main__intro__lists__experiences">
                <div class="destination-main__intro__lists__experiences__title">
                    Things to do
                </div>
                <ul class="destination-main__intro__lists__experiences__list">
                    <?php if ($activities) : ?>
                        <?php foreach ($activities as $a) : ?>
                            <?php $activity =  $a['activity']; ?>
                            <li>
                                <a href="#"><?php echo ($activity->navigation_title); ?></a>
                            </li>
                    <?php endforeach;
                    endif; ?>
                </ul>
            </div>

        </div>
    </div>

    <!-- Cruises -->
    <div class="destination-main__packages">
        <div class="destination-main__packages__header">
            <div class="destination-main__packages__header__title page-divider">
                <?php echo $title ?> Cruises
            </div>
            <div class="destination-main__packages__header__sub-text">
                <?php echo get_field('cruise_title_subtext') ?>
            </div>
        </div>



        <!-- Best Selling - use secondary slider-->
        <div class="destination-secondary__best-selling">
            <div class="destination-secondary__best-selling__slider" id="secondary-slider">


                <?php foreach ($cruises as $c) : ?>
                    <?php
                    $featured_image = get_field('featured_image', $c);
                    $destinations  = get_field('destinations', $c);
                    $cruise_data = get_field('cruise_data', $c);
                    $lowest = lowest_property_price($cruise_data, 0, $currentYear);
                    ?>
                    <!-- Tour Card -->



                    <a class="product-card" href="<?php echo get_permalink($c); ?>">
                        <?php if ($featured_image) { ?>
                            <div class="product-card__image">
                                <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                            </div>
                        <?php } ?>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <div class="product-card__bottom__title-group__product-name">
                                    <?php echo get_the_title($c) ?>
                                </div>
                                <div class="product-card__bottom__title-group__price">
                                    <span class="from-price">From</span> <?php echo "$" . number_format($lowest, 0);  ?> <span class="currency-price">USD</span>
                                </div>
                            </div>
                            <div class="product-card__bottom__text">
                                <?php echo get_field('top_snippet', $c) ?>
                            </div>
                            <div class="product-card__bottom__info">
                                <?php echo itineraryRange($cruise_data, " - ") ?> Day Cruises
                            </div>
                        </div>
                    </a>


                <?php endforeach; ?>



            </div>
        </div>

    </div>

    <?php
    $cruise_lengths = get_field('cruise_lengths');
    $cruise_search_link = get_field('cruise_search_link');
    ?>

    <!-- countries -->
    <?php $hideDesinations = get_field('hide_cruise_destinations') ?>
    <?php if ($hideDesinations == false) : ?>
        <div class="destination-main__experiences-title">
            <?php echo $title ?> Destinations
        </div>
        <div class="destination-main__experiences-sub-text">
            <?php echo get_field('cruise_destination_title_subtext') ?>
        </div>

        <div class="destination-main__experiences">
            <?php
            if ($cruise_locations) {
                //need to fix link - parameter / prefilter 'location'
                foreach ($cruise_locations as $c) {
                    $location = $c['country'];
                    $background_image = $c['background_image'];
                    $link = $cruise_search_link . '?travelLocation=' . $location->ID;
            ?>
                    <a class="category-card" href="<?php echo $link ?>">
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
                    </a>
            <?php
                }
            }
            ?>
        </div>
    <?php endif; ?>
    <!-- experiences -->


    <div class="destination-main__experiences-title">
        <?php echo $title ?> Experiences
    </div>
    <div class="destination-main__experiences-sub-text">
        <?php echo get_field('cruise_experience_title_subtext') ?>
    </div>
    <div class="destination-main__experiences">
        <?php
        if ($cruise_experiences) {
            foreach ($cruise_experiences as $e) {
                $experience = $e['cruise_experience'];
                $background_image = $e['background_image'];
                $search_link = $e['search_page_link'];

        ?>
                <a class="category-card" href="<?php echo $search_link ?>">
                    <div class="category-card__image">
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="">
                    </div>

                    <div class="category-card__content">
                        <div class="category-card__content__title">
                            <?php echo get_the_title($experience); ?> Cruises
                        </div>
                        <div class="category-card__content__availability">
                            <?php echo cruises_available_experience($destination, $experience) . ' Cruises Available';
                            ?>
                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>
    </div>



    <div class="destination-main__lengths">
    <?php if ($cruise_lengths) : ?>
            <?php foreach ($cruise_lengths as $length) :
                $link = $length['link'];
                $buttonText = $length['button_text'];            
            ?>
                <a class="btn-outline" href="<?php echo $link; ?>"><?php echo $buttonText ?></a>
        <?php endforeach;
        endif;
        ?>
        <a class="btn-outline " href="<?php echo $cruise_search_link; ?>">View All Cruises</a>
    </div>
</div>