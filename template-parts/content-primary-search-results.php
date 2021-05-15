<?php
$results = $args;

foreach ($results as $result) : ?>
    <a href="#" class="search-result">
        <div class="search-result__image-area">
            <img src="xxx" alt="">
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
                        
                            <?php if ($result->destinations) :
                                $count = 0;
                                $display = "";
                                foreach ($result->destinations as $d) : 
                                    if ($count != 0) {
                                        $display += ", " + get_field('navigation_title', $d->postId);
                                      } else {
                                        $display += get_field('navigation_title', $d->postId);
                                      }                                 
                                      $count++;
                                endforeach;
                                echo $display;
                            endif; ?>
                        </span>
                    </div>
                    <div class="search-result__content__bottom__details__group">
                        <span class="search-result__content__bottom__details__group__title">
                            Destinations:
                        </span>
                        <span class="search-result__content__bottom__details__group__text">
                            destinationsDisplay
                        </span>
                    </div>
                </div>
                <div class="search-result__content__bottom__experiences">
                    <!-- Experience Item -->
                    experienceHTML

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
                        $5,000
                        <span>
                            USD
                        </span>
                    </div>
                </div>
                <div class="search-result__detail__info__attributes">

                    <!-- Itineraries -->
                    <div class="search-result__detail__info__attributes__item">
                        <div class="search-result__detail__info__attributes__item__data">
                            <div class="search-result__detail__info__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                            </div>
                            <div class="search-result__detail__info__attributes__item__data__text">
                                itineraryRangeDisplay
                                <div class="sub-attribute">
                                    item.itineraryCountDisplay
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class="search-result__detail__info__attributes__item">
                        <div class="search-result__detail__info__attributes__item__data">
                            <div class="search-result__detail__info__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-boat-front"></use>
                                </svg>
                            </div>
                            <div class="search-result__detail__info__attributes__item__data__text">
                                vesselCapacity Guests
                                <div class="sub-attribute">
                                    numberOfCabins Cabins
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="search-result__detail__cta">
                <button class="btn-cta-round">
                    View Cruise
                </button>
            </div>

        </div>

    </a>



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