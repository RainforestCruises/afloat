<?php
$press_newsletter_form_id = get_field('press_newsletter_form_id');
$newsletter_title = get_field('newsletter_title');
$newsletter_snippet = get_field('newsletter_snippet');
$newsletter_image = get_field('newsletter_image');

?>

<section class="about-newsletter">
    <h2 class="destination-main__packages__header__title page-divider" style="margin-bottom: 4rem; margin-top: 4rem;">
        Reach Out
    </h2>
    <div class="about-newsletter__content">
        <div class="about-newsletter__content__copy">
            <h2 class="about-newsletter__content__copy__title">
                <?php echo $newsletter_title; ?>
            </h2>
            <div class="about-newsletter__content__copy__text">
                <?php echo $newsletter_snippet; ?>
            </div>
            <div class="about-newsletter__content__copy__email">
                <button class="about-newsletter__content__copy__email__button" id="newsletterButton">
                    Enter your email
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="about-newsletter__content__image">
            <img <?php afloat_image_markup($newsletter_image['id'], 'vertical-medium'); ?>>
        </div>
    </div>

</section>


<!-- Newsletter Modal -->

<div class="popup" id="newsletterModal">
    <div class="contact">
        <div class="contact__wrapper">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>
            <div class="contact__wrapper__intro">
                <div class="contact__wrapper__intro__title">
                    Join Our Newsletter
                </div>

                <div class="contact__wrapper__intro__introtext">
                    Please fill in the form beneath and you’ll be added to our newsletter.
                </div>
            </div>

            <div class="contact__wrapper__form">
                <?php
                if (is_plugin_active('wpforms/wpforms.php')) {
                    wpforms_display($press_newsletter_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->