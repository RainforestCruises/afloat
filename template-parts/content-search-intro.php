   <?php $breadcrumb = get_field('breadcrumb'); ?>
   <!-- Intro -->
   <div class="search-intro">
       <ol class="search-intro__breadcrumb">
           <li>
               <a href="<?php echo home_url() ?>">Home</a>
           </li>
           <?php
            if ($breadcrumb) :
                foreach ($breadcrumb as $b) :
                    if ($b['link'] != null) : ?>
                       <li>
                           <a href=" <?php echo $b['link']  ?>"><?php echo $b['title'] ?></a>
                       </li>
                   <?php else : ?>
                       <li>
                           <?php echo $b['title'] ?>
                       </li>
           <?php endif;
                endforeach;
            endif; ?>

       </ol>
       <h1 class="search-intro__title">
           <span><?php echo get_field('title_text') ?></span>
           <svg>
               <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
           </svg>
       </h1>
       <div class="search-intro__text" style="display: block;">
           <?php
            $hasCustomText = get_field('intro_snippet_custom_text');

            if ($hasCustomText) {
                echo get_field('intro_snippet');
            } else {
                echo "<p>Looking for the best " . get_field('title_text') ."? Choose from the following expertly 
            crafted travel packages. These are just examples of what we can create for you – all 
            our tour packages are bespoke and hand-picked by our destination specialists. Operated 
            by only the most trusted of partners, these travel options have been carefully selected for their 
            authentic design, customer service excellence, and extraordinary itineraries.</p>";
            }

            ?>
       </div>
   </div>