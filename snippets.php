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




<!-- CTA Question -->
<div class="travel-guide__question">
    <div class="travel-guide__question__title">
        Any Questions? Ask Us!
    </div>

    <span class="travel-guide__question__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum nesciunt architecto, iste sit similique hic.</span>
    <a href="<?php echo get_home_url() . '/contact'; ?>" class="travel-guide__question__button">
        Ask us a question
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
        </svg>
    </a>
</div>

<!-- Social -->
<div class="travel-guide__social">
    <a href="<?php echo get_field('facebook_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
        </svg>
    </a>
    <a href="<?php echo get_field('instagram_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
        </svg>
    </a>
    <a href="<?php echo get_field('twitter_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-twitter"></use>
        </svg>
    </a>
    <a href="<?php echo get_field('pinterest_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
        </svg>
    </a>
    <a href="<?php echo get_field('youtube_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
        </svg>
    </a>
    <a href="<?php echo get_field('linked_in_link', 'options'); ?>" class="travel-guide__social__link">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-linkedin"></use>
        </svg>
    </a>
</div>