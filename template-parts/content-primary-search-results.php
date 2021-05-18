<?php
$results = $args;
foreach ($results as $result) :
?>
    <div class="search-result">
        <div class="search-result__image-area">
            <img src="<?php echo esc_html($result->productImageUrl); ?>" alt="">
        </div>
        <div class="search-result__content">
            <div class="search-result__content__top">
                <div class="search-result__content__top__title-group">
                    <div class="search-result__content__top__title-group__subtitle">
                        <?php echo $result->productTypeDisplay ?>
                    </div>
                    <div class="search-result__content__top__title-group__title">
                        <?php echo $result->productTitle ?>
                    </div>
                </div>
                <div class="search-result__content__top__snippet">
                    <?php echo $result->snippet ?>
                </div>
            </div>
            <div class="search-result__content__bottom">
                <div class="search-result__content__bottom__details">
                    <div class="search-result__content__bottom__details__group">
                        <span class="search-result__content__bottom__details__group__title">
                            Regions:
                        </span>
                        <span class="search-result__content__bottom__details__group__text">
                            <?php
                            $destinations = $result->destinations;
                            if ($destinations) :
                                echo comma_separate_list($destinations);
                            endif; ?>
                        </span>
                    </div>
                    <div class="search-result__content__bottom__details__group">
                        <span class="search-result__content__bottom__details__group__title">
                            Destinations:
                        </span>
                        <span class="search-result__content__bottom__details__group__text">
                            <?php
                            $locations = $result->locations;
                            if ($locations) :
                                echo comma_separate_list($locations);
                            endif; ?>
                        </span>
                    </div>
                </div>
                <div class="search-result__content__bottom__experiences">
                    <!-- Experience Item -->

                    <?php $experiences = $result->experiences;
                    if ($experiences) :
                        foreach ($experiences as $e) :
                            $experienceSvg = get_field('icon', $e); ?>
                            <div class="search-result__content__bottom__experiences__item">
                                <div class="experience-icon">
                                    <?php echo $experienceSvg; ?>
                                    <span class="tooltiptext"><?php echo get_the_title($e); ?></span>
                                </div>
                            </div>

                    <?php endforeach;
                    endif; ?>

                </div>
            </div>

        </div>
        <div class="search-result__detail">
            <div class="search-result__detail__info">
                <div class="search-result__detail__info__price-from">
                    <div class="search-result__detail__info__price-from__text">
                        Starting From
                    </div>
                    <div class="search-result__detail__info__price-from__price">
                        <?php echo "$" . number_format($result->lowestPrice, 0);  ?>
                        <span>
                            USD
                        </span>
                    </div>
                </div>
                <div class="search-result__detail__info__attributes">

                    <!-- Length -->
                    <div class="search-result__detail__info__attributes__item">
                        <div class="search-result__detail__info__attributes__item__data">
                            <div class="search-result__detail__info__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                            </div>
                            <div class="search-result__detail__info__attributes__item__data__text">
                                <?php echo $result->itineraryLengthDisplay; ?>
                                <div class="sub-attribute">
                                    <?php echo $result->itineraryCountDisplay; ?>
                                </div>
                            </div>

                        </div>
                    </div>



                    <!-- Capacity -->
                    <?php if ($result->postType != 'rfc_tours') : ?>
                        <div class="search-result__detail__info__attributes__item">
                            <div class="search-result__detail__info__attributes__item__data">
                                <div class="search-result__detail__info__attributes__item__data__icon">
                                    <svg>
                                        <?php if ($result->postType == 'rfc_cruises') : ?>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                        <?php elseif ($result->postType == 'rfc_lodges') : ?>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-bed-23"></use>
                                        <?php endif; ?>
                                    </svg>
                                </div>
                                <div class="search-result__detail__info__attributes__item__data__text">
                                    <?php echo $result->vesselCapacityDisplay; ?>
                                    <div class="sub-attribute">
                                        <?php echo $result->numberOfCabinsDisplay; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="search-result__detail__cta">
                <a href="<?php echo get_permalink($result->post);  ?>" class="btn-cta-round btn-cta-round--small">
                    View <?php echo $result->productTypeCta; ?>
                </a>
            </div>

        </div>

    </div>



<?php endforeach; ?>







<form class="search-results__grid__pagination" form="search-form">
    <?php
    if ($pageCount != 1 && $pageNumber != 'all') : ?>
        <div class="search-results__grid__pagination__pages-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--back-button btn-circle btn-circle--left btn-circle--small  <?php echo ($pageNumber == 1) ? 'btn-circle--disabled' : ''; ?>" style="margin-right: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg>
            </button>
            <?php
            for ($k = 1; $k <= $pageCount; $k++) :
            ?>
                <button class="btn-circle btn-circle--small  <?php echo ($pageNumber == $k) ? 'btn-circle--current' : ''; ?> search-results__grid__pagination__pages-group__button " value="<?php echo $k ?>">
                    <?php echo $k ?>
                </button>
            <?php endfor;
            ?>
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--next-button btn-circle btn-circle--right btn-circle--small <?php echo ($pageNumber == $pageCount) ? 'btn-circle--disabled' : ''; ?>" style="margin-left: 4rem;"><svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg><svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </button>
        </div>
        <div class="search-results__grid__pagination__show-all-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--all-button btn-outline btn-outline--small btn-outline--dark">
                Show All
            </button>
        </div>

    <?php endif; ?>
    <!-- <input type="hidden" name="pageNumber" id="pageNumber" form="search-form" value="1"> -->
</form>
<div id="pageNumberDisplay" style="display: none;" value="<?php echo $pageNumber ?>"> </div>
<div id="totalResultsDisplay" style="display: none;" value="<?php echo $resultsTotal ?>"> </div>


<?php
function sortPrice($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestPrice - $b->lowestPrice;
    }
}
function sortPriceDescending($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestPrice - $a->lowestPrice;
    }
}

function sortCharter($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($b->charterOnly, $a->charterOnly);
    }
}
?>