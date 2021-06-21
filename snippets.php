<form class="home-hero__content__search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <div class="home-hero__content__search-form__inputs">
        <div class="home-hero__content__search-form__inputs__form-group">
            <div class="home-hero__content__search-form__inputs__form-group__icon">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                </svg>
            </div>
            <div class="home-hero__content__search-form__inputs__form-group__input-group">
                <label for="destination" class="home-hero__content__search-form__inputs__form-group__input-group__label" id="chosen-value-label">Destination</label>
                <input class="home-destination-select" id="destination" type="text" value="" placeholder="Where would you like to go?" autocomplete="off">

                <ul class="home-destination-value-list">
                    <?php foreach ($destinations as $d) : ?>
                        <li postId="<?php echo $d->ID ?>"><?php echo get_field('navigation_title', $d) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <!-- Dates -->
        <div class="home-hero__content__search-form__inputs__form-group">
            <div class="home-hero__content__search-form__inputs__form-group__icon">
                <svg style="stroke-width: 2;">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-event-confirm"></use>
                </svg>
            </div>
            <div class="home-hero__content__search-form__inputs__form-group__input-group">
                <label for="dates" class="home-hero__content__search-form__inputs__form-group__input-group__label" id="date-label">
                    Travel Date
                </label>
                <div class="home-date-select" id="date-select">
                    When would you like to travel?
                </div>
                <div class="home-date-values" id="date-values">
                    <div class="home-date-values__years">
                        <div class="home-date-values__years__year selected" year="2021">
                            2021
                        </div>
                        <div class="home-date-values__years__year" year="2022">
                            2022
                        </div>
                    </div>
                    <ul class="home-date-values__months selected">
                        <li month="01" name="January">Jan</li>
                        <li month="02" name="February">Feb</li>
                        <li month="03" name="March">Mar</li>
                        <li month="04" name="April">Apr</li>
                        <li month="05" name="May">May</li>
                        <li month="06" name="June">Jun</li>
                        <li month="07" name="July">Jul</li>
                        <li month="08" name="August">Aug</li>
                        <li month="09" name="September">Sep</li>
                        <li month="10" name="October">Oct</li>
                        <li month="11" name="November">Nov</li>
                        <li month="12" name="December">Dec</li>
                    </ul>

                </div>


            </div>
        </div>
    </div>
    <!-- Destination -->



    <div class="home-hero__content__search-form__cta">
        <button type="submit" class="home-hero__content__search-form__cta__button" id="search-button" tabindex="2">
            <span>Search</span>

            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </button>
    </div>

    <input type="hidden" name="action" value="homeSearch">
    <input type="hidden" name="travel-month" id="travel-month" value="">
    <input type="hidden" name="travel-year" id="travel-year" value="">

    <input type="hidden" name="travel-destination" id="travel-destination" value="">
</form>
<div class="home-hero__content__arrow">
    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#intro">
        <svg class="btn-circle--arrow-main">
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
        </svg>
        <svg class="btn-circle--arrow-animate">
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
        </svg></button>
</div>








<!-- form -->
<form class="home-hero__content__search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">
    <input type="hidden" name="action" value="homeSearch">
    <input type="hidden" name="travel-month" id="travel-month" value="">
    <input type="hidden" name="travel-year" id="travel-year" value="">

    <input type="hidden" name="travel-destination" id="travel-destination" value="">