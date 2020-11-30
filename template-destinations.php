<?php 
/*Template Name: Destinations*/
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);

?>



<?php
get_header();
?>

<?php
$destination = get_field('destination_post');
$locations = get_field('locations', $destination->ID); //selector, post ID
console_log($destination);
console_log($locations);

$destinationCount = count($locations);

usort($locations, function($a, $b)
{
    return strcmp($a->importance, $b->importance);
});

?>

<!-- Hero -->
<div class="destination-page">
    <section class="destination-page__section-hero" id="top">

        <!-- Destination Hero -->
        <div class="destination-hero">

            <div class="destination-hero__breadcrumb">
                <div class="destination-hero__breadcrumb__path">
                    Destinations > <?php echo ($destination->post_title) ?>
                </div>
            </div>



            <!-- destination-nav-->
            <nav class="destination-hero__page-nav">
                <div class="destination-hero__page-nav__title" id="template-nav-title" href="#top">
                <?php echo ($destination->post_title) ?>
                </div>

                <!-- sticky wrapper -->
                <nav class="destination-hero__page-nav__sticky-wrapper" id="template-nav">

                    <ul class="destination-hero__page-nav__list">
                        <div class="destination-hero__page-nav__list__item">
                            <a href="#tours" class="destination-hero__page-nav__list__item__link ">Tours</a>
                        </div>
                        <div class="destination-hero__page-nav__list__item">
                            <a href="#cruises" class="destination-hero__page-nav__list__item__link ">Cruises</a>
                        </div>
                        <div class="destination-hero__page-nav__list__item">
                            <a href="#accommodations" class="destination-hero__page-nav__list__item__link">Accommodations</a>
                        </div>

                        <div class="destination-hero__page-nav__list__item">
                            <a href="#travel-guides" class="destination-hero__page-nav__list__item__link">Travel Guides</a>
                        </div>
                        <div class="destination-hero__page-nav__list__item">
                            <a href="#reviews" class="destination-hero__page-nav__list__item__link">Reviews</a>
                        </div>
                        <div class="destination-hero__page-nav__list__item">
                            <a href="#faq" class="destination-hero__page-nav__list__item__link">FAQ</a>
                        </div>
                    </ul>
                    <div class="page-nav__button">
                        Peru
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </div>
                    <!-- page-nav__collapse--active -->
                    <nav class="page-nav__collapse ">
                        <ul class="page-nav__collapse__list">
                            <li class="page-nav__collapse__list__item" href="#tours">
                                Tours
                            </li>
                            <li class="page-nav__collapse__list__item" href="#cruises">
                                Cruises
                            </li>
                            <li class="page-nav__collapse__list__item" href="#accommodations">
                                Accommodations
                            </li>
                        </ul>
                    </nav>



                </nav>



                <div class="destination-hero__page-nav__arrow">
                    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#tours">
                        <svg class="btn-circle--arrow-main">
                            <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                        <svg class="btn-circle--arrow-animate">
                            <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg></button>
                </div>
            </nav>



            <!-- BG Slider -->
            <div class="destination-hero__bg" id="destination-hero__bg">
                <?php foreach ($locations as $s) : ?>
                    <div class="destination-hero__bg__slide">
                        <img src="<?php echo wp_get_attachment_url($s->hero_image); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Content Slider -->
            <div class="destination-hero__content" id="destination-hero__content">
                <!-- Content -->

                <?php foreach ($locations as $s) : ?>
                    <div class="destination-hero__content__slide">
                        <div class="destination-hero__content__slide__subtitle">
                            <?php echo ($s->hero_sub_title); ?>
                        </div>
                        <div class="destination-hero__content__slide__title">
                            <?php echo ($s->hero_title); ?>
                        </div>
                        <p class="destination-hero__content__slide__text">
                            <?php echo ($s->hero_short_text); ?>
                        </p>
                        <div class="destination-hero__content__slide__cta">
                            <a href="#" class="destination-hero__content__slide__cta__explore">
                                <span>Explore <?php echo ($s->post_title); ?></span>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </a>
                            <a href="#" class="destination-hero__content__slide__cta__more">
                                <span>
                                    More <?php echo ($destination->post_title) ?>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>



            </div>

            <!-- Nav Slider -->
            <div class="destination-hero__nav" id="destination-hero__nav">
                <?php foreach ($locations as $s) : ?>
                    <div class="destination-hero__nav__slide">
                        <span><?php echo ($s->post_title); ?></span>
                    </div>
                <?php endforeach; ?>




            </div>
        </div>

    </section>


    <div class="video-popup" id="video-popup">
        <div class="video-popup__content">
            <video controls id="destination-video">
                <source src="https://player.vimeo.com/external/153249004.sd.mp4?s=226e013691679ff208dafe8f5f3435818810178a&profile_id=165" type="video/mp4">
                Your browser doesn't support HTML5 video tag.
            </video>
        </div>
        <a href="#" class="video-popup__close">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        </a>
    </div>

    <div class="destination-page__section-intro" id="tours">
        <div class="destination-intro">
            <div class="destination-intro__content">
                <div class=" destination-intro__content__title heading-3 heading-3--underline-white">
                    Travel in Peru
                </div>
                <p class="destination-intro__content__text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum placeat qui nam sapiente consequuntur
                    commodi! Culpa quasi voluptas error asperiores quae illum reiciendis cum, quod animi distinctio ullam ipsam
                    at. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima doloremque harum adipisci fugiat libero
                    consequuntur ipsa ab recusandae. Rem aut mollitia hic voluptatibus unde autem dignissimos fugiat?
                    Praesentium,
                    enim nesciunt! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat saepe distinctio at
                    excepturi alias veritatis consequatur sit sint autem corporis ipsam officia tempore expedita culpa libero,
                    deserunt, id eveniet nam!
                </p>

                <div class="destination-intro__content__stats">
                    <div class="destination-intro__content__stats__item">
                        <div class="destination-intro__content__stats__item__title">
                            Area
                        </div>
                        <div class="destination-intro__content__stats__item__text">
                            1,285,216 km2
                        </div>
                    </div>
                    <div class="destination-intro__content__stats__item">
                        <div class="destination-intro__content__stats__item__title">
                            Population
                        </div>
                        <div class="destination-intro__content__stats__item__text">
                            31,151,643
                        </div>
                    </div>
                    <div class="destination-intro__content__stats__item">
                        <div class="destination-intro__content__stats__item__title">
                            Major Cities
                        </div>
                        <div class="destination-intro__content__stats__item__text">
                            Lima
                        </div>
                    </div>
                    <div class="destination-intro__content__stats__item">
                        <div class="destination-intro__content__stats__item__title">
                            Languages
                        </div>
                        <div class="destination-intro__content__stats__item__text">
                            Spanish, Quechua
                        </div>
                    </div>
                    <div class="destination-intro__content__stats__item">
                        <div class="destination-intro__content__stats__item__title">
                            Best Time to Visit
                        </div>
                        <div class="destination-intro__content__stats__item__text">
                            All year
                        </div>
                    </div>

                </div>
            </div>
            <div class="destination-intro__map">
                <img src="img/bg/map-sa-light-lg-fade-2.png" alt="">
            </div>

            <div class="destination-intro__tours">
                <div class="destination-intro__tours__title">
                    Tour Packages
                </div>
                <div class="destination-intro__tours__content">
                    <p class="destination-intro__tours__content__subtitle">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos eos iste ut, aspernatur obcaecati
                        facere quod mollitia reprehenderit earum delectus culpa quibusdam itaque placeat fugit. Incidunt ullam
                        ipsa
                        illum expedita.
                    </p>
                    <div class="destination-intro__tours__content__all">
                        <button class="btn-outline btn-white">View All</button>
                    </div>
                </div>

                <div class="destination-intro__tours__slider" id="destination-intro__tours__slider">
                    <div class="destination-intro__tours__slider__slide">
                        <div class="destination-intro__tours__slider__slide__hover-group">
                            <div class="destination-intro__tours__slider__slide__hover-group__count">21 Tours Available</div>
                            <div class="destination-intro__tours__slider__slide__hover-group__cta">
                                <button class="btn-outline btn-white">Explore</button>
                            </div>
                        </div>
                        <img src="img/tours-slider/amazon-01.jpg" class="destination-intro__tours__slider__slide__img" alt="">

                        <div class="destination-intro__tours__slider__slide__lower-section">
                            <div class="destination-intro__tours__slider__slide__lower-section__title">
                                Amazon Tours
                            </div>
                            <div class="destination-intro__tours__slider__slide__lower-section__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                                sit
                            </div>

                        </div>

                    </div>
                    <div class="destination-intro__tours__slider__slide">
                        <div class="destination-intro__tours__slider__slide__hover-group">
                            <div class="destination-intro__tours__slider__slide__hover-group__count">28 Tours Available</div>
                            <div class="destination-intro__tours__slider__slide__hover-group__cta">
                                <button class="btn-outline btn-white">Explore</button>
                            </div>
                        </div>
                        <img src="img/tours-slider/luxury-01.jpg" class="destination-intro__tours__slider__slide__img" alt="">
                        <div class="destination-intro__tours__slider__slide__lower-section">
                            <div class="destination-intro__tours__slider__slide__lower-section__title">
                                Luxury Tours
                            </div>
                            <div class="destination-intro__tours__slider__slide__lower-section__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                                sit
                            </div>

                        </div>
                    </div>
                    <div class="destination-intro__tours__slider__slide">
                        <div class="destination-intro__tours__slider__slide__hover-group">
                            <div class="destination-intro__tours__slider__slide__hover-group__count">14 Tours Available</div>
                            <div class="destination-intro__tours__slider__slide__hover-group__cta">
                                <button class="btn-outline btn-white">Explore</button>
                            </div>
                        </div>
                        <img src="img/tours-slider/wildlife-02.jpg" class="destination-intro__tours__slider__slide__img" alt="">
                        <div class="destination-intro__tours__slider__slide__lower-section">
                            <div class="destination-intro__tours__slider__slide__lower-section__title">
                                Wildlife Tours
                            </div>
                            <div class="destination-intro__tours__slider__slide__lower-section__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                                sit
                            </div>

                        </div>
                    </div>
                    <div class="destination-intro__tours__slider__slide">
                        <div class="destination-intro__tours__slider__slide__hover-group">
                            <div class="destination-intro__tours__slider__slide__hover-group__count">17 Tours Available</div>
                            <div class="destination-intro__tours__slider__slide__hover-group__cta">
                                <button class="btn-outline btn-white">Explore</button>
                            </div>
                        </div>
                        <img src="img/tours-slider/cultural-01.jpg" class="destination-intro__tours__slider__slide__img" alt="">
                        <div class="destination-intro__tours__slider__slide__lower-section">
                            <div class="destination-intro__tours__slider__slide__lower-section__title">
                                Cultural Tours
                            </div>
                            <div class="destination-intro__tours__slider__slide__lower-section__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                                sit
                            </div>

                        </div>
                    </div>
                    <div class="destination-intro__tours__slider__slide">
                        <div class="destination-intro__tours__slider__slide__hover-group">
                            <div class="destination-intro__tours__slider__slide__hover-group__count">11 Tours Available</div>
                            <div class="destination-intro__tours__slider__slide__hover-group__cta">
                                <button class="btn-outline btn-white">Explore</button>
                            </div>
                        </div>
                        <img src="img/tours-slider/adventure-01.jpg" class="destination-intro__tours__slider__slide__img" alt="">
                        <div class="destination-intro__tours__slider__slide__lower-section">
                            <div class="destination-intro__tours__slider__slide__lower-section__title">
                                Adventure Tours
                            </div>
                            <div class="destination-intro__tours__slider__slide__lower-section__text">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                                sit
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Cruises-->
    <section class="destination-page__section-cruises" id="cruises">
        <div class="destination-cruises">
            <div class="destination-cruises__title">
                Cruises
            </div>
            <div class="destination-cruises__intro-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate qui rem in minus! Voluptatum, praesentium
                atque obcaecati quod consequatur debitis. Iure, aliquid. Quam cupiditate sequi impedit. Quasi nihil voluptates
                ipsam!
            </div>
            <div class="destination-cruises__grid">

                <div class="destination-cruises__grid__item">

                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>


                    <img src="img/products/Aria-Amazon.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $5,159
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Aria Amazon
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            5 - 7 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/Delfin-I-Boat.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $3,405
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Delfin I
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            5 - 8 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/clipper-premium-amazon-brazil.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $4,405
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Clipper Premium
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            3 - 8 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/zafiro-cruise-amazon.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $3,885
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Zafiro
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            6 - 9 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/Aria-Amazon.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $5,159
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Aria Amazon
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            5 - 7 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/Delfin-I-Boat.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $3,405
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Delfin I
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            5 - 8 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/clipper-premium-amazon-brazil.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $4,405
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Clipper Premium
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            3 - 8 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="destination-cruises__grid__item">
                    <div class="destination-cruises__grid__item__cta">
                        <button class="btn-outline btn-white btn-outline--small">View</button>
                    </div>
                    <img src="img/products/zafiro-cruise-amazon.jpg" class="destination-cruises__grid__item__img">
                    <div class="destination-cruises__grid__item__lower-section">
                        <div class="destination-cruises__grid__item__lower-section__price">
                            $3,885
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__name">
                            Zafiro
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__length">
                            6 - 9 Day Cruises
                        </div>
                        <div class="destination-cruises__grid__item__lower-section__stars">
                            <svg class="star-grey">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                            <svg class="star-gold">
                                <use xlink:href="img/sprite.svg#icon-star"></use>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <div class="destination-cruises__all">
                <button class="btn-outline btn-grey">All Peru Cruises</button>
            </div>
        </div>
    </section>

    <!-- Accommodations -->
    <section class="destination-page__section-accommodations" id="accommodations">
        <div class="destination-accommodations">
            <div class="destination-accommodations__title">
                Accommodations
            </div>
            <div class="destination-accommodations__intro-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate qui rem in minus! Voluptatum, praesentium
                atque obcaecati quod consequatur debitis. Iure, aliquid. Quam cupiditate sequi impedit. Quasi nihil voluptates
                ipsam!
            </div>

            <div class="destination-accommodations__grid">
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">17 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/hotel-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Hotels in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">8 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/lodge-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Lodges in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
                <div class="destination-accommodations__grid__slide">
                    <div class="destination-accommodations__grid__slide__hover-group">
                        <div class="destination-accommodations__grid__slide__hover-group__count">23 Available</div>
                        <div class="destination-accommodations__grid__slide__hover-group__cta">
                            <button class="btn-outline btn-white">See All</button>
                        </div>
                    </div>
                    <img src="img/accommodations/cruise-01.jpg" class="destination-accommodations__grid__slide__img" alt="">
                    <div class="destination-accommodations__grid__slide__lower-section">
                        <div class="destination-accommodations__grid__slide__lower-section__title">
                            Cruise Ships in Peru
                        </div>
                        <div class="destination-accommodations__grid__slide__lower-section__text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ad hic at blanditiis. Lorem ipsum dolor
                            sit
                        </div>

                    </div>
                </div>
            </div>

            <div class="destination-accommodations__all">
                <button class="btn-outline btn-grey">All Peru Accommodations</button>
            </div>
        </div>
    </section>

    <section class="destination-page__section-travel-guides" id="travel-guides"></section>
    <section class="destination-page__section-reviews" id="reviews"></section>
    <section class="destination-page__section-faq" id="faq"></section>

</div>

<?php get_footer(); ?>


<script> 
var destinationCount = <?php echo json_encode($destinationCount); ?>; 
var templateUrl = <?php echo bloginfo('template_url')?>;
 
</script> 