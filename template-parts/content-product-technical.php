<!-- Technical Info -->


<?php 
$deck_plan = get_field('deck_plan');
$ship_features = get_field('ship_features');

if ($deck_plan) : ?>

<div class="product-technical">
    <div class="xsub-divider">
        Technical Information
    </div>
    <div class="product-technical__content">
        <div class="product-technical__content__image-area">
            <div class="product-technical__content__image-area__title">
                <?php echo (get_post_type() == 'rfc_cruises') ? 'Deck Plan' : 'Property Layout' ?>
            </div>
            <a class="product-technical__content__image-area" id="deckplan-image" href="<?php echo esc_url($deck_plan['url']); ?>" title="Deckplan">
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
<?php endif; ?>