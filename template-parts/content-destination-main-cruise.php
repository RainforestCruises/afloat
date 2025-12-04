<?php
$destination = $args['destination'];
$title = $args['title'];
$cruise_locations = get_field('cruise_countries');

$cruises = $args['cruises'];
$currentYear = date("Y");

$background_map = get_field('background_map');
$highlights = get_field('highlights');

$cruise_experiences = get_field('cruise_experiences');
$has_video = get_field('has_video');
$vimeo_link = get_field('vimeo_link');
$video_hero_card = get_field('video_hero_card');
?>

<div class="destination-main">

    <!-- Map Background -->
    <div class="destination-main__bg">
        <img src="<?php echo esc_url($background_map['url']); ?>" alt="<?php echo get_post_meta($background_map['id'], '_wp_attachment_image_alt', TRUE) ?>">
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
                    <div class="destination-main__intro__description__text__video">
                        <video class="destination-main__intro__description__text__video__source" muted autoplay loop id="hero-video-card">
                            <source src="<?php echo esc_url($video_hero_card); ?>" type="video/mp4">
                        </video>
                        <div class="destination-main__intro__description__text__video__cta">
                            <button class="destination-video-play-button dark">
                                <div class="destination-video-play-button__icon-area">
                                    <div class="destination-video-play-button__icon-area__inner">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-button-play"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div class="destination-video-play-button__text">
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

    <!-- Cruises -->
    <div class="destination-main__packages" id="cruises">
        <div class="destination-main__packages__header">
            <h2 class="destination-main__packages__header__title page-divider">
                <?php echo $title ?> Cruises
            </h2>
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
                    $charter_only = get_field('charter_only', $c);
                    $charter_min_days = get_field('charter_min_days', $c);
                    $dealPosts = listDealsForProduct($c);
                    $hasDeals = (count($dealPosts) > 0) ? true : false;

                    if (array_key_exists("LowestCharterPrice", $cruise_data)) {
                        $charter_daily_price = $cruise_data['LowestCharterPrice'];
                    }

                    $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear, true); //why is this differnnt in product hero?
                    ?>

                    <a class="product-card" href="<?php echo get_permalink($c); ?>">
                        <?php if ($hasDeals) : ?>
                            <div class="product-card__tag">
                                <div class="deal-tag">
                                    Deals
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="product-card__image-area">
                            <?php if ($featured_image) : ?>
                                <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                            <?php endif; ?>
                            <ul class="product-card__image-area__destinations">
                                <?php
                                $destinations = $c->destinations;
                                if ($destinations) :
                                    foreach ($destinations as $d) :
                                        echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                    endforeach;
                                endif; ?>
                            </ul>
                            <?php if ($charter_only) : ?>
                                <div class="product-card__image-area__charter-text">
                                    Private Charter
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <h3 class="product-card__bottom__title-group__product-name">
                                    <?php echo get_the_title($c) ?>
                                </h3>
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
                                        <?php if ($charter_only) :
                                            echo $charter_min_days . ' Days +';
                                        else :
                                            echo itineraryRange($cruise_data, " - ") . ' Days';
                                        endif; ?>
                                    </div>
                                </div>
                                <div class="product-card__bottom__info__price-group">
                                    <?php if ($charter_only) : ?>
                                        <div class="product-card__bottom__info__price-group__from">Day</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($charter_daily_price);  ?> <span>USD</span></div>

                                    <?php else : ?>
                                        <div class="product-card__bottom__info__price-group__from">From</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($lowestPrice);  ?> <span>USD</span></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>

              <?php endforeach; ?>
            </div>
        </div>

    </div>



    <!-- destination tiles -->
    <?php $hideDesinations = get_field('hide_cruise_destinations') ?>
    <?php if ($hideDesinations == false) : ?>
        <h2 class="sub-divider destination-main__experiences-title">
            <?php echo $title ?> Destinations
        </h2>
        <div class="destination-main__experiences-sub-text">
            <?php echo get_field('cruise_destination_title_subtext') ?>
        </div>

        <div class="destination-main__experiences">
            <?php
            if ($cruise_locations) :

                foreach ($cruise_locations as $c) :
                    $location = $c['country'];
                    $background_image = $c['background_image'];
                    $link = $c['search_link'];
                    $cruiseCount = cruises_available_location($location);
            ?>
                    <a class="category-card" href="<?php echo $link ?>">
                        <div class="category-card__image">
                            <img <?php afloat_image_markup($background_image['id'], 'pill-large'); ?>>
                        </div>

                        <div class="category-card__content">
                            <h3 class="category-card__content__title">
                                <?php echo get_field('navigation_title', $location); ?> Cruises
                            </h3>
                            <div class="category-card__content__availability">
                                <?php
                                if ($cruiseCount == 1) :
                                    echo $cruiseCount . ' Cruise Available';
                                else :
                                    echo $cruiseCount . ' Cruises Available';
                                endif;
                                ?>
                            </div>
                        </div>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    <?php endif; ?>

    <!-- experiences -->
    <h2 class="sub-divider destination-main__experiences-title">
        <?php echo $title ?> Experiences
    </h2>
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
                $is_charter = $e['is_charter'];

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
                                echo get_the_title($experience) . ' Cruises';
                            endif; ?>

                        </h3>
                        <div class="category-card__content__availability">
                            <?php if ($is_charter) :
                                $plurality = cruises_available_charter($destination) == 1 ? ' Cruise' : ' Cruises';
                                echo cruises_available_charter($destination) . $plurality . ' Available';
                            else :
                                $plurality = cruises_available_experience($destination, $experience) == 1 ? ' Cruise' : ' Cruises';
                                echo cruises_available_experience($destination, $experience) . $plurality . '  Available';
                            endif; ?>

                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>
    </div>

    <?php
    $cruise_lengths = get_field('cruise_lengths');
    ?>

    <div class="destination-main__lengths">
        <?php if ($cruise_lengths) : ?>
            <?php foreach ($cruise_lengths as $length) :
                $link = $length['link'];
                $buttonText = $length['button_text'];
            ?>
                <a class="btn-outline btn-outline--small " href="<?php echo $link; ?>"><?php echo $buttonText ?></a>
        <?php endforeach;
        endif;
        ?>

        <a class="btn-outline btn-outline--dark btn-outline--small" href="<?php echo get_field('cruise_search_link'); ?>">View All Cruises</a>
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