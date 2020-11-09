   <?php

    $posts = get_posts(array(
        'post_type' => 'rfc_cruises',
        'posts_per_page' => 25
    ));

    $count = 0;
    ?>

   <?php foreach ($posts as $post) {
        $featured_image = get_field('featured_image');
        $cruise_data = get_field('cruise_data');
        

    ?>
       <!-- Result -->
       <div class="search-result search-result--highlight">
           <div class="search-result__image">
               <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
           </div>
           <div class="search-result__content">
               <div class="search-result__content__tag">
                   <div class="badge-solid badge-solid--small">
                       Popular
                   </div>
               </div>
               <div class="search-result__content__length">
                   <?php echo $cruise_data['LowestLengthInDays']; ?>-<?php echo $cruise_data['HighestLengthInDays']; ?> Day Cruise
               </div>
               <div class="search-result__content__title">
                   <?php echo get_the_title() ?>
               </div>
               <div class="search-result__content__description">
               <?php echo get_field('top_snippet') ?>
               </div>
               <div class="search-result__content__info">
                   <div class="search-result__content__info__price">
                       <div class="search-result__content__info__price__starting">
                           Starting from
                       </div>
                       <div class="search-result__content__info__price__amount">
                       <?php echo "$" . number_format($cruise_data['LowestPrice'], 0);  ?>
                       </div>
                       <div class="search-result__content__info__price__currency">
                           USD
                       </div>
                   </div>
                   <div class="search-result__content__info__icons">
                       Icons
                   </div>
               </div>
           </div>
       </div>

   <?php } ?>