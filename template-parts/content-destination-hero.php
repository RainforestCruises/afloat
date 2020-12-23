  <?php
    $destination = $args['destination'];
    $locations = $args['locations'];
    $sliderContent = $args['sliderContent'];
    $title = $args['title'];

    $destinationType = $args['destinationType'];


    ?>

  <!-- Destination Hero -->
  <div class="destination-hero">
      <div class="destination-hero__bg-slide" id="destination-hero__bg">
          <?php foreach ($sliderContent as $s) :
                $sliderImage = $s['hero_image'];
            ?>
              <img src="<?php echo esc_url($sliderImage['url']); ?>" alt="">
          <?php endforeach; ?>
      </div>
      <div class="destination-hero__content">
          <div class="destination-hero__content__breadcrumb">
              <ol class="destination-hero__content__breadcrumb__path">
                  <li>
                      <a href="#">Destinations</a>
                  </li>
                  <li>
                      <?php echo $title  ?>
                  </li>
              </ol>
          </div>
          <div class="destination-hero__content__title">
              <?php echo get_the_title(); ?>
          </div>

          <div class="destination-hero__content__page-nav">


              <!-- sticky wrapper -->
              <nav class="destination-hero__content__page-nav__sticky-wrapper" id="template-nav">
                  <div class="destination-hero__content__page-nav__title" id="template-nav-title" href="#top">
                      <?php echo $title  ?>
                  </div>
                  <ul class="destination-hero__content__page-nav__list">
                      <!-- Order depending on template type -->
                      <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#tours" class="destination-hero__content__page-nav__list__item__link ">Tours</a>
                          </li>

                          <?php if ($destinationType == 'destination') {
                                $hide_cruises = get_field('hide_cruises');
                                if (!$hide_cruises) { ?>
                                  <li class="destination-hero__content__page-nav__list__item">
                                      <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                                  </li>
                              <?php }
                            } else { ?>
                              <li class="destination-hero__content__page-nav__list__item">
                                  <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                              </li>
                          <?php } ?>


                          <?php if ($destinationType == 'destination') {
                                $hide_accommodations = get_field('hide_accommodations');
                                if (!$hide_accommodations) { ?>
                                  <li class="destination-hero__content__page-nav__list__item">
                                      <a href="#accommodations" class="destination-hero__content__page-nav__list__item__link">Accommodations</a>
                                  </li>
                              <?php }
                            } else { ?>
                              <li class="destination-hero__content__page-nav__list__item">
                                  <a href="#accommodations" class="destination-hero__content__page-nav__list__item__link">Accommodations</a>
                              </li>
                          <?php } ?>


                      <?php } else if ($destinationType == 'cruise') { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                          </li>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#tours" class="destination-hero__content__page-nav__list__item__link ">Tours</a>
                          </li>
                      <?php } ?>



                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#travel-guides" class="destination-hero__content__page-nav__list__item__link">Travel Guides</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#testimonials" class="destination-hero__content__page-nav__list__item__link">Testimonials</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#faq" class="destination-hero__content__page-nav__list__item__link">FAQ</a>
                      </li>
                  </ul>
                  <div class="page-nav__button">
                      <?php echo $title  ?>
                      <svg>
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                      </svg>
                  </div>
                  <!-- page-nav__collapse--active -->
                  <nav class="page-nav__collapse ">
                      <ul class="page-nav__collapse__list">
                          <!-- Order depending on template type -->
                          <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                              <li class="page-nav__collapse__list__item">
                                  <a href="#tours" class="page-nav__collapse__list__item__link">Tours</a>
                              </li>
                              <?php if ($destinationType == 'destination') {
                                    $hide_cruises = get_field('hide_cruises');
                                    if (!$hide_cruises) { ?>
                                      <li class="page-nav__collapse__list__item">
                                          <a href="#cruises" class="page-nav__collapse__list__item__link">Cruises</a>
                                      </li>
                                  <?php }
                                } else { ?>
                                  <li class="page-nav__collapse__list__item">
                                      <a href="#cruises" class="page-nav__collapse__list__item__link">Cruises</a>
                                  </li>
                              <?php } ?>

                              <?php if ($destinationType == 'destination') {
                                    $hide_accommodations = get_field('hide_accommodations');
                                    if (!$hide_accommodations) { ?>
                                      <li class="page-nav__collapse__list__item">
                                          <a href="#accommodations" class="page-nav__collapse__list__item__link">Accommodations</a>
                                      </li>
                                  <?php }
                                } else { ?>
                                  <li class="page-nav__collapse__list__item">
                                      <a href="#accommodations" class="page-nav__collapse__list__item__link">Accommodations</a>
                                  </li>
                              <?php } ?>



                          <?php } else if ($destinationType == 'cruise') { ?>
                              <li class="page-nav__collapse__list__item">
                                  <a href="#cruises" class="page-nav__collapse__list__item__link">Cruises</a>
                              </li>
                              <li class="page-nav__collapse__list__item">
                                  <a href="#tours" class="page-nav__collapse__list__item__link">Tours</a>
                              </li>
                          <?php } ?>

                          <li class="page-nav__collapse__list__item">
                              <a href="#travel-guides" class="page-nav__collapse__list__item__link">Travel Guides</a>

                          </li>
                          <li class="page-nav__collapse__list__item">
                              <a href="#testimonials" class="page-nav__collapse__list__item__link">Testimonials</a>
                          </li>
                          <li class="page-nav__collapse__list__item" href="#faq">
                              <a href="#faq" class="page-nav__collapse__list__item__link">FAQ</a>
                          </li>
                      </ul>
                  </nav>
              </nav>

              <div class="destination-hero__content__page-nav__arrow">
                  <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#tours">
                      <svg class="btn-circle--arrow-main">
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                      </svg>
                      <svg class="btn-circle--arrow-animate">
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                      </svg></button>
              </div>
          </div>


          <div class="destination-hero__content__location">
              <div class="destination-hero__content__location__slider" id="destination-hero__content__location__slider">
                  <?php foreach ($sliderContent as $s) : ?>
                      <div class="destination-hero__content__location__slider__item">
                          <div class="destination-hero__content__location__slider__item__title">
                              <?php echo $s['hero_title']; ?>
                          </div>
                          <div class="destination-hero__content__location__slider__item__text">
                              <?php echo $s['hero_short_text']; ?>
                          </div>
                      </div>
                  <?php endforeach; ?>


              </div>

          </div>
      </div>
  </div>