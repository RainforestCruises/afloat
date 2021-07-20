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
                        <div class="guide-item__image-area">
                            <img <?php afloat_responsive_image($featured_image['ID'], 'featured-medium', array('featured-small', 'featured-medium')); ?> alt="">
                        </div>
                        <div class="guide-item__bottom">
                            <ul class="guide-item__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            $catTitle = get_the_title($c);
                                            echo trim($catTitle);
                                            ?>
                                        </li>
                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <a class="guide-item__bottom__title" href="<?php echo the_permalink() ?>">
                                <?php echo get_field('navigation_title'); ?>
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