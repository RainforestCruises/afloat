<?php
$introduction_title = get_field('introduction_title');
$introduction_text = get_field('introduction_text');

?>

<div class="bio-introduction">
    <div class="bio-introduction__content block-top-divider" style="padding-bottom: 8rem !important; padding-top: 6rem !important;">
        <!-- Top - Title/Nav -->
        <div class="bio-introduction__content__title">
            <?php echo $introduction_title; ?>

        </div>
        <!-- Slider Area -->
        <div class="bio-introduction__content__text">
            <?php echo $introduction_text; ?>
        </div>
    </div>
</div>