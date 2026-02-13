<?php
$navTitle = "";
$destinationType = "";
$show_charters = get_field('show_charters');
$show_tours = get_field('show_tours');

$accommodationDisplayText = 'Lodges';

if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-region.php')) {
    $accommodationDisplayText = get_field('accommodations_label');

    if ($accommodationDisplayText == null) {
        $accommodationDisplayText = 'Lodges';
    }
}


if (is_page_template('template-destinations-region.php')) :
    $r = get_field('region_post');
    $navTitle = get_field('navigation_title', $r);
    $destinationType = "region";
elseif (is_page_template('template-destinations-destination.php')) :
    $destination = get_field('destination_post');
    $navTitle = get_field('navigation_title', $destination);
    $destinationType = "destination";

else :
    $destination = get_field('destination_post');
    $navTitle = get_field('navigation_title', $destination);
    $destinationType = "cruise";
endif;



//Filter deals based on expiration date
$dealArgs = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_deals',
    'meta_key' => 'value_rating',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'destinations', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);

$current_timestamp = current_time('timestamp');

$dealPosts  = get_posts($dealArgs); //Stage I posts
$validDeals = array();


foreach ($dealPosts as $deal) {
    $expiration_date = get_field('expiration_date', $deal->ID);

    // If no expiration date is set, include the deal
    if (empty($expiration_date)) {
        $validDeals[] = $deal;
        continue;
    }

    // Convert d/m/Y date to timestamp
    $expiration_timestamp = DateTime::createFromFormat('d/m/Y', $expiration_date)->getTimestamp();

    // Include deal if expiration date is in the future
    if ($expiration_timestamp >= $current_timestamp) {
        $validDeals[] = $deal;
    }
}


?>




<nav class="nav-secondary" id="nav-secondary">
    <div class="nav-secondary__main">
        <div class="nav-secondary__main__title-area">
            <a class="nav-secondary__main__title-area__title" id="nav-secondary-title" href="#top">
                <?php echo $navTitle ?>
            </a>
            <button class="nav-secondary__main__title-area__button" id="nav-secondary-button">
                <div class="nav-secondary__main__title-area__button__icon-area">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                    </svg>
                </div>
                <div class="nav-secondary__main__title-area__button__text-area">
                    <?php echo $navTitle ?>
                </div>

            </button>

        </div>
        <ul class="nav-secondary__main__links">

            <!-- Order depending on template type -->
            <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                <?php if ($show_tours) : ?>
                    <li>
                        <a href="#extensions">Extensions</a>
                    </li>
                <?php endif; ?>
                <?php if ($destinationType == 'destination') {
                    $hide_cruises = get_field('hide_cruises');
                    if (!$hide_cruises) : ?>
                        <li>
                            <a href="#ships">Ships</a>
                        </li>
                    <?php endif;
                    if ($show_charters) : ?>
                        <li>
                            <a href="#charters">Charters</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($destinationType != 'destination' && $validDeals) : ?>
                        <li>
                            <a href="#deals">Deals</a>
                        </li>
                    <?php endif; ?>
                <?php } else { ?>
                    <li>
                        <a href="#ships">Ships</a>
                    </li>
                <?php } ?>

                <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                    $hide_accommodations = get_field('hide_accommodations');
                    if (!$hide_accommodations) { ?>
                        <li>
                            <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                        </li>
                    <?php }
                } else { ?>
                    <li>
                        <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                    </li>
                <?php } ?>

            <?php } else if ($destinationType == 'cruise') { ?>
                <li>
                    <a href="#ships">Ships</a>
                </li>
                <?php if ($show_charters) : ?>
                    <li>
                        <a href="#charters">Charters</a>
                    </li>
                <?php endif; ?>
                <?php if ($destinationType != 'destination' && $validDeals) : ?>
                    <li>
                        <a href="#deals">Deals</a>
                    </li>
                <?php endif; ?>
                <?php if ($show_tours) : ?>
                    <li>
                        <a href="#extensions">Extensions</a>
                    </li>
                <?php endif; ?>

            <?php } ?>
            <?php if (get_field('show_travel_guide') == true) { ?>
                <li>
                    <a href="#travel-guide">Guide</a>
                </li>
            <?php } ?>
            <?php if (get_field('show_testimonials') == true) { ?>
                <li>
                    <a href="#testimonials">Testimonials</a>
                </li>
            <?php } ?>
            <li href="#faq">
                <a href="#faq">FAQ</a>
            </li>
        </ul>
        <div class="nav-secondary__main__cta">
            <button class="btn-cta-round btn-cta-round--small " id="nav-secondary-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>



<!--mobile menu expand-->
<nav class="nav-secondary-mobile ">
    <ul class="nav-secondary-mobile__list">

        <!-- Order depending on template type -->
        <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
            <?php if ($show_tours) : ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#extensions" class="nav-secondary-mobile__list__item__link">Extensions</a>
                </li>
            <?php endif; ?>
            <?php if ($destinationType == 'destination') {
                $hide_cruises = get_field('hide_cruises');
                if (!$hide_cruises) { ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#ships" class="nav-secondary-mobile__list__item__link">Ships</a>
                    </li>
                <?php }
                if ($show_charters) : ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#charters" class="nav-secondary-mobile__list__item__link">Charters</a>
                    </li>
                <?php endif; ?>
                <?php if ($destinationType != 'destination' && $validDeals) : ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#deals " class="nav-secondary-mobile__list__item__link">Deals</a>
                    </li>
                <?php endif; ?>
            <?php
            } else { ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#ships" class="nav-secondary-mobile__list__item__link">Ships</a>
                </li>
            <?php } ?>

            <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                $hide_accommodations = get_field('hide_accommodations');
                if (!$hide_accommodations) { ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                    </li>
                <?php }
            } else { ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                </li>
            <?php } ?>

        <?php } else if ($destinationType == 'cruise') { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#ships" class="nav-secondary-mobile__list__item__link">Ships</a>
            </li>
            <?php if ($show_charters) : ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#charters" class="nav-secondary-mobile__list__item__link">Charters</a>
                </li>
            <?php endif; ?>
            <?php if ($destinationType != 'destination' && $validDeals) : ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#deals " class="nav-secondary-mobile__list__item__link">Deals</a>
                </li>
            <?php endif; ?>
            <?php if ($show_tours) : ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#extensions" class="nav-secondary-mobile__list__item__link">Extensions</a>
                </li>
            <?php endif; ?>
        <?php } ?>

        <?php if (get_field('show_travel_guide') == true) { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#travel-guide" class="nav-secondary-mobile__list__item__link">Guide</a>
            </li>
        <?php } ?>
        <?php if (get_field('show_testimonials') == true) { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#testimonials" class="nav-secondary-mobile__list__item__link">Testimonials</a>
            </li>
        <?php } ?>
        <li class="nav-secondary-mobile__list__item" href="#faq">
            <a href="#faq" class="nav-secondary-mobile__list__item__link">FAQ</a>
        </li>

    </ul>
</nav>