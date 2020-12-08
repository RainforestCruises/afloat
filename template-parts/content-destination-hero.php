  
<?php
$destination = $args['destination'];
$locations = $args['locations'];

?>
  
  <!-- Destination Hero -->
  <div class="destination-hero">
      <div class="destination-hero__bg-slide" id="destination-hero__bg">
          <?php foreach ($locations as $s) : ?>
              <img src="<?php echo wp_get_attachment_url($s->hero_image); ?>" alt="">

          <?php endforeach; ?>
      </div>
      <div class="destination-hero__content">
          <div class="destination-hero__content__breadcrumb">
              <ol class="destination-hero__content__breadcrumb__path">
                  <li>
                      <a href="#">Destinations</a>
                  </li>
                  <li>
                      <?php echo ($destination->post_title) ?>
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
                      <?php echo ($destination->post_title) ?>
                  </div>
                  <ul class="destination-hero__content__page-nav__list">
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#tours" class="destination-hero__content__page-nav__list__item__link ">Tours</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#cruises" class="destination-hero__content__page-nav__list__item__link ">Cruises</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#accommodations" class="destination-hero__content__page-nav__list__item__link">Accommodations</a>
                      </li>

                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#travel-guides" class="destination-hero__content__page-nav__list__item__link">Travel Guides</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#reviews" class="destination-hero__content__page-nav__list__item__link">Reviews</a>
                      </li>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#faq" class="destination-hero__content__page-nav__list__item__link">FAQ</a>
                      </li>
                  </ul>
                  <div class="page-nav__button">
                      <?php echo ($destination->post_title) ?>
                      <svg>
                          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                      </svg>
                  </div>
                  <!-- page-nav__collapse--active -->
                  <nav class="page-nav__collapse ">
                      <ul class="page-nav__collapse__list">
                          <li class="page-nav__collapse__list__item" href="#tours">
                              Tours
                          </li>
                          <li class="page-nav__collapse__list__item" href="#cruises">
                              Cruises
                          </li>
                          <li class="page-nav__collapse__list__item" href="#accommodations">
                              Accommodations
                          </li>
                          <li class="page-nav__collapse__list__item" href="#travel-guides">
                              Travel Guides
                          </li>
                          <li class="page-nav__collapse__list__item" href="#reviews">
                              Reviews
                          </li>
                          <li class="page-nav__collapse__list__item" href="#faq">
                              FAQ
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
                  <?php foreach ($locations as $s) : ?>
                      <div class="destination-hero__content__location__slider__item">
                          <div class="destination-hero__content__location__slider__item__title">
                              <?php echo ($s->hero_title); ?>
                          </div>
                          <div class="destination-hero__content__location__slider__item__text">
                              <?php echo ($s->hero_short_text); ?>
                          </div>
                      </div>
                  <?php endforeach; ?>


              </div>

          </div>
      </div>
  </div>