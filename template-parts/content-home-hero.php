  <!--  Hero -->
  <div class="home-hero">
      <img src="<?php echo bloginfo('template_url') ?>/css/img/test-images/peru-01.jpg" alt="" class="home-hero__bg">
      <div class="home-hero__content">
          <div class="home-hero__content__title-group">
              <div class="home-hero__content__title-group__title">
                  An Experience Far From Ordinary
              </div>
              <div class="home-hero__content__title-group__divider">
                  <svg>
                      <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                  </svg>
              </div>
              <div class="home-hero__content__title-group__subtitle">
                  Tailor Made Adventure Travel
              </div>
          </div>

          <form class="home-hero__content__search-form">

              <div class="home-hero__content__search-form__inputs">
                  <!-- Destination -->
                  <div class="home-hero__content__search-form__inputs__form-group">
                      <div class="home-hero__content__search-form__inputs__form-group__icon">
                          <svg>
                              <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                          </svg>
                      </div>
                      <div class="home-hero__content__search-form__inputs__form-group__input-group">
                          <label for="destination" class="home-hero__content__search-form__inputs__form-group__input-group__label" id="chosen-value-label">Destination</label>
                          <input class="chosen-value" type="text" value="" placeholder="Where would you like to go?">
                          <ul class="value-list">
                              <li>Alabama</li>
                              <li>Alaska</li>
                              <li>Arizona</li>
                              <li>Arkansas</li>
                              <li>California</li>
                              <li>Colorado</li>
                              <li>Connecticut</li>
                              <li>Delaware</li>
                              <li>Florida</li>

                          </ul>
                      </div>

                  </div>

                  <!-- Dates -->
                  <div class="home-hero__content__search-form__inputs__form-group">
                      <div class="home-hero__content__search-form__inputs__form-group__icon">
                          <svg>
                              <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-event-confirm"></use>
                          </svg>
                      </div>
                      <div class="home-hero__content__search-form__inputs__form-group__input-group">
                          <label for="dates" class="home-hero__content__search-form__inputs__form-group__input-group__label">Travel
                              Date</label>
                          <input type="text" class="home-hero__content__search-form__inputs__form-group__input-group__input" id="dates" tabindex="1" placeholder="When would you like to travel?" />
                      </div>
                  </div>
              </div>


              <div class="home-hero__content__search-form__cta">
                  <button class="home-hero__content__search-form__cta__button">
                      Search
                  </button>
              </div>
          </form>
      </div>
  </div>