<?php

$menu_name = 'footer_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);


$menuitems = wp_get_nav_menu_items($menu->term_id);


$menu_group = [];


?>




<!-- Shared Prefooter Section -->


<?php
if (get_page_template_slug() != 'template-home.php') {
    get_template_part('template-parts/shared/content', 'shared-publications');
};

?>

<!-- Footer -->
<footer class="footer">
    <div class="footer__first">
        <div class="footer__first__compass">
            <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 118.02 133.41">
                <path class="cls-1" d="M111.32,39.27c-.09-.18-9.67-17.83-14.99-17.83-.22,0-.43.03-.64.08l-.21.06-.17.14c-1.24.8-1.53,2.23-2.95,2.89-.38.67-.2,1.53.2,2.18s1.01,1.14,1.57,1.67c1.64,1.54,3.12,3.43,4.48,5.22,1.57,2.06,3.06,4,3.57,4.9,10.72,18.6,12.5,45.54-4.38,61.93-.75-1.59-2.32-2.93-3.75-4.16-1.22-1.04-2.48-2.13-2.7-2.95-.19-.71.12-4.08.37-6.79.33-3.54.7-7.56.5-9.8-2.77-31.03-39.87-46.83-65.81-48.32,9.76-8.44,22.43-13.29,35.93-13.29.77,0,1.55.03,2.32.06,0,0-1.76,6.7-1.76,6.7-1.06,4.02,3.56,2.97,5.45,2.25,1.09-.41,2.18-.83,3.3-1.12,1.05-.27,2.13-.44,3.18-.72,3.44-.95,6.76-1.41,10.19-2.27.83-.21,1.47-.82,1.72-1.64s.05-1.68-.52-2.31c-.87-.96-1.73-1.93-2.61-2.88-1.91-2.09-3.6-4.32-5.56-6.37-.92-.97-2.18-1.54-3.01-2.54-.95-1.15-1.71-2.45-2.72-3.56-.46-.51-1.09-.79-1.78-.79-1.1,0-2.05.74-2.33,1.79l-1.68,6.39c-1.66-.13-3.33-.21-4.97-.21-12.93,0-25.28,4.05-35.72,11.72-9.68,7.11-17.41,17.25-21.76,28.53C-.06,59-1.08,70.38,1.16,81.14c2.55,12.29,9.77,24.75,19.65,32.47l3.34-4.14s-5.27-8.09-6.35-9.67c-11.72-17.22-13.14-38.05-3.79-55.74,1.94-3.67,4.28-7.05,6.93-10.12-.4,8.57.5,31.35,12.73,47.87,8.91,12.04,21.9,18.15,38.6,18.15,4.14,0,8.57-.38,13.16-1.14l7.26,6.98c-10.18,7.87-23.18,12.54-35.02,12.54-1.47,0-2.92-.08-4.34-.22l1.43-6.93c.15-.71-.03-1.44-.49-2-.46-.57-1.14-.89-1.87-.89-.28,0-.56.05-.83.15-2.63.73-5.18,1.39-7.77,2.28-2.97,1.02-6.29,2.25-9.4,2.66-1.48.2-3.1.33-3.39,2.17-.13.83.16,1.65.79,2.2,2.24,1.95,4.34,4,6.62,5.93,3.12,2.62,5.29,6.16,8.19,9.1l.03.04.04.03c.43.36.98.56,1.53.56,1.14,0,2.13-.81,2.36-1.92l1.21-5.88c1,.03,1.99.05,2.96.05,17.85,0,32.29-4.91,44.15-15.01,9.97-8.49,16.34-20.04,18.41-33.39,1.95-12.6-.18-26.09-5.99-37.99ZM72.15,94.02c-37.19,0-43.04-36.46-43.84-51.87,4.99,5.77,17.37,17.87,29.41,29.64,8.92,8.72,18.87,18.45,21.77,21.8-2.53.29-4.99.44-7.34.44ZM85.33,88.08l-.65.16c-.78-.99-2.66-3.08-7.22-7.91-4.6-4.87-10.73-11.24-16.83-17.48-4.97-5.09-19.82-20.21-25.93-25.56,26.26,4.18,53.72,19.59,50.62,50.8Z" />
            </svg>
        </div>
        <div class="footer__first__social">
            <a href="<?php echo get_field('facebook_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('instagram_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('twitter_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('pinterest_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('youtube_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('linked_in_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-linkedin"></use>
                </svg>
            </a>

        </div>
    </div>
    <div class="footer__tagline">
        Where can we take you today?
    </div>
    <div class="footer__explore">
        <div class="footer__explore__cta">
            <a href="<?php echo get_home_url() . '/contact'; ?>" class="footer__explore__cta__button">
                Send a Message
            </a>

        </div>
        <div class="footer__explore__phone">
            <?php echo get_field('phone_number', 'options'); ?>
        </div>
    </div>
    <div class="footer__navigation">
        <?php foreach ($menuitems as $m) :

            if ($m->menu_item_parent == 0) : ?>
                <!-- Group -->
                <div class="footer__navigation__group">
                    <div class="footer__navigation__group__title"><?php echo $m->post_title; ?></div>
                    <nav class="footer__navigation__group__nav">
                        <ul class="footer__navigation__group__nav__list">
                            <?php foreach ($menuitems as $mm) :
                                if ($mm->menu_item_parent == $m->ID) :
                            ?>
                                    <li class="footer__navigation__group__nav__list__item">
                                        <a href="<?php echo $mm->url; ?>"><?php echo $mm->title; ?></a>
                                    </li>
                            <?php else :
                                    continue;
                                endif;
                            endforeach; ?>
                        </ul>
                    </nav>
                </div>
        <?php
            else :
                continue;
            endif;
        endforeach; ?>
    </div>
    <div class="footer__logo">
        <?php $logo_vertical = get_field('logo_vertical', 'options'); ?>
        <img src="<?php echo $logo_vertical['url']; ?>" alt="<?php echo get_bloginfo('name') ?>" />
    </div>
    <div class="footer__copyright">
        &#169; <?php echo date('Y') ?> Rainforest Cruises. All rights reserved.
        <div><small>Licensed Florida Seller Of Travel #ST38603</small></div>
        <div><small>IATAN Accredited Agency #10716451</small></div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>


</html>