<?php
get_header();
wp_enqueue_script('page-travel-guide', get_template_directory_uri() . '/js/page-travel-guide.js', array('jquery'), false, true);

?>
<?php
while (have_posts()) :
  the_post();
  $featured_image = get_field('featured_image');
  $queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID)
  );

  //build meta query criteria
  $queryArgsDestination = array();
  $queryArgsDestination['relation'] = 'OR';

  $destinations = get_field('destinations');

  foreach ($destinations as $d) {
    $queryArgsDestination[] = array(
      'key'     => 'destinations',
      'value'   => serialize(strval($d->ID)),
      'compare' => 'LIKE'
    );
  }
  $queryArgs['meta_query'][] = $queryArgsDestination;
  $travelGuidePosts = new WP_Query($queryArgs);
?>

  <?php
  $image  = get_field('featured_image');
  $image_srcset = wp_get_attachment_image_srcset($image['ID']);
  //$image_meta = wp_get_attachment_metadata( $image['ID'] );
  //$image_responsive =  wp_get_attachment_image_url( $image['ID'], 'landscape-small');
  //$image_sizes =  wp_get_attachment_image_sizes( $image['ID'], 'landscape-large');

  //$code = acf_responsive_image($image['ID'],'landscape-large', array('landscape-small','landscape-medium','landscape-large'), '1200px');
  //$test = wp_get_attachment_image($image['ID'], 'landscape-small');
  //console_log($code);
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
        <!-- responsive image -->
        <img <?php afloat_responsive_image($image['ID'], 'landscape-large', array('landscape-small', 'landscape-medium', 'landscape-large')); ?> alt="">
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
        This entry was posted <?php echo get_the_date(); ?>
      </div>
      <div class="travel-guide__social">
        <a href="#" class="travel-guide__social__link">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
          </svg>
        </a>
        <a href="#" class="travel-guide__social__link">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
          </svg>
        </a>
        <a href="#" class="travel-guide__social__link">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-twitter"></use>
          </svg>
        </a>
        <a href="#" class="travel-guide__social__link">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
          </svg>
        </a>
        <a href="#" class="travel-guide__social__link">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
          </svg>
        </a>

      </div>
    </div>
    <div class="travel-guide-related">
      <div class="travel-guide-related__title">
        You may also like
      </div>
      <div class="travel-guide-related__slider-area">
        <div class="travel-guide-related__slider-area__slider" id="related-slider">

          <?php
          if ($travelGuidePosts->have_posts()) :
            while ($travelGuidePosts->have_posts()) : $travelGuidePosts->the_post();
              $post_featured_image = get_field('featured_image');
          ?>
              <!-- Item -->
              <div class="travel-guide-related__slider-area__slider__item">
                <img src="<?php echo esc_url($post_featured_image['url']); ?>" alt="product" class="travel-guide-related__slider-area__slider__item__image">
                <div class="travel-guide-related__slider-area__slider__item__content">
                  <a class="travel-guide-related__slider-area__slider__item__content__title" href="<?php echo the_permalink(); ?>">
                    <?php echo the_title(); ?>
                  </a>
                  <div class="travel-guide-related__slider-area__slider__item__content__text">
                    <?php echo the_excerpt(); ?>
                  </div>
                  <div class="travel-guide-related__slider-area__slider__item__content__cta">
                    <a class="goto-button goto-button--small" href="<?php echo the_permalink(); ?>">
                      Read More
                      <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
          <?php
            endwhile;
            wp_reset_postdata(); //very important to rest after custom query
          endif;
          ?>
        </div>
      </div>

    </div>

    <?php
    get_template_part('template-parts/content', 'shared-newsletter');
    ?>
  </div>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>


<script>
  var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>