<?php

$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];

$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

$itineraries = get_field('itineraries');

$days = [];
$lowest;
$highest;
if ($itineraries) {
    foreach ($itineraries as $itinerary) {
        $days[] = $itinerary['length_in_days'];
        sort($days);
        $lowest = $days[0];
        rsort($days);
        $highest = $days[0];
    }
}
?>
<div class="product-itineraries">

    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Itineraries: <span><?php echo $lowest ?>&mdash;<?php echo $highest  ?> Days</span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>

        </div>

        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('itineraries_intro'); ?>
        </div>

        <!-- Attributes -->
        <div class="product-intro__nav">
            <ul class="product-intro__nav__list">
                <?php
                if ($itineraries) {
                    $count = 1;
                    foreach ($itineraries as $itinerary) {
                ?>
                        <li class="product-intro__nav__list__item <?php echo ($count == 1 ? 'current' : ''); ?>" data-tab="tab-itinerary-<?php echo $count ?>" id="tab-itinerary-<?php echo $count ?>-nav">
                            <?php echo $itinerary['length_in_days'] ?>-Day
                        </li>
                <?php
                        $count++;
                    }
                }
                ?>

            </ul>
        </div>
    </div>
    <div id="sentinal-tab-itineraries"></div>
    <!-- TAB CONTENT -->
    <!-- Itineraries -->
    <?php
     if ($itineraries) {
    $count = 1;
    foreach ($itineraries as $itinerary) {
    ?>
        <!-- Itinerary -->
        <div class="product-itineraries__itinerary  tab-content <?php echo ($count == 1 ? 'current' : ''); ?>" id="tab-itinerary-<?php echo $count ?>">
            <div class="product-itineraries__itinerary__title">
                <div class="page-divider">
                    <?php echo $itinerary['name'] ?>
                </div>
                <div class="product-itineraries__itinerary__title__subtitle">
                    <?php echo $itinerary['length_in_days'] ?> Day / <?php echo ($itinerary['length_in_days'] - 1) ?> Night
                </div>
            </div>

            <!-- Intro -->
            <div class="product-itineraries__itinerary__intro drop-cap-1">
                <?php echo $itinerary['overview'] ?>
            </div>

            <!-- Map -->
            <?php $img = $itinerary['map']; ?>

            <a class="product-itineraries__itinerary__map" id="map-lightbox" href="<?php echo esc_html($img['url']); ?>" title="<?php echo $itinerary['length_in_days'] ?> Day / <?php echo ($itinerary['length_in_days'] - 1) ?> Night - <?php echo $itinerary['name'] ?>">
                <?php if ($img) : ?>
                    <img src="<?php echo esc_html($img['url']); ?>" alt="<?php echo esc_html($img['alt']) ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                    </svg>
                <?php endif ?>
            </a>

            <div class="product-itineraries__itinerary__divider"></div>

            <!-- D2D -->
            <div class="product-itineraries__itinerary__d2d">
                <h3 class="heading-3">
                    Tour Itinerary
                </h3>
                <!-- Days  -->
                <!-- First Day style set inline for slide toggle to function correctly -->

                <div class="product-itineraries__itinerary__d2d__days">
                    <?php
                    $days = $itinerary['daily_activities'];
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
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__count-badge">
                                            <span>Day <?php echo $dayCount; ?></span> / <?php echo $itinerary['length_in_days']; ?>
                                        </div>
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__location-badge">
                                            <?php echo $day['location']; ?>
                                        </div>
                                        <?php echo '<img src="' . esc_html($img['url']) . '" alt="' . esc_html($img['alt']) . '" class="product-itineraries__itinerary__d2d__days__day__image-content__img">'; ?>
                                    </div>
                                <?php } ?>
                                <div class="product-itineraries__itinerary__d2d__days__day__count">
                                    <span>Day <?php echo $dayCount; ?></span> / <?php echo $itinerary['length_in_days']; ?>
                                </div>
                                <div class="product-itineraries__itinerary__d2d__days__day__header">
                                    <?php echo $day['day_title']; ?>
                                </div>
                                <div class="product-itineraries__itinerary__d2d__days__day__snippet" <?php echo $dayCount == 1 ? 'style="display: none;"' : ''; ?>>
                                    <?php echo substr($day['day_description'], 0, 160); ?>...
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

            <div class="product-itineraries__itinerary__side-content">
                <!-- Details - Availability / Prices -->
                <div class="product-itineraries__itinerary__side-content__detail">

                    <!-- Prices -->
                    <div class="product-itineraries__itinerary__side-content__detail__widget">

                        <?php $yearCount = 0; ?>
                        <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                            <h3 class="heading-4">
                                Prices
                            </h3>
                            <!-- Select-Box -->
                            <div class="itinerary-year-select-group">
                                <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
                                    <?php while ($yearCount <= 1) { ?>
                                        <option><?php echo ($currentYear + $yearCount) ?></option>
                                    <?php $yearCount++;
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Price-Grid  -->
                        <?php

                        $pricePackages = $itinerary['price_packages'];
                        $yearCount = 0;

                        ?>

                        <?php while ($yearCount <= 1) { ?>
                            <div class="price-grid price-grid__<?php echo ($currentYear + $yearCount) ?>" data-tab="<?php echo $count; ?>">

                                <?php foreach ($pricePackages as $pricePackage) {

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
                                    ?>

                                <?php } ?>
                            </div>
                        <?php $yearCount++;
                        } ?>

                    </div>
                    <!-- Inclusions -->
                    <div class="product-itineraries__itinerary__side-content__detail__widget">
                        <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                            <h3 class="heading-4" id="InclusionsTitle" data-tab="<?php echo $count; ?>">
                                What's Included
                            </h3>
                        </div>
                        <div class="inclusions-area">
                            <!-- Inclusions List -->
                            <div class="inclusions-area__itinerary-inclusions" id="inclusions-list" data-tab="<?php echo $count; ?>">
                                <ul class="list-svg">
                                    <?php if ($itinerary['inclusions']) {
                                        foreach ($itinerary['inclusions'] as $inclusion) { ?>
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
                                    <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-exclusions" value="<?php echo $count; ?>">
                                        View List of Exclusions
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Exclusions List -->
                            <div class="inclusions-area__itinerary-inclusions inclusions-area__itinerary-inclusions--hidden" id="exclusions-list" data-tab="<?php echo $count; ?>">
                                <ul class="list-svg">
                                <?php if ($itinerary['exclusions']) {
                                        foreach ($itinerary['exclusions'] as $exclusion) { ?>
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
                                    <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-inclusions" value="<?php echo $count; ?>">
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
            </div>
        </div>
    <?php $count++;
    } }?>
</div>