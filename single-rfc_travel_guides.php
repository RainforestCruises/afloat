<?php
get_header();
wp_enqueue_script('page-travel-guide', get_template_directory_uri() . '/js/page-travel-guide.js', array('jquery'), false, true);

?>
<?php
while (have_posts()) :
  the_post();


  $destination = get_field('destination');
  $featured_image = get_field('featured_image');
?>

  <!-- Product Page Container -->
  <div class="travel-guide-page">
    <div class="travel-guide">
      <div class="travel-guide__category">
        Travel Inspiration
      </div>
      <div class="travel-guide__title">
        <?php echo get_the_title(); ?>
      </div>
      <div class="travel-guide__image">
        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
      </div>
      <div class="travel-guide__disclaimer">
        <div class="disclaimer-box">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-c-warning"></use>
          </svg>
          <div class="disclaimer-box__warning">
            <span>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui quis perferendis
            </span>

            <button>
              Please read our disclaimer
              <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="travel-guide__content drop-cap-1a">
        <?php echo the_content(); ?>
      </div>
      <div class="travel-guide__question">
        <div class="travel-guide__question__title">
          Any Questions? Ask Us!
        </div>

        <span class="travel-guide__question__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum nesciunt architecto, iste sit similique hic.</span>
        <button class="travel-guide__question__button">
          Ask us a question
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
          </svg>
        </button>
      </div>
      <div class="travel-guide__entry">
        This entry was posted ----
      </div>
      <div class="travel-guide__social">
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
        </svg>
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
        </svg>
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
        </svg>
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
        </svg>
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
        </svg>
      </div>
    </div>
    <div class="travel-guide-related">
      <div class="travel-guide-related__title">
        You may also like
      </div>
      <div class="travel-guide-related__slider-area">
        <div class="travel-guide-related__slider-area__slider" id="related-slider">

          <!-- Item -->
          <div class="travel-guide-related__slider-area__slider__item">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="travel-guide-related__slider-area__slider__item__image">
            <div class="travel-guide-related__slider-area__slider__item__content">
              <div class="travel-guide-related__slider-area__slider__item__content__title">
                5 Things to do in the Amazon
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__text">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta ratione libero sint accusantium minus voluptate dolore? Sit repudiandae molestiae
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__cta">
                <button class="goto-button goto-button--small">
                  Read More
                  <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Item -->
          <div class="travel-guide-related__slider-area__slider__item">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="travel-guide-related__slider-area__slider__item__image">
            <div class="travel-guide-related__slider-area__slider__item__content">
              <div class="travel-guide-related__slider-area__slider__item__content__title">
                5 Things to do in the Amazon
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__text">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta ratione libero sint accusantium minus voluptate dolore? Sit repudiandae molestiae
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__cta">
                <button class="goto-button goto-button--small">
                  Read More
                  <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <!-- Item -->
          <div class="travel-guide-related__slider-area__slider__item">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="travel-guide-related__slider-area__slider__item__image">
            <div class="travel-guide-related__slider-area__slider__item__content">
              <div class="travel-guide-related__slider-area__slider__item__content__title">
                5 Things to do in the Amazon
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__text">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta ratione libero sint accusantium minus voluptate dolore? Sit repudiandae molestiae
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__cta">
                <button class="goto-button goto-button--small">
                  Read More
                  <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <!-- Item -->
          <div class="travel-guide-related__slider-area__slider__item">
            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="travel-guide-related__slider-area__slider__item__image">
            <div class="travel-guide-related__slider-area__slider__item__content">
              <div class="travel-guide-related__slider-area__slider__item__content__title">
                5 Things to do in the Amazon
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__text">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta ratione libero sint accusantium minus voluptate dolore? Sit repudiandae molestiae
              </div>
              <div class="travel-guide-related__slider-area__slider__item__content__cta">
                <button class="goto-button goto-button--small">
                  Read More
                  <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="travel-guide-newsletter">
      <div class="travel-guide-newsletter__content">
        <div class="travel-guide-newsletter__content__title">
          Stay up to date with the latest
        </div>
        <div class="travel-guide-newsletter__content__text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, perspiciatis deserunt id dolore suscipit fuga accusantium voluptas atque consectetur!
        </div>
        <div class="travel-guide-newsletter__content__email">
          <input type="text" placeholder="Enter your email" class="travel-guide-newsletter__content__email__input">
          <button class="travel-guide-newsletter__content__email__button">Submit</button>
        </div>
      </div>
      <div class="travel-guide-newsletter__image">
        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">

      </div>
    </div>
  </div>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>


<script>
  var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>