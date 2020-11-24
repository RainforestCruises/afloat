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

    <div id="sentinal-prices"></div>
    <h2 class="page-divider ">
        Price List
    </h2>

    <?php
    //$itineraries = get_field('itineraries');
    $pricesImagery = get_field('prices_imagery');

    ?>



    <!-- Price Group -->
    <div class="product-prices__price-group <?php echo ($itinerariesCount == 0) ? ('') : ('u-margin-top-medium') ?>">
        <div class="product-prices__price-group__picture ">
            <img src="<?php echo esc_html($pricesImagery[0]['url']); ?>" alt="">
        </div>
        <div class="product-prices__price-group__name ">
            <h4 class="product-prices__price-group__name__length">
                <?php echo get_field('length_in_days'); ?> Day / <?php echo (get_field('length_in_days') - 1) ?> Night
            </h4>
            <div class="product-prices__price-group__name__subtitle">
                <h3 class="heading-3 heading-3--underline">
                    <?php echo get_field('itinerary_name'); ?>
                </h3>
            </div>
        </div>
        <div class="product-prices__price-group__card-group ">

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
                        <?php $pricePackages = get_field('price_packages'); ?>
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
                    <?php if ($hasRate == false) { ?>
                        <div class="product-prices__price-group__card-group__card__cabin-list__item">
                            Call for Prices
                        </div>
                    <?php } ?>


                </div>

            <?php $yearCount++;
            } ?>



        </div>
    </div>



    <?php
    get_template_part('template-parts/content', 'product-prices-extra', $args);
    ?>
</div>