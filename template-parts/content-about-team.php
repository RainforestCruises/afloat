<?php

$team = get_field('team');
?>

<div class="about-team">
    <div class="about-team__title">
        Meet Our Team
    </div>
    <div class="about-team__grid">

        <?php
        if ($team) :
            foreach ($team as $member) :

        ?>


                <div class="team-card">
                    <div class="team-card__image-area">
                        <?php $image =  $member['image'] ?>
                        <img <?php afloat_responsive_image($image['id'], 'square-small', array('square-small')); ?> alt="">

                    </div>
                    <div class="team-card__content">
                        <div class="team-card__content__name">
                            <?php echo $member['name'] ?>
                        </div>
                        <div class="team-card__content__position">
                            <?php echo $member['position'] ?>
                        </div>
                    </div>
                </div>

        <?php
            endforeach;
        endif;

        ?>
    </div>
</div>