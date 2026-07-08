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
            $video = $member['video'];

        ?>


            <div class="expert-card">
                <div class="expert-card__content">

                    <a class="expert-card__content__avatar" href="<?php echo $bioPage ?>">
                        <div class="expert-card__content__avatar__image-area">
                            <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                        </div>
                        <div class="expert-card__content__avatar__title-group">
                            <h3 class="expert-card__content__avatar__title-group__name">
                                <?php echo $name; ?>
                            </h3>
                            <p class="expert-card__content__avatar__title-group__position">
                                <?php echo $position; ?>
                            </p>
                        </div>
                    </a>
                    <div class="expert-card__content__copy">
                        <?php echo $description; ?>
                    </div>
                </div>

                <div class="expert-card__video">
                    <div style="padding:177.78% 0 0 0;position:relative;"><iframe src="<?php echo esc_url($video); ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" referrerpolicy="strict-origin-when-cross-origin" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Meet Juan Pablo"></iframe></div>
                </div>
            </div>

        <?php
        endforeach;
        ?>
    </div>


</div>
<script src="https://player.vimeo.com/api/player.js"></script>