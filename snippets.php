<?php if (have_rows('tour_experiences')) : ?>
                        <?php while (have_rows('tour_experiences')) : the_row(); 
                        $experience = get_sub_field('experience'); 
                        ?>
                            <li>       
                                <a href="#"><?php echo get_the_title($experience); ?></a>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>