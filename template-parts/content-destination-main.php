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
$has_video = get_field('has_video');
$vimeo_link = get_field('vimeo_link');
$video_hero_card = get_field('video_hero_card');

?>

<div class="destination-main">

    <!-- Map Background -->
    <div class="destination-main__bg">
        <?php if ($background_map) : ?>
            <img <?php afloat_image_markup($background_map['id'], 'bg-portrait'); ?>>
        <?php endif; ?>
    </div>

    <!-- Intro -->
    <div class="destination-main__intro">
        <div class="destination-main__intro__description">

            <h2 class="destination-main__intro__description__title" id="intro">
                <?php echo get_field('intro_title') ?>
            </h2>
            <div class="destination-main__intro__description__text">
                <div class="destination-main__intro__description__text__content">
                    <?php echo get_field('intro_text') ?>
                </div>
                <?php if ($has_video) : ?>
                    <div class="destination-main__intro__description__text__play-mobile">
                        <button class="btn-outline btn-outline--dark video-play-button" style="margin: none">Watch Video</button>
                    </div>
                    <div class="destination-main__intro__description__text__video">
                        <video class="destination-main__intro__description__text__video__source" muted autoplay loop id="hero-video-card">
                            <source src="<?php echo esc_url($video_hero_card); ?>" type="video/mp4">
                        </video>
                        <div class="destination-main__intro__description__text__video__cta">
                            <button class="video-play-button dark">
                                <div class="video-play-button__icon-area">
                                    <div class="video-play-button__icon-area__inner">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-button-play"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div class="video-play-button__text">
                                    Watch The Video
                                </div>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($highlights) : ?>
                <h3 class="destination-main__intro__description__highlights-title">
                    Highlights
                </h3>
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

    <!-- Packages -->
    <div class="destination-main__packages" id="packages">
        <div class="destination-main__packages__header">
            <h2 class="destination-main__packages__header__title page-divider">
                <?php echo $title ?> <?php echo ($is_bucket_list) ? ' Tour Packages' : ' Vacation Packages' ?>
            </h2>
            <div class="destination-main__packages__header__sub-text">
                <?php echo get_field('tour_package_title_subtext') ?>
            </div>
        </div>

        <!-- Best Selling -->

        <?php
        $filteredTours = [];
        $tourCount = 0;
        foreach ($tours as $t) {
            $best_selling = ($destinationType != 'region') ? get_field('best_selling', $t) : get_field('best_selling_regional', $t);
            if ($best_selling && $tourCount <= 12) {
                $filteredTours[] = $t;
                $tourCount++;
            }
        }

        ?>

        <div class="destination-main__packages__best-selling">
            <div class="destination-main__packages__best-selling__slider" id="main-slider">



                <?php foreach ($filteredTours as $t) : ?>
                    <?php

                    $hero_image = get_field('best_selling_image', $t);
                    $countries  = get_field('destinations', $t);
                    $price_packages = get_field('price_packages', $t);

                    $lowest = lowest_tour_price($price_packages, $currentYear);

                    $dealPosts = listDealsForProduct($t);
                    $hasDeals = (count($dealPosts) > 0) ? true : false;

                    ?>
                    <!-- Tour Card -->
                    <a class="wide-slider-card" href="<?php echo get_permalink($t); ?>">

                        <?php if ($hero_image) : ?>
                            <div class="wide-slider-card__image">
                                <img <?php afloat_image_markup($hero_image['id'], 'wide-slider-medium'); ?>>
                            </div>
                        <?php endif; ?>

                        <div class="wide-slider-card__content">
                            <div class="wide-slider-card__content__tag-area">
                                <div class="wide-slider-card__content__tag-area__tag">
                                    Best Seller
                                </div>
                                <?php if ($hasDeals) : ?>
                                    <div class="wide-slider-card__content__tag-area__tag deal-tag">
                                        Deals
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="wide-slider-card__content__text-area">
                                <div class="wide-slider-card__content__text-area__country">
                                    <?php foreach ($countries as $c) :
                                        $isCountry = get_field('is_country', $c);
                                        if ($isCountry) : ?>
                                            <li>
                                                <?php echo get_the_title($c); ?>
                                            </li>

                                    <?php endif;
                                    endforeach; ?>
                                </div>
                                <h3 class="wide-slider-card__content__text-area__title">
                                    <?php echo get_field('tour_name', $t) ?>
                                </h3>
                                <div class="wide-slider-card__content__text-area__info">
                                    <div class="wide-slider-card__content__text-area__info__length">
                                        <?php echo get_field('length', $t) ?>-Day Tour
                                    </div>
                                    <div class="wide-slider-card__content__text-area__info__price">
                                        From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>

                <?php endforeach; ?>



            </div>
        </div>

    </div>
    <h2 class="sub-divider destination-main__experiences-title">
        <?php echo $title ?> Experiences
    </h2>
    <div class="destination-main__experiences-sub-text">
        <?php echo get_field('tour_experience_title_subtext') ?>
    </div>
    <!-- experiences -->
    <div class="destination-main__experiences">
        <?php
        if ($tour_experiences) {
            foreach ($tour_experiences as $e) {
                $experience = $e['experience'];
                $background_image = $e['background_image'];
                $search_link = $e['search_link'];
                $is_charter = false;
                $include_cruises = get_field('include_cruises', $experience);
                if ($destinationType == 'region') { //destination variant template doesnt have charter option
                    $is_charter = $e['is_charter'];
                }

        ?>
                <a class="category-card" href="<?php echo $search_link ?>">
                    <div class="category-card__image">
                        <?php if ($background_image) : ?>
                            <img <?php afloat_image_markup($background_image['id'], 'pill-large'); ?>>
                        <?php endif; ?>
                    </div>

                    <div class="category-card__content">
                        <h3 class="category-card__content__title">
                            <?php if ($is_charter) :
                                echo 'Charter Cruises';
                            else :

                                if ($include_cruises) {
                                    echo get_the_title($experience) . ' Cruises'; // for solo 
                                } else {
                                    echo get_the_title($experience) . ' Tours';
                                }


                            endif; ?>

                        </h3>
                        <div class="category-card__content__availability">
                            <?php if ($destinationType == 'region') {

                                if ($is_charter) :
                                    echo cruises_available_region($destination, null, true) . ' Cruises Available'; //destination is region in this case
                                else :

                                    $crusiesAvailable = cruises_available_region($destination, $experience, false);
                                    $toursAvailable = tours_available_region($destination, $experience);
                                    $totalAvailable = $crusiesAvailable + $toursAvailable;

                                    if ($include_cruises) {
                                        $plurality = $totalAvailable == 1 ? ' Cruise' : ' Cruises';
                                        echo $totalAvailable . $plurality  . ' Available'; //destination is region in this case
                                    } else {
                                        $plurality = $totalAvailable == 1 ? ' Tour' : ' Tours';
                                        echo $totalAvailable . $plurality . ' Available'; //destination is region in this case
                                    }


                                endif;
                            } else if ($destinationType == 'destination') {
                                $crusiesAvailable = cruises_available_experience($destination, $experience);
                                $toursAvailable = tours_available($destination, $experience);
                                $totalAvailable = $crusiesAvailable + $toursAvailable;
                                $plurality = $totalAvailable == 1 ? ' Tour' : ' Tours';
                                echo $totalAvailable . $plurality . ' Available';
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
                <a class="btn-outline btn-outline--small" href="<?php echo $link; ?>"><?php echo $buttonText ?></a>
        <?php endforeach;
        endif;
        ?>
        <a class="btn-outline btn-outline--dark  btn-outline--small" href="<?php echo $tour_search_link; ?>">View All Tours</a>
        <?php $deal_page_link = get_field('deal_page_link');
        if ($deal_page_link != '') : ?>
            <a class="btn-outline btn-outline--green btn-outline--small" href="<?php echo get_field('deal_page_link'); ?>">View Deals</a>
        <?php endif; ?>
    </div>
</div>

<?php if ($has_video) : ?>
    <!-- Video Modal -->
    <div class="modal modal--video stop-video" id="videoModal">
        <div class="modal__video">

            <!-- Top Section -->
            <div class="modal__video__top">

            </div>

            <!-- Main -->
            <div class="modal__video__main">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe id="modal-video-iframe" src="<?php echo get_field('vimeo_link') ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Antarctica Cruises"></iframe>
                </div>
            </div>

        </div>
    </div>
<?php endif ?>