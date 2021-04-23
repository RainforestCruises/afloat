<?php
/*Template Name: Contact*/
?>

<?php
get_header();
?>

<!-- Product Page Container -->
<div class="contact-page">
    <div class="contact-page__intro">
        <div class="contact-page__intro__category">
            Contact
        </div>
        <div class="contact-page__intro__title">
            Plan Your Adventure Today.
        </div>
        <div class="contact-page__intro__subtitle">
            Call us on the number below to speak to one of our destination specialists, or alternatively please fill in the form beneath and we'll get back to you ASAP.
        </div>
    </div>
    <div class="contact u-margin-bottom-big">
        <div class="contact__wrapper">
            <div class="contact__wrapper__intro">

                <div class="contact__wrapper__intro__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-headset"></use>
                    </svg>
                </div>
                <div class="contact__wrapper__intro__title">
                    Give us a Call
                </div>
                <div class="contact__wrapper__intro__subtitle">
                    Speak with our trip specialists to book your next experience.
                </div>
                <div class="contact__wrapper__intro__phone">
                    +1 888-215-3555
                </div>
            </div>

            <div class="contact__wrapper__form">
                <?php                
                wpforms_display(1629);?>
            </div>
        </div>
    </div>

</div>



<?php get_footer(); ?>