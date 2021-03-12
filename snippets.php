<div class="destination-main__intro__list-group">
            <div class="destination-main__intro__list-group__title">
                <?php echo ($destinationType == 'destination') ? 'Things to do' : 'Experiences' ?>
            </div>
            <ul class="destination-main__intro__list-group__list">

                <?php if ($destinationType == 'destination') {
                    if ($activities) :
                        foreach ($activities as $a) : ?>
                            <?php $activity = $a['activity'] ?>
                            <li>
                                <?php echo get_field('navigation_title', $activity); ?>
                            </li>
                    <?php endforeach;
                    endif; ?>
                    <?php } else if ($destinationType == 'region') {
                    if (have_rows('tour_experiences')) : ?>
                        <?php while (have_rows('tour_experiences')) : the_row();
                            $experience = get_sub_field('experience');
                        ?>
                            <li>
                                <?php echo get_the_title($experience); ?>
                            </li>
                        <?php endwhile; ?>
                <?php endif;
                } ?>
            </ul>
        </div>