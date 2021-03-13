  <?php
    $destination = $args['destination'];
    $locations = $args['locations'];
    $sliderContent = $args['sliderContent'];
    $title = $args['title'];

    $destinationType = $args['destinationType'];


    //CLOUDINARY
    // foreach ($sliderContent as $s) :
    //     $sliderImage = $s['image'];
    //     $cloud_image = cloudinary_url($sliderImage['filename'], array("width" => 750, "height" => 1334, "crop" => "fill", "gravity" => "auto", "fetch_format" => "auto"));
    //     console_log($cloud_image);
    // endforeach; 




    ?>


  <!-- Destination Hero -->
  <div class="destination-hero">
      <div class="destination-hero__bg-slider" id="destination-hero__bg-slider">
          <?php foreach ($sliderContent as $s) :
                $sliderImage = $s['image'];
            ?>
              <div class="destination-hero__bg-slider__slide">
                <img <?php afloat_responsive_image($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?> alt="">
              </div>

          <?php endforeach; ?>
      </div>
      <div class="destination-hero__content">
          <div class="destination-hero__content__title-group">
              <div class="destination-hero__content__title-group__breadcrumb">
                  <ol class="destination-hero__content__title-group__breadcrumb__path">
                      <li>
                          <a href="#">Destinations</a>

                      </li>
                      <li>
                          <?php echo $title ?>
                      </li>
                  </ol>
              </div>
              <div class="destination-hero__content__title-group__title">
                  <?php echo get_the_title(); ?>
              </div>
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
                              <a href="#packages" class="destination-hero__content__page-nav__list__item__link ">Packages</a>
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
                                      <a href="#accommodation" class="destination-hero__content__page-nav__list__item__link">Accommodation</a>
                                  </li>
                              <?php }
                            } else { ?>
                              <li class="destination-hero__content__page-nav__list__item">
                                  <a href="#accommodation" class="destination-hero__content__page-nav__list__item__link">Accommodation</a>
                              </li>
                          <?php } ?>


                      <?php } else if ($destinationType == 'cruise') { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                          </li>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#packages" class="destination-hero__content__page-nav__list__item__link ">Packages</a>
                          </li>
                      <?php } ?>



                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#travel-guide" class="destination-hero__content__page-nav__list__item__link">Travel Guide</a>
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
                                  <a href="#packages" class="page-nav__collapse__list__item__link">Packages</a>
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
                                          <a href="#accommodation" class="page-nav__collapse__list__item__link">Accommodation</a>
                                      </li>
                                  <?php }
                                } else { ?>
                                  <li class="page-nav__collapse__list__item">
                                      <a href="#accommodation" class="page-nav__collapse__list__item__link">Accommodation</a>
                                  </li>
                              <?php } ?>



                          <?php } else if ($destinationType == 'cruise') { ?>
                              <li class="page-nav__collapse__list__item">
                                  <a href="#cruises" class="page-nav__collapse__list__item__link">Cruises</a>
                              </li>
                              <li class="page-nav__collapse__list__item">
                                  <a href="#packages" class="page-nav__collapse__list__item__link">Packages</a>
                              </li>
                          <?php } ?>

                          <li class="page-nav__collapse__list__item">
                              <a href="#travel-guide" class="page-nav__collapse__list__item__link">Travel Guide</a>

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
                  <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="<?php echo ($destinationType == 'cruise' ? '#cruises' : '#packages') ?>">
                      <svg class="btn-circle--arrow-main">
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                      </svg>
                      <svg class="btn-circle--arrow-animate">
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                      </svg></button>
              </div>
          </div>


          <div class="destination-hero__content__location">
              <?php
                $slideCount = 0;
                if ($sliderContent) : ?>
                  <div class="destination-hero__content__location__slider" id="destination-hero__content__location__slider">

                      <?php foreach ($sliderContent as $s) : ?>
                          <div class="destination-hero__content__location__slider__item">
                              <div class="destination-hero__content__location__slider__item__title">
                                  <?php echo $s['title']; ?>
                              </div>
                              <div class="destination-hero__content__location__slider__item__text">
                                  <?php echo $s['caption']; ?>
                              </div>
                              <?php if ($s['link'] != null) : ?>
                                  <div class="destination-hero__content__location__slider__item__cta">

                                      <a class="goto-button goto-button--hero goto-button--small hero-link" href="<?php echo $s['link']; ?>">
                                      Explore <?php echo $s['title']; ?>
                                          <svg>
                                              <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                          </svg>
                                      </a>
                                  </div>
                              <?php endif; ?>
                          </div>
                      <?php
                            $slideCount++;
                        endforeach;
                        ?>

                  </div>
                  <div class="destination-hero__content__location__progress">
                      <div class="destination-hero__content__location__progress__odometer " id="odometer">01</div>
                      <div class="destination-hero__content__location__progress__bar">
                          <div class="progress"></div>
                      </div>


                      <div class="destination-hero__content__location__progress__odometer-top"><?php echo str_pad($slideCount, 2, "0", STR_PAD_LEFT); ?></div>
                  </div>
              <?php endif; ?>
          </div>
      </div>
  </div>