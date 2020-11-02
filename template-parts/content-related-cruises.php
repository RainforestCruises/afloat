<?php 
    $featured_image = get_field('featured_image'); 
    $cruise_data = get_field('cruise_data');
    $countries = get_field('country');

    $top_snippet = get_field('top_snippet');

    $lowest = $cruise_data['LowestLengthInDays'];
    $highest = $cruise_data['HighestLengthInDays'];
    $lowestPrice = $cruise_data['LowestPrice'];

    
?>

<div class="related-slider__item">
        <div class="related-slider__item__title-group">
          <div class="related-slider__item__title-group__name">
          <?php echo get_the_title() ?>
          </div>
          <div class="related-slider__item__title-group__country">
          <?php 
          $count = 0;
          if($countries) {          
            foreach ($countries as $country) {
                $title = get_the_title($country->ID );
                if ($count != 0){
                    echo " / " . $title;
                } else {
                    echo $title;
                }              
                $count++;
            } 
          }
          ?>
          </div>
        </div>
        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="product" class="related-slider__item__img">
        <div class="related-slider__item__bottom">
          <div class="related-slider__item__bottom__header">
            River Cruise
          </div>
          <div class="related-slider__item__bottom__description">
            <?php echo $top_snippet; ?>
          </div>
          <div class="related-slider__item__bottom__last-section">
            <div class="related-slider__item__bottom__length">
              <span class="related-slider__item__bottom__length__numbers"><?php echo $lowest;?>-<?php echo $highest; ?></span>
              <span class="related-slider__item__bottom__length__text">Days</span>
            </div>
            <div class="related-slider__item__bottom__price">
              <div class="related-slider__item__bottom__price__text">
                From
              </div>
              <div class="related-slider__item__bottom__price__numbers">
              <?php echo "$" . number_format($lowestPrice, 0);  ?>
              </div>
            </div>
          </div>

        </div>
      </div>