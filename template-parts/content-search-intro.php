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
       <div class="search-intro__title">
           <span><?php echo get_field('title_text') ?></span>
           <svg>
               <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
           </svg>
       </div>
       <div class="search-intro__text" style="display: block;">
           <?php echo get_field('intro_snippet') ?>
       </div>
   </div>