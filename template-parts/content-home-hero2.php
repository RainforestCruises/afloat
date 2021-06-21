<?php
$queryArgs = array(
    'post_type' => array('rfc_destinations', 'rfc_regions'),
    'meta_key' => 'navigation_title',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'posts_per_page' => -1
);

$destinations = get_posts($queryArgs);
$hero_image = get_field('hero_image');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_slider = get_field('hero_slider');
?>

<!--  Hero -->
<div class="home-hero">
    <div class="home-hero__bg" id="home-hero__bg">


        <!-- Slider -->
        <?php
        $slideCount = 0;
        foreach ($hero_slider as $s) :
            $sliderImage = $s['image'];
            $sliderTitle = $s['title'];
            $sliderDestination = $s['destination'];

            $sliderDestinationPostId = $sliderDestination->ID;
        ?>
            <div class="home-hero__bg__slide" postid="<?php echo $sliderDestinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                <?php if ($sliderImage) : ?>
                    <img <?php afloat_responsive_image($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?> alt="">
                <?php endif; ?>
            </div>

        <?php
            $slideCount++;
        endforeach; ?>




        <!-- <img src="<?php echo $hero_image['url'] ?>" alt=""> -->
        <!-- <video autoplay muted loop id="myVideo">
            <source src="https://player.vimeo.com/external/295214306.hd.mp4?s=7b0ecc1df3b24b3b79f365535c6c9137632121dc&profile_id=174" type="video/mp4">
        </video> -->
    </div>

    <div class="home-hero__content">
        <div class="home-hero__content__title-group">
            <h2 class="home-hero__content__title-group__title">
                <?php echo $hero_title ?>
            </h2>
            <h1 class="home-hero__content__title-group__subtitle">
                <?php echo $hero_subtitle ?>
            </h1>
        </div>

        <!-- Search Area -->
        <div class="home-hero__content__search-area">

            <!-- Search Container -->
            <div class="home-search" id="search-container">

                <!-- Destination -->
                <div class="home-search__destination" id="destination-input-container">
                    <input class="home-search__destination__input" id="destination-input" type="text" value="" placeholder="Where would you like to go?" autocomplete="off">

                    <ul class="home-search__destination__list" id="destination-list">
                        <?php foreach ($destinations as $d) : ?>
                            <li postid="<?php echo $d->ID ?>"><?php echo get_field('navigation_title', $d) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Dates -->
                <div class="home-search__dates">
                    <div class="home-search__dates__input" id="dates-input">
                        When would you like to travel?
                    </div>
                    <div class="home-search__dates__list" id="dates-list">
                        <div class="home-search__dates__list__years">
                            <div class="home-search__dates__list__years__year selected" year="2021">
                                2021
                            </div>
                            <div class="home-search__dates__list__years__year" year="2022">
                                2022
                            </div>
                        </div>
                        <ul class="home-search__dates__list__months selected">
                            <li month="01" name="January">Jan</li>
                            <li month="02" name="February">Feb</li>
                            <li month="03" name="March">Mar</li>
                            <li month="04" name="April">Apr</li>
                            <li month="05" name="May">May</li>
                            <li month="06" name="June">Jun</li>
                            <li month="07" name="July">Jul</li>
                            <li month="08" name="August">Aug</li>
                            <li month="09" name="September">Sep</li>
                            <li month="10" name="October">Oct</li>
                            <li month="11" name="November">Nov</li>
                            <li month="12" name="December">Dec</li>
                        </ul>

                    </div>
                </div>

                <!-- CTA Button -->
                <div class="home-search__cta">
                    <button class="home-search__cta__button" id="search-button">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                        </svg>
                    </button>
                </div>

            </div>

            <!-- Search Container Mobile -->
            <div class="home-search-mobile">
                <button id="mobile-search-button">
                    Where would you like to go?

                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                    </svg>
                </button>
            </div>

        </div>




    </div>

    <div class="home-hero__bottom">
        <div class="scroll-down">
            <div class="scroll-down-bar"></div>
            <div class="scroll-down-text">SCROLL DOWN</div>
        </div>

        <div class="home-hero__bottom__slide-nav" id="home-hero__bottom__slide-nav">
            <!-- Slider -->
            <?php foreach ($hero_slider as $s) :
                $sliderTitle = $s['title'];
                $sliderDestination = $s['destination'];
                $sliderDestinationPostId = get_the_id($sliderDestination);
            ?>
                <div class="home-hero__bottom__slide-nav__slide" postId="<?php echo $sliderDestinationPostId ?>">
                    <?php echo $sliderTitle; ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>




</div>