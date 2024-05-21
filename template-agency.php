<?php
/*Template Name: Agency*/
get_header();

$agency_contact_form_id = get_field('agency_contact_form_id', 'options');

?>


<main class="agency-page">

    <!-- Content -->
    <section class="agency-page__section-hero">
        <?php
        get_template_part('template-parts/agency/content', 'agency-hero');
        ?>
    </section>

    <section class="agency-page__section-partners">
        <?php
        get_template_part('template-parts/agency/content', 'agency-partners');
        ?>
    </section>

    <div class="svg-divider">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
        </svg>
    </div>


    <!-- Newsletter -->

    <!-- Contact -->
    <section class="contact-page" style="padding-top: 4rem;" id="contact-form">

        <!-- Intro -->
        <div class="contact-page__intro">
            <div class="contact-page__intro__subtitle">
                To speak to us about becoming travel industry partners give us a call, or alternatively please fill in the form beneath and we'll get back to you ASAP.
            </div>
        </div>

        <!-- Contact Form / Wrapper -->
        <div class="contact u-margin-bottom-big">
            <div class="contact__wrapper">
                <div class="contact__wrapper__intro">

                    <div class="contact__wrapper__intro__icon">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-headset"></use>
                        </svg>
                    </div>
                    <h2 class="contact__wrapper__intro__title">
                        Give us a Call
                    </h2>
                    <div class="contact__wrapper__intro__subtitle">
                        Our office hours are 9am - 5pm (UTC - 5), Monday - Friday
                    </div>
                    <div class="contact__wrapper__intro__phone">
                        +1 888-215-3555
                    </div>
                </div>

                <!-- Form -->
                <div class="contact__wrapper__form">
                    <?php

                    //Check if WpForms is active
                    if (is_plugin_active('wpforms/wpforms.php')) {
                        wpforms_display($agency_contact_form_id);
                    } else {
                        echo 'Forms Plugin Missing';
                    }
                    ?>
                </div>

                <!-- Outro -->
                <div class="contact__wrapper__outro">
                    You can also send us a message directly at <a href="mailto:b2b@rainforestcruises.com">b2b@rainforestcruises.com</a>
                </div>
            </div>
        </div>

    </section>

</main>


<?php get_footer(); ?>