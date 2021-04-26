<!-- Contact Modal -->
<div class="popup">
    <div class="contact">
        <div class="contact__wrapper">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>
            <div class="contact__wrapper__intro">
                <div class="contact__wrapper__intro__title">
                    Interested in  <?php echo get_the_title(); ?>?
                </div>
                <div class="contact__wrapper__intro__introtext">
                    Please fill in the form beneath and we’ll get back to you ASAP.
                </div>
            </div>

            <div class="contact__wrapper__form">
                <?php
                wpforms_display(1629); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->