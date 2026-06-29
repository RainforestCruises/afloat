<?php

$team = get_field('team');

?>

<div class="about-team" style="margin-bottom: 0rem;">
    <h2 class="destination-main__packages__header__title page-divider" style="margin-bottom: 4rem;">
        Our Experts
    </h2>
    <div class="expert-grid">

        <?php
        foreach ($team as $member) :
            $bioPage = $member['bio_page_link'];
            $name =  $member['name'];
            $position =  $member['position'];
            $description =  $member['description'];
            $image =  $member['image'];
        ?>


            <div class="expert-card">
                <a class="expert-card__avatar" href="<?php echo $bioPage ?>">
                    <div class="expert-card__avatar__image-area">
                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                    </div>
                    <div class="expert-card__avatar__title-group">
                        <h3 class="expert-card__avatar__title-group__name">
                            <?php echo $name; ?>
                        </h3>
                        <p class="expert-card__avatar__title-group__position">
                            <?php echo $position; ?>
                        </p>
                    </div>
                </a>
                <div class="expert-card__content">
                    <?php echo $description; ?>
                </div>
            </div>

        <?php
        endforeach;
        ?>
    </div>


</div>