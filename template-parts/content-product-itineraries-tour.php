<?php

$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];

$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

//$itineraries = get_field('itineraries');

$days = [];
$lowest;
$highest;

?>

<div class="product-itineraries">

    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Length: <span><?php echo get_field('length')  ?> Days </span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>

        </div>

        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('itineraries_intro'); ?>
        </div>


    </div>
    <div id="sentinal-itineraries"></div>
    <!-- TAB CONTENT -->
    <!-- Itineraries -->

    <!-- Itinerary -->
    <div class="product-itineraries__itinerary  tab-content current" id="tab-itinerary-1">
        <div class="product-itineraries__itinerary__title">
            <div class="page-divider product-itineraries__itinerary__title__main">
                <?php echo get_field('itinerary_name') ?>
            </div>
            <div class="product-itineraries__itinerary__title__subtitle">
                <?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night
            </div>
        </div>

        <?php if (get_field('has_summary') == true) : ?>

            <!-- Intro -->
            <div class="product-itineraries__itinerary__intro drop-cap-1">
                <?php echo get_field('overview') ?>
            </div>

            <!-- Map -->
            <?php $img = get_field('map'); ?>

            <a class="product-itineraries__itinerary__map" id="map-lightbox" href="<?php echo esc_html($img['url']); ?>" title="<?php echo  get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night - <?php echo get_field('itinerary_name') ?>">
                <?php if ($img) : ?>
                    <img src="<?php echo esc_html($img['url']); ?>" alt="<?php echo esc_html($img['alt']) ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                    </svg>
                <?php endif ?>
            </a>

            <div class="product-itineraries__itinerary__divider"></div>
        <?php endif; ?>
        <!-- D2D -->
        <div class="product-itineraries__itinerary__d2d">
            <h3 class="heading-3">
                Tour Itinerary
            </h3>
            <!-- Days  -->
            <!-- First Day style set inline for slide toggle to function correctly -->

            <div class="product-itineraries__itinerary__d2d__days">
                <?php
                $days = get_field('daily_activities');
                $dayCount = 1;
                $img;
                if ($days) :
                    foreach ($days as $day) : ?>
                        <?php
                        $img = $day['day_image']
                        ?>
                        <!-- Day -->
                        <div class="product-itineraries__itinerary__d2d__days__day <?php echo $dayCount == 1 ? 'product-itineraries__itinerary__d2d__days__day--active' : ''; ?> ">

                            <?php if ($img != null) { ?>
                                <div class="product-itineraries__itinerary__d2d__days__day__image-content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                    <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges">
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__count-badge">
                                            <span>Day <?php echo $dayCount; ?></span> / <?php echo get_field('length_in_days'); ?>
                                        </div>
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__location-badge">
                                            <?php echo $day['day_location']; ?>
                                        </div>
                                    </div>

                                    <?php echo '<img src="' . esc_html($img['url']) . '" alt="' . esc_html($img['alt']) . '" class="product-itineraries__itinerary__d2d__days__day__image-content__img">'; ?>
                                </div>
                            <?php } ?>
                            <div class="product-itineraries__itinerary__d2d__days__day__count">
                                <span>Day <?php echo $dayCount; ?></span> / <?php echo get_field('length_in_days'); ?>
                            </div>
                            <h5 class="product-itineraries__itinerary__d2d__days__day__header">
                                <?php echo $day['day_title']; ?>
                            </h5>
                            <div class="product-itineraries__itinerary__d2d__days__day__snippet" <?php echo $dayCount == 1 ? 'style="display: none;"' : ''; ?>>
                                <p>
                                    <?php
                                    echo substr(strip_tags($day['day_description']), 0, 160);
                                    ?>...
                                </p>
                            </div>
                            <div class="product-itineraries__itinerary__d2d__days__day__content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                <?php echo $day['day_description']; ?>
                            </div>
                            <button class="btn-expand btn-expand--down product-itineraries__itinerary__d2d__days__day__button">
                                <svg class="btn-expand--arrow-main">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                                <svg class="btn-expand--arrow-animate">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                            </button>
                        </div>
                <?php
                        $dayCount++;
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <aside class="product-itineraries__itinerary__side-content">
            <!-- Details - Availability / Prices -->
            <div class="product-itineraries__itinerary__side-content__detail">

                <?php if (get_field('has_summary') == false) : ?>
                        <div class="product-itineraries__itinerary__side-content__detail__widget">
                            <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                                <h4 class="heading-4">
                                    Route Map
                                </h4>

                            </div>
                            <!-- Map -->
                            <?php $img = get_field('map'); ?>
                            <a class="product-itineraries__itinerary__map product-itineraries__itinerary__map--no-summary" id="map-lightbox" href="<?php echo $img['url']; ?>" title="<?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night - <?php echo get_field('tour_name') ?>">
                                <?php if ($img) : ?>
                                    <img src="<?php echo $img['url']; ?>" alt="">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                                    </svg>
                                <?php endif ?>
                            </a>
                        </div>


                <?php endif; ?>

                <!-- Prices -->
                <div class="product-itineraries__itinerary__side-content__detail__widget">

                    <?php $yearCount = 0; ?>
                    <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                        <h4 class="heading-4">
                            Prices
                        </h4>
                        <!-- Select-Box -->
                        <div class="itinerary-year-select-group">
                            <select class="itinerary-year-select" data-tab="1">
                                <?php while ($yearCount <= 1) { ?>
                                    <option><?php echo ($currentYear + $yearCount) ?></option>
                                <?php $yearCount++;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <!-- Price-Grid  -->
                    <?php

                    $pricePackages = get_field('price_packages');
                    $yearCount = 0;

                    ?>

                    <?php while ($yearCount <= 1) { ?>
                        <div class="price-grid price-grid__<?php echo ($currentYear + $yearCount) ?>" data-tab="1">

                            <?php
                            if ($pricePackages) {
                                foreach ($pricePackages as $pricePackage) {

                                    if ($pricePackage['year'] == ($currentYear + $yearCount)) { ?>
                                        <div class="price-grid__item">
                                            <div class="price-grid__item__cabin">
                                                <?php echo  $pricePackage['name'] ?>
                                            </div>
                                            <div class="price-grid__item__price">
                                                <?php echo "$ " . number_format($pricePackage['price'], 0);  ?>
                                            </div>
                                        </div>

                            <?php
                                    }
                                }
                            }


                            ?>
                        </div>
                    <?php $yearCount++;
                    } ?>

                </div>
                <!-- Inclusions -->
                <div class="product-itineraries__itinerary__side-content__detail__widget">
                    <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                        <h4 class="heading-4" id="InclusionsTitle" data-tab="1">
                            What's Included
                        </h4>
                    </div>
                    <div class="inclusions-area">
                        <!-- Inclusions List -->
                        <div class="inclusions-area__itinerary-inclusions" id="inclusions-list" data-tab="1">
                            <ul class="list-svg">
                                <?php
                                $inclusions = get_field('inclusions');
                                if ($inclusions) {
                                    foreach ($inclusions as $inclusion) { ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $inclusion['inclusion'] ?></span>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-exclusions" value="1">
                                    View List of Exclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Exclusions List -->
                        <div class="inclusions-area__itinerary-inclusions inclusions-area__itinerary-inclusions--hidden" id="exclusions-list" data-tab="1">
                            <ul class="list-svg">
                                <?php
                                $exclusions = get_field('exclusions');
                                if ($exclusions) {
                                    foreach ($exclusions as $exclusion) { ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $exclusion['exclusion'] ?></span>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-inclusions" value="1">
                                    View List of Inclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>