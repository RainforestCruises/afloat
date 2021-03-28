<?php
$cruise_data = $args['cruiseData'];
$deck_plan = get_field('deck_plan');
$charter_view = false;

if ($args['propertyType'] == 'Cruise') {
    if ($args['charter_view'] == true) {
        $charter_view = true;
    }
}
?>


<div class="product-cabins">

    <!-- <div id="sentinal-cabins"></div> -->


    <div class="xsub-divider u-margin-bottom-small">
        Suites & Cabins
    </div>
    <!-- Cabins -->
    <?php
    $cabins = $cruise_data['CabinDTOs'];
    $cabinCount = 0;
    if ($cabins) : ?>

        <?php foreach ($cabins as $cabin) : ?>
            <?php
            $occupancy = $cabins[$cabinCount]['PrimaryOccupancy'];
            if ($cabins[$cabinCount]['SecondaryEnabled'] == true) {
                $occupancy = $occupancy + $cabins[$cabinCount]['SecondaryOccupancy'];
            }


            ?>
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__image-area">
                    <img src="<?php echo esc_html($cabins[$cabinCount]['ImageDTOs'][0]['ImageUrl']); ?>" alt="">
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title">
                        <h3 class="heading-3 heading-3--underline"><?php echo ($cabins[$cabinCount]['Name']); ?></h3>
                    </div>
                    <div class="product-cabins__cabin__content__feature-grid">
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Guests
                            </h5>
                            <span><?php echo $occupancy; ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Size
                            </h5>
                            <span><?php echo ($cabins[$cabinCount]['Size']); ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Beds
                            </h5>
                            <span><?php echo ($cabins[$cabinCount]['Beds']); ?></span>
                        </div>
                    </div>
                    <?php echo ($cabins[$cabinCount]['Features']); ?>

                </div>
            </div>
            <?php
            $cabinCount++;
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Technical Info -->
<?php if ($deck_plan) { ?>

    <div class="product-technical">
        <div class="xsub-divider">
            Technical Information
        </div>
        <div class="product-technical__content">
            <div class="product-technical__content__image-area">
                <div class="product-technical__content__image-area__title">
                    <?php echo (get_post_type() == 'rfc_cruises') ? 'Deck Plan' : 'Property Layout' ?>
                </div>
                <a class="product-technical__content__image-area" id="map-lightbox" href="<?php echo esc_url($deck_plan['url']); ?>" title="Deckplan">
                    <img src="<?php echo esc_url($deck_plan['url']); ?>" alt="">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                    </svg>
                </a>
            </div>


            <div class="product-technical__content__info">
                <div class="product-technical__content__info__title">
                    Features
                </div>

                <?php
                $ship_features = get_field('ship_features');
                if ($ship_features) : ?>

                    <ul class="product-technical__content__info__list">
                        <li class="product-technical__content__info__list__item">
                            <div class="product-technical__content__info__list__item__title">Number of Cabins: </div>
                            <div class="product-technical__content__info__list__item__data"><?php echo $ship_features['number_of_cabins']; ?></div>
                        </li>
                        <li class="product-technical__content__info__list__item">
                            <div class="product-technical__content__info__list__item__title">Capacity: </div>
                            <div class="product-technical__content__info__list__item__data"><?php echo $ship_features['capacity']; ?> guests</div>
                        </li>
                        <li class="product-technical__content__info__list__item">
                            <div class="product-technical__content__info__list__item__title">Interconnectable Cabins: </div>
                            <div class="product-technical__content__info__list__item__data"><?php echo $ship_features['interconnectable_cabins']; ?></div>
                        </li>
                        <li class="product-technical__content__info__list__item">
                            <div class="product-technical__content__info__list__item__title">Air-Conditioning: </div>
                            <div class="product-technical__content__info__list__item__data"><?php echo $ship_features['air_conditioning']; ?></div>
                        </li>
                        <li class="product-technical__content__info__list__item product-technical__content__info__list__item--vertical">
                            <div class="product-technical__content__info__list__item__title">Bathrooms: </div>
                            <div class="product-technical__content__info__list__item__data product-technical__content__info__list__item__data--vertical"><?php echo $ship_features['bathrooms']; ?></div>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>


    </div>
<?php } ?>