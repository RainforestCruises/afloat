<?php
get_header();
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
?>
<?php
while (have_posts()) :
  the_post();


  $cruise_data = get_field('cruise_data');

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

  console_log($cruise_data);

  $args = array(
    'lowestPrice' => $cruise_data['LowestPrice'],
    'cruiseData' => $cruise_data,
    'propertyType' => 'Cruise',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
  );

?> 

  <!-- Product Page Container -->
  <div class="product-page">
    <?php
    get_template_part('template-parts/content', 'product-hero-nav');
    ?>
    <section class="product-content">

      <!-- 1. Overview Content -->
      <div class="product-content__page tab-content current" id="tab-overview">
        <?php
        get_template_part('template-parts/content', 'product-overview', $args);
        ?>
      </div>

      <!-- 2. Itineraries Content -->
      <div class="product-content__page tab-content " id="tab-itineraries">
        <?php
        get_template_part('template-parts/content', 'product-itineraries', $args);
        ?>
      </div>

      <!-- 3. Cabins Content -->
      <div class="product-content__page tab-content " id="tab-cabins">
        <?php
        get_template_part('template-parts/content', 'product-cabins', $args);
        ?>
      </div>

      <!-- 4. Prices Content -->
      <div class="product-content__page tab-content " id="tab-prices">
        <?php
        get_template_part('template-parts/content', 'product-prices', $args);
        ?>  
      </div>  
    
      <!-- 5. Dates Content --> 
      <div class="product-content__page tab-content " id="tab-dates">
        <?php
        get_template_part('template-parts/content', 'product-dates', $args);
        ?>
      </div>
    </section>

    <!-- Areas -->
    <div class="page-divider">
        Explore
    </div>
    <section class="product-areas">

      <div class="areas-slider">
        <div class="areas-slider__slider-nav" id="areas-slider__slider-nav">
          <?php
          $areaImages = get_field('areas_gallery');
          if ($areaImages) : ?>
            <?php foreach ($areaImages as $areaImage) : ?>
              <div class="areas-slider__slider-nav__item">
                <?php echo esc_html($areaImage['title']); ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="areas-slider__slider-for">
          <?php
          if ($areaImages) : ?>
            <?php foreach ($areaImages as $areaImage) : ?>
              <div class="areas-slider__slider-for__item" id="areas-slider__slider-for">
                <img src="<?php echo esc_html($areaImage['url']); ?>" alt="">
                <div class="areas-slider__slider-for__item__title"><?php echo esc_html($areaImage['title']); ?></div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

    </section>

    <!-- Reviews -->
    <div class="page-divider">
      Guest Reviews
    </div>
    <section class="product-reviews">
      <div class="reviews-slider" id="reviews-slider">
        <?php
        $rows = get_field('testimonials');
        if ($rows) {
          foreach ($rows as $row) {
            $guest_thumbnail = $row['guest_thumbnail'];
            $testimonial_image = $row['testimonial_image'];
        ?>
            <div class="reviews-slider__item">
              <div class="reviews-slider__item__content">
                <svg class="reviews-slider__item__content__quote">
                  <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                </svg>
                <p class="reviews-slider__item__content__text"><?php echo $row['guest_review']; ?></p>
                <h3 class="reviews-slider__item__content__date"><?php echo $row['review_date']; ?></h3>
                <div class="reviews-slider__item__content__profile">
                  <img src="<?php echo esc_html($guest_thumbnail['url']); ?>" alt="" class="reviews-slider__item__content__profile__img">
                  <div class="reviews-slider__item__content__profile__user">
                    <div class="reviews-slider__item__content__profile__name">
                      <?php echo $row['guest_name']; ?>
                    </div>
                    <div class="reviews-slider__item__content__profile__location">
                      <?php echo $row['guest_location']; ?>
                    </div>
                  </div>

                </div>
              </div>
              <img src="<?php echo esc_html($testimonial_image['url']); ?>" alt="" class="reviews-slider__item__image">
            </div>
        <?php
          }
        } ?>
      </div>
    </section>

    <!-- Related Travel -->
    <div class="page-divider">
      Related Cruises
    </div>
    <section class="product-related">
      <div class="related-slider" id="related-slider">
        <?php
        $args = array(
          'post_type' => 'rfc_cruises',
          'posts_per_page' => 8
        );
        $secondary = new WP_Query($args);
        if ($secondary->have_posts()) :
          while ($secondary->have_posts()) : $secondary->the_post();
            get_template_part('template-parts/content', 'related-cruises');
          endwhile;
          wp_reset_postdata(); //very important to rest after custom query
        endif;
        ?>
      </div>
    </section>
  </div>





  <script>
    var currentYear = '<?php echo $currentYear = date("Y"); ?>';
    var templateUrl = '<?php echo bloginfo('template_url') ?>';
  </script>

<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>