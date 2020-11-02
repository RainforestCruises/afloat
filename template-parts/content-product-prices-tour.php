<?php
$currentYear = $args['currentYear'];

?>
<div class="product-prices">
    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('prices_intro'); ?>

        </div>

    </div>

    <div id="sentinal-tab-prices"></div>
    <div class="page-divider u-margin-bottom-none">
        Price List
    </div>

    <?php
    $itineraries = get_field('itineraries');
    $pricesImagery = get_field('prices_imagery');
    $itinerariesCount = 0;
    if ($itineraries) : ?>

        <?php foreach ($itineraries as $itinerary) : ?>

            <?php $flipClass = "";
            if ($itinerariesCount % 2 != 0) {
                $flipClass = "--flipped";
            } ?>

            <!-- Price Group -->
            <div class="product-prices__price-group u-margin-top-medium">
                <div class="product-prices__price-group__picture product-prices__price-group__picture<?php echo $flipClass ?>">
                    <img src="<?php echo esc_html($pricesImagery[$itinerariesCount]['url']); ?>" alt="">
                </div>
                <div class="product-prices__price-group__name product-prices__price-group__name<?php echo $flipClass ?>">
                    <div class="product-prices__price-group__name__length">
                        <?php echo $itinerary['length_in_days']; ?> Day / <?php echo ($itinerary['length_in_days'] - 1) ?> Night
                    </div>
                    <div class="product-prices__price-group__name__subtitle">
                        <h3 class="heading-3 heading-3--underline">
                            <?php echo $itinerary['name']; ?>
                        </h3>
                    </div>
                </div>
                <div class="product-prices__price-group__card-group product-prices__price-group__card-group<?php echo $flipClass ?>">

                    <?php $yearCount = 0; ?>
                    <?php while ($yearCount <= 1) { ?>
                        <?php $hasRate = false; ?>
                        <!-- Card 2020 -->
                        <div class="product-prices__price-group__card-group__card">
                            <!-- Reg Season -->
                            <h4 class="product-prices__price-group__card-group__card__year ">
                                <?php echo ($currentYear + $yearCount) ?>
                            </h4>
                            <h5 class="product-prices__price-group__card-group__card__season">
                                All Year
                            </h5>
                            <div class="product-prices__price-group__card-group__card__cabin-list">
                                <?php $pricePackages = $itinerary['price_packages']; ?>
                                <?php foreach ($pricePackages as $pricePackage) : ?>
                                    <?php if ($pricePackage['year'] == ($currentYear + $yearCount)) { ?>
                                        <?php $hasRate = true; ?>
                                        <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                            <div class="product-prices__price-group__card-group__card__cabin-list__item__cabin">
                                                <?php echo  $pricePackage['name']; ?>
                                            </div>
                                            <div class="product-prices__price-group__card-group__card__cabin-list__item__prices">
                                                <?php echo "$ " . number_format($pricePackage['price'], 0);  ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php endforeach ?>
                            </div>
                            <?php if($hasRate == false){?>
                                <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                Call for Prices
                                </div>
                            <?php } ?>


                        </div>

                    <?php $yearCount++;
                    } ?>



                </div>
            </div>
        <?php $itinerariesCount++;
        endforeach; ?>
    <?php endif; ?>


    <!-- Note Top-->
    <div class="product-prices__note">
        <div class="attention-box">
            <p>All prices listed are per person in double occupancy unless otherwise specified </p>
        </div>
    </div>

    <!-- Note Bot-->
    <?php if (get_field('display_special_note') == true) { ?>
        <div class="product-prices__note">
            <div class="attention-box">
                <?php echo get_field('special_note_content') ?>
            </div>
        </div>
    <?php } ?>
    <!-- Policies -->
    <div class="product-prices__policies-divider">
        <div class="page-divider">
            Policies
        </div>
    </div>
    <div class="product-prices__policies">
        <div class="product-prices__policies__list-group product-prices__policies__list-group--overall">
            <div class="product-prices__policies__list-group__title heading-3 heading-3--underline">
                Pricing Policies
            </div>
            <ul class="list-svg">
                <?php
                $policies = get_field('policies');
                $overall_policies = $policies['overall_policies'];
                if ($overall_policies != false) :
                    foreach ($overall_policies as $p) { ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                            <span><?php echo $p['policy']; ?></span>
                        </li>
                <?php
                    }
                endif;
                ?>
            </ul>
        </div>
        <div class="product-prices__policies__list-group product-prices__policies__list-group--first">
            <div class="product-prices__policies__list-group__title-overall heading-3 heading-3--underline">
                <?php echo $currentYear; ?>
            </div>
            <ul class="list-svg">
                <?php
                $current_year_policies = $policies['current_year_policies'];
                if ($current_year_policies != false) :
                    foreach ($current_year_policies as $p) { ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                            <span><?php echo $p['policy']; ?></span>
                        </li>
                <?php
                    }
                endif;
                ?>
            </ul>
        </div>
        <div class="product-prices__policies__list-group product-prices__policies__list-group--second">
            <div class="product-prices__policies__list-group__title heading-3 heading-3--underline">
                <?php echo ($currentYear + 1); ?>
            </div>
            <ul class="list-svg">
                <?php
                $next_year_policies = $policies['next_year_policies'];
                if ($next_year_policies != false) :
                    foreach ($next_year_policies as $p) { ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                            <span><?php echo $p['policy']; ?></span>
                        </li>
                <?php
                    }
                endif;
                ?>
            </ul>
        </div>
    </div>
</div>