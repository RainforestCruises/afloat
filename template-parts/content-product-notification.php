<?php
$notification_title = get_field('notification_title');
$notification_message = get_field('notification_message');

$notification_title = $notification_title == "" ? "Notice" : $notification_title;
?>




<div class="popup active" id="notification-modal">
    <div class="contact">
        <div class="contact__wrapper" style="padding-top: 2rem">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>

            <div class="contact__wrapper__header">
                <?php echo $notification_title; ?>
            </div>
            <div class="contact__wrapper__message">
                <?php echo $notification_message; ?>
            </div>

            <div class="contact__wrapper__cta">
                <button class="btn-cta-round btn-cta-round--medium" id="notification-close-cta">
                Close Notification
                </button>
                
            </div>
        </div>

    </div>

</div>