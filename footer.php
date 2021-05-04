<?php

$menu_name = 'footer_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);


$menuitems = wp_get_nav_menu_items($menu->term_id);


$menu_group = [];


console_log($menuitems);

if ($m->menu_item_parent == 0) {

    $parentId = $m->ID;

    
}

?>






<!-- Footer -->
<footer class="footer">
    <div class="footer__first">
        <div class="footer__first__compass">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-04"></use>
            </svg>
        </div>
        <div class="footer__first__social">
            <a href="" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
                </svg>
            </a>
            <a href="" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
                </svg>
            </a>
            <a href="" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-twitter"></use>
                </svg>
            </a>
            <a href="" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
                </svg>
            </a>
            <a href="" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
                </svg>
            </a>
        </div>
    </div>
    <div class="footer__tagline">
        Where can we take you today?
    </div>
    <div class="footer__explore">
        <button class="footer__explore__button">
            Explore Destinations
        </button>
        <div class="footer__explore__phone">
            +1.888.215.3555
        </div>
    </div>
    <div class="footer__navigation">
        <!-- Group -->
        <div class="footer__navigation__group">
            <div class="footer__navigation__group__title">Company</div>
            <nav class="footer__navigation__group__nav">
                <ul class="footer__navigation__group__nav__list">
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">About Rainforest Cruises</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Blog</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Press</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Terms & Conditions</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Contact Information</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Group -->
        <div class="footer__navigation__group">
            <div class="footer__navigation__group__title">Destinations</div>
            <nav class="footer__navigation__group__nav">
                <ul class="footer__navigation__group__nav__list">
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Amazon River</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Galapagos</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Peru</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Brazil</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Vietnam</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Indonesia</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Cambodia</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Group -->
        <div class="footer__navigation__group">
            <div class="footer__navigation__group__title">Experiences</div>
            <nav class="footer__navigation__group__nav">
                <ul class="footer__navigation__group__nav__list">
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Luxury</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Family</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Cultural</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Adventure</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Best Selling</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Group -->
        <div class="footer__navigation__group">
            <div class="footer__navigation__group__title">Find Us</div>
            <nav class="footer__navigation__group__nav">
                <ul class="footer__navigation__group__nav__list">
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Facebook</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Instagram</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Twitter</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Pinterest</a>
                    </li>
                    <li class="footer__navigation__group__nav__list__item">
                        <a href="#">Youtube</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="footer__logo">
        <img src="<?php echo bloginfo('template_url') ?>/css/img/logo/logo-vertical-white.png" alt="logo" />
    </div>
    <div class="footer__copyright">
        &#169; 2021 Rainforest Cruises. All rights reserved.
    </div>
</footer>
<?php wp_footer(); ?>
</body>


</html>