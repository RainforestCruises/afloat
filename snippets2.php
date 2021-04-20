<div class="product-hero__bottom__content__info-group__attributes__item__title">
    <?php echo (get_post_type($p) == 'rfc_tours') ? "Experience" : "Capacity"; ?>
</div>
<div class="product-hero__bottom__content__info-group__attributes__item__data">
    <?php if (get_post_type($p) == 'rfc_tours') : ?>
        <?php $experiences = get_field('experiences');
        if ($experiences) : ?>
            <ul>
                <?php foreach ($experiences as $e) : ?>
                    <li><?php echo get_the_title($e) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    <?php else : ?>
        <?php echo get_field('vessel_capacity') . ' Guests'; ?>
    <?php endif; ?>
</div>

<div class="product-hero__bottom__content__info-group__attributes__item__title">
    <?php echo (get_post_type($p) == 'rfc_tours') ? "Itinerary" : "Itineraries"; ?>
</div>

<?php echo (get_post_type($p) == 'rfc_tours') ? "tour" : ""; ?>


<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><title>m search</title><g class="nc-icon-wrapper" stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor"><polyline points="39 58.8 22 52 2 58 2 10 22 4 42 12 62 6 62 41" fill="none" stroke="currentColor" stroke-miterlimit="10"></polyline> <line x1="62" y1="60" x2="53.07" y2="51.07" fill="none" stroke-miterlimit="10" data-cap="butt" data-color="color-2" stroke-linecap="butt"></line> <circle cx="46" cy="44" r="10" fill="none" stroke-miterlimit="10" data-color="color-2"></circle> <line x1="22" y1="4" x2="22" y2="52" fill="none" stroke="currentColor" stroke-miterlimit="10" data-cap="butt" stroke-linecap="butt"></line> <line x1="42" y1="12" x2="42" y2="28" fill="none" stroke="currentColor" stroke-miterlimit="10" data-cap="butt" stroke-linecap="butt"></line></g></svg>


<div class="product-hero__bottom__content__info-group__attributes__item__data__primary">
                                <?php if ($charter_view == false) : ?>
                                    <?php echo (get_post_type($p) == 'rfc_tours') ? get_field('length') . " Days" : itineraryRange($args['cruiseData'], " - ") . " Days"; ?>
                                <?php else :
                                    echo get_field('charter_min_days') . " Days +";
                                endif; ?>
                            </div>
                            <div class="product-hero__bottom__content__info-group__attributes__item__data__secodary">
                                3 Itineraries
                            </div>