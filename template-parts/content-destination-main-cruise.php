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

?>

<div class="destination-main">

    <!-- Map Background -->
    <div class="destination-main__bg">
        <img src="<?php echo esc_url($background_map['url']); ?>" alt="">
    </div>

    <!-- Intro -->
    <div class="destination-main__intro">
        <div class="destination-main__intro__description">
            <div class="destination-main__intro__description__title" id="intro">
                <?php echo get_field('intro_title') ?>

            </div>
            <div class="destination-main__intro__description__text">
                <?php echo get_field('intro_text') ?>
            </div>
            <?php if ($highlights) : ?>
                <div class="destination-main__intro__description__highlights-title">
                    Highlights
                </div>
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
            <?php endif; ?>

        </div>
        
    </div>

    <!-- Cruises -->
    <div class="destination-main__packages" id="cruises">
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
                    $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                    ?>
                    <!-- Tour Card -->



                    <a class="product-card" href="<?php echo get_permalink($c); ?>">
                    <div class="product-card__image-area">
                        <?php if ($featured_image) : ?>
                            <img <?php afloat_responsive_image($featured_image['id'], 'featured-medium', array('featured-medium')); ?> alt="">
                        <?php endif; ?>
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <div class="product-card__bottom__title-group__product-name">
                                <?php echo get_the_title($c) ?>
                            </div>

                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo get_field('top_snippet', $c) ?>
                        </div>
                        <div class="product-card__bottom__info">


                            <div class="product-card__bottom__info__length-group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                                <div class="product-card__bottom__info__length-group__length">
                                    <?php echo itineraryRange($cruise_data, " - ") ?> Days
                                </div>
                            </div>
                            <div class="product-card__bottom__info__price-group">
                                <div class="product-card__bottom__info__price-group__from">From</div>
                                <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($lowestPrice, 0);  ?> <span>USD</span></div>
                            </div>
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
        <div class="sub-divider destination-main__experiences-title">
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


    <div class="sub-divider destination-main__experiences-title">
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
                        <?php if ($background_image) : ?>
                            <img <?php afloat_responsive_image($background_image['id'], 'pill-large', array('pill-large', 'pill-small')); ?> alt="">
                        <?php endif; ?>
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