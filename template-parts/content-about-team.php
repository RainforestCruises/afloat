<?php

$team = get_field('team');
$headerText = get_field('team_header');

?>

<div class="about-team">
    <h2 class="about-team__title">
        <?php echo $headerText ?>
    </h2>
    <div class="about-team__grid">

        <?php
        if ($team) :
            foreach ($team as $member) :
                $hasPhone = $member['phone_display'] == "" ? false : true;
        ?>


                <div class="team-card">
                    <div class="team-card__image-area">
                        <?php $image =  $member['image'] ?>
                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>

                    </div>
                    <div class="team-card__content">
                        <h3 class="team-card__content__name">
                            <?php echo $member['name'] ?>
                        </h3>
                        <div class="team-card__content__position">
                            <?php echo $member['position'] ?>
                        </div>
                        <?php if ($hasPhone) : ?>
                            <a class="team-card__content__phone" href="tel:<?php echo $member['phone_number']; ?>">
                                <?php echo $member['phone_display']; ?>
                            </a>
                        <?php endif ?>
                    </div>
                </div>

        <?php
            endforeach;
        endif;

        ?>
    </div>
</div>