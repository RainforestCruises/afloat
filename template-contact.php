<?php
/*Template Name: Contact*/


wp_enqueue_script('page-contact', get_template_directory_uri() . '/js/page-contact.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-contact',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);

get_header();
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$top_level_agents_page = get_field('top_level_agents_page', 'options');
$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');
?>

<!-- Contact -->
<section class="contact-page">

    <!-- Intro -->
    <div class="contact-page__intro">
        <h1 class="contact-page__intro__title">
            Plan Your Adventure Today.
        </h1>
        <div class="contact-page__intro__subtitle">
            Call us on the number below to speak to one of our destination specialists, or alternatively please fill in the form beneath and we'll get back to you ASAP.
        </div>
        <div class="contact-page__intro__subtitle" style="margin-top: 1rem;">
            If you are a travel agent, please use the form <a href="<?php echo $top_level_agents_page . '#contact-form' ?>">here</a>.
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
                    Speak with our specialists for free on
                </div>
                <div class="contact__wrapper__intro__phone">
                <a href="tel:<?php echo $phone_number_numeric; ?>">
                        <?php echo $phone_number; ?>
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="contact__wrapper__form">
                <?php

                //Check if WpForms is active
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

</section>


<!-- Testimonials -->
<div class="destination-testimonials">
    <h2 class="contact-page__testimonial-title">
        What Our Customers are Saying About Us
    </h2>
    <div class="destination-testimonials__slider" id="testimonials-slider">
        <?php
        $testimonials = get_field('testimonials', 'options');

        if ($testimonials) :
            foreach ($testimonials as $testimonial) :
                $t = $testimonial['snippet'];
                $t_person = $testimonial['person_name'];
                $t_image = $testimonial['image'];
        ?>
                <!-- Slide -->
                <!-- Testimonial -->
                <div class="destination-testimonial">
                    <div class="destination-testimonial__content">
                        <div class="destination-testimonial__content__snippet">
                            <?php echo $t ?>
                        </div>
                        <div class="destination-testimonial__content__person">
                            - <?php echo $t_person ?>
                        </div>
                    </div>

                    <div class="destination-testimonial__image-area ">
                        <img <?php afloat_image_markup($t_image['id'], 'vertical-medium'); ?>>
                    </div>
                </div>

        <?php
            endforeach;

        endif; ?>
    </div>
</div>


<?php get_footer(); ?>