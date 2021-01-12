<?php
            if ($travelGuidePosts->have_posts()) :
                while ($travelGuidePosts->have_posts()) : $travelGuidePosts->the_post();
                    $featured_image = get_field('featured_image');
                    $guideCategories = get_field('categories');

                    $isoClasses = '';
                    if ($guideCategories) :
                        foreach ($guideCategories as $c) :
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        endforeach;
                    endif;

            ?>
                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image">
                            <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
                        </div>
                        <div class="guide-item__bottom">
         
                            <a class="guide-item__bottom__title" href="<?php echo the_permalink() ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                            <div class="guide-item__bottom__snippet">
                                <?php
                                echo the_excerpt();
                                ?>
                            </div>
                            <div class="guide-item__bottom__cta">
                                <a class="goto-button goto-button--dark" href="<?php echo the_permalink() ?>">
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