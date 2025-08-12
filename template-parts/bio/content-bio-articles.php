<?php
$articles = get_field('articles');
?>

<div class="destination-guides">
    <h2 class="destination-guides__header page-divider page-divider--padding bio-articles__title">
        My Latest Travel Guides
    </h2>
    <div class="destination-guides__sub-text">
        <?php echo get_field('travel_guide_title_subtext') ?>
    </div>
    <div class="destination-guides__grid-container">
        <div class="destination-guides__grid-container__grid">
            <?php if ($articles) :
                foreach ($articles as $article) :
                    $img = get_field('featured_image', $article);
                    $categories = get_field('categories', $article);
                    $displayCategory = "Travel Guide";

                    $displayTitle = get_field('navigation_title', $article);

                    if ($categories) {
                        $first = $categories[0];
                        $displayCategory = get_the_title($first);
                    }
            ?>
            <!-- Make link here -->
                    <a href="<?php echo get_permalink($article); ?>" class="destination-guides__grid-container__grid__item">
                        <img <?php afloat_image_markup($img['id'], 'featured-medium'); ?>>

                        <div class="destination-guides__grid-container__grid__item__content">
                            <div class="destination-guides__grid-container__grid__item__content__category">
                                <?php echo $displayCategory ?>
                            </div>
                            <h3 class="destination-guides__grid-container__grid__item__content__title">
                                <?php echo $displayTitle ?>
                            </h3>
                            <div class="destination-guides__grid-container__grid__item__content__link">
                                <button class="goto-button" >
                                    Read Guide
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </a>
            <?php endforeach;
            endif; ?>
        </div>
    </div>


</div>