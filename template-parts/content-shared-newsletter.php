<section class="newsletter">
    <div class="newsletter__content">
        <h3 class="newsletter__content__title">
            <?php echo get_field('newsletter_title', 'options'); ?>
        </h3>
        <div class="newsletter__content__text">
            <?php echo get_field('newsletter_snippet', 'options'); ?>
        </div>
        <div class="newsletter__content__email">
            <button class="newsletter__content__email__button" id="newsletterButton">
                Enter your email
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </button>
        </div>
    </div>
    <div class="newsletter__image">
        <?php $newsletter_image = get_field('newsletter_image', 'options'); ?>
        <img <?php afloat_responsive_image($newsletter_image['id'], 'vertical-medium', array('vertical-medium')); ?>>

    </div>
</section>


<!-- Newsletter Modal -->
<?php 
$newsletter_form_id = get_field('newsletter_form_id', 'options');
?>
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
                <?php wpforms_display($newsletter_form_id); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->