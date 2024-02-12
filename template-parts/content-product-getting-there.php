<?php

$getting_there = get_field('getting_there');

?>

<div class="popup" id="getting-there-modal">
    <div class="contact">
        <div class="contact__wrapper" style="padding-top: 2rem">
            <button class="contact__wrapper__close-button close-button" tabindex="0"></button>
            <div class="contact__wrapper__header">
                How to Get There
            </div>
            <div class="contact__wrapper__message">
                <?php echo $getting_there; ?>
            </div>
        </div>
    </div>
</div>