<?php
$destination = $args['destination'];
$cruises_image = get_field('cruises_image');
$travel_guide_posts = get_field('travel_guide_posts');

?>

<div class="destination-guides">
    <div class="destination-guides__header page-divider page-divider--padding">
        Travel Guide
    </div>
    <div class="destination-guides__sub-text">
        <?php echo get_field('travel_guide_title_subtext') ?>
    </div>
    <div class="destination-guides__grid-container">
        <div class="destination-guides__grid-container__grid">
            <?php if ($travel_guide_posts) :
                foreach ($travel_guide_posts as $p) :
                    $travel_guide = $p['travel_guide'];
                    $img = get_field('featured_image', $travel_guide);
                    $categories = get_field('categories', $travel_guide);
                    $displayCategory = "Travel Guide";

                    $displayTitle = get_field('navigation_title', $travel_guide);

                    if ($categories) {
                        $first = $categories[0];
                        $displayCategory = get_the_title($first);
                    }
            ?>
                    <div class="destination-guides__grid-container__grid__item">
                        <img src="<?php echo esc_url($img['url']); ?>" alt="">
                        <div class="destination-guides__grid-container__grid__item__content">
                            <div class="destination-guides__grid-container__grid__item__content__category">
                                <?php echo $displayCategory ?>
                            </div>
                            <div class="destination-guides__grid-container__grid__item__content__title">
                                <?php echo $displayTitle ?>
                            </div>
                            <div class="destination-guides__grid-container__grid__item__content__link">
                                <a class="goto-button" href="<?php echo get_permalink($travel_guide); ?>">
                                    Read Guide
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
    <div class="destination-guides__btn ">
        <a class="btn-outline btn-outline--dark  " href="<?php echo get_field('view_all_guide_link') ?>">View All Travel Guide</a>
    </div>

</div>