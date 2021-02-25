

<section class="newsletter">
    <div class="newsletter__content">
        <div class="newsletter__content__title">
            <?php echo get_field('newsletter_title', 'options'); ?>
        </div>
        <div class="newsletter__content__text">
            <?php echo get_field('newsletter_snippet', 'options'); ?>
        </div>
        <div class="newsletter__content__email">
            <input type="text" placeholder="Enter your email" class="newsletter__content__email__input">
            <button class="newsletter__content__email__button">Submit</button>
        </div>
    </div>
    <div class="newsletter__image">
        <?php $newsletter_image = get_field('newsletter_image', 'options'); ?>
        <img src="<?php echo esc_url($newsletter_image['url']); ?>" alt="">
    </div>
</section>