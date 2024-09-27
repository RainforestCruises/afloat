<!-- Contact Modal -->
<?php
$isProduct = false;
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$top_level_agents_page = get_field('top_level_agents_page', 'options');
$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');
if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_lodges' || get_post_type() == 'rfc_tours') {
    $isProduct = true;
}
?>
<div class="popup" id="contactModal">
    <div class="contact">
        <div class="contact__wrapper">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>
            <div class="contact__wrapper__intro">
                <div class="contact__wrapper__intro__title">
                    Interested in <?php echo $isProduct ? "the " : "" ?> <?php echo (get_post_type() == 'rfc_tours') ? get_field("tour_name") .  " Tour" :  get_the_title(); ?>?
                </div>
                <div class="contact__wrapper__intro__departure" id="contactModalDepartureText"></div>

                

                <div class="contact__wrapper__intro__introtext">
                    Please fill in the form beneath and we’ll get back to you ASAP.
                </div>


                <div class="contact__wrapper__intro__icon" style="margin-top: 1rem;">>
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-headset"></use>
                    </svg>
                </div>
                <h2 class="contact__wrapper__intro__title">
                    Give us a Call
                </h2>
                <div class="contact__wrapper__intro__subtitle">
                    Speak with our specialists for free on
                </div>
                <div class="contact__wrapper__intro__phone">
                <a href="tel:<?php echo $phone_number_numeric; ?>">
                        <?php echo $phone_number; ?>
                    </a>
                </div>


                <div class="contact__wrapper__intro__introtext" style="margin-top: 1rem;">
                    If you are a travel agent, please use the form <a href="<?php echo $top_level_agents_page . '#contact-form' ?>">here</a>.
                </div>
                
            </div>

            <div class="contact__wrapper__form">
                <?php


                if (is_plugin_active('wpforms/wpforms.php')) {
                    wpforms_display($primary_contact_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }

                ?>
            </div>
            <!-- Outro -->
            <div class="contact__wrapper__outro">
                You can also send us a message directly at <a href="mailto:cruise@rainforestcruises.com">cruise@rainforestcruises.com</a>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->