  <?php
    $queryArgs = array(
        'post_type' => array('rfc_destinations', 'rfc_regions'),
        'meta_key' => 'navigation_title',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    $destinations = get_posts($queryArgs);
    console_log($posts);
    ?>

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
                          <input class="home-destination-select" id="destination" type="text" value="" placeholder="Where would you like to go?" autocomplete="off">

                          <ul class="home-destination-value-list">
                              <?php foreach ($destinations as $d) : ?>
                                  <li><?php echo get_field('navigation_title', $d) ?></li>
                              <?php endforeach; ?>
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
                          <label for="dates" class="home-hero__content__search-form__inputs__form-group__input-group__label" id="date-label">Travel
                              Date</label>
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
                                  <li month="1" value="January">Jan</li>
                                  <li month="2" value="February">Feb</li>
                                  <li month="3" value="March">Mar</li>
                                  <li month="4"  value="April">Apr</li>
                                  <li month="5"  value="May">May</li>
                                  <li month="6"  value="June">Jun</li>
                                  <li month="7"  value="July">Jul</li>
                                  <li month="8"  value="August">Aug</li>
                                  <li month="9"  value="September">Sep</li>
                                  <li month="10"  value="October">Oct</li>
                                  <li month="11"  value="November">Nov</li>
                                  <li month="12"  value="December">Dec</li>
                              </ul>
                   
                          </div>


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