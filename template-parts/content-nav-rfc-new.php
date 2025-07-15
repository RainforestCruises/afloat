<?php
$menu_name = 'main_menu';
$locations = get_nav_menu_locations();
// $menu = wp_get_nav_menu_object($locations[$menu_name]);
// $menuitems = wp_get_nav_menu_items($menu->term_id);
$show_translate_nav = get_field('show_translate_nav', 'options');
$top_level_agents_page = get_field('top_level_agents_page', 'options');

$nav_cruises = get_field('cruises', 'options');
$nav_packages = get_field('packages', 'options');
$nav_experiences = get_field('experiences', 'options');

$top_level_deals_page = get_field('top_level_deals_page', 'options');
$top_level_guides_page = get_field('top_level_guides_page', 'options');
$top_level_about_page = get_field('top_level_about_page', 'options');
$top_level_cruises_page = get_field('top_level_cruises_page', 'options');
$top_level_packages_page = get_field('top_level_packages_page', 'options');

$alwaysActiveHeader = checkActiveHeader(); //return true/false depending on if current template header bar should never be transparent

console_log($nav_cruises);
?>


<!-- Mobile Menu -->
<nav class="nav-mobile">

    <!-- Burger Button -->
    <div class="burger-button close" id="burger-menu-close">
        <span class="burger-button__bar "></span>
    </div>

    <!-- Top level Menu -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">
        <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="mobile-nav-cruises">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
            <span>
                Cruises
            </span>
        </a>

        <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="mobile-nav-packages">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
            <span>
                Packages
            </span>
        </a>

        <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="mobile-nav-experiences">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
            <span>
                Experiences
            </span>
        </a>

        <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $top_level_deals_page ?>">Deals</a>
        <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $top_level_guides_page ?>">Guide</a>
        <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $top_level_about_page ?>">About</a>
        <a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_field('top_level_search_page', 'option'); ?>">Search</a>
        <a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_home_url(); ?>/contact">Contact</a>
        <a class="nav-mobile__content-panel__button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>"><?php echo get_field('phone_number', 'options'); ?></a>
        <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $top_level_agents_page; ?>">Agents</a>

        <!-- Language Switch -->
        <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
            <div class="mobile-language-switch">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
                </svg>
                <span class="mobile-language-switch__trp">
                    <?php echo do_shortcode("[language-switcher]"); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>


    <!-- Level 2 -->
    <!-- Cruises -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="mobile-nav-cruises">
        <a class="nav-mobile__content-panel__button back-link" menuLinkTo="top">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
            </svg>
            <span>
                Back
            </span>
        </a>
        <?php foreach ($nav_cruises as $nav_cruise) :
            $region = $nav_cruise['region']; // page
            $region_display = $nav_cruise['region_display'];
        ?>
            <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo slugify($region_display) ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
                <span>
                    <?php echo $region_display ?>
                </span>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Packages -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="mobile-nav-packages">
        <a class="nav-mobile__content-panel__button back-link" menuLinkTo="top">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
            </svg>
            <span>
                Back
            </span>
        </a>
        <?php foreach ($nav_packages as $nav_package) :
            $category = $nav_package['category']; // page
            $category_display = $nav_package['category_display'];
        ?>
            <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo slugify($category_display) . '-category' ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
                <span>
                    <?php echo $category_display ?>
                </span>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Experiences -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="mobile-nav-experiences">
        <a class="nav-mobile__content-panel__button back-link" menuLinkTo="top">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
            </svg>
            <span>
                Back
            </span>
        </a>
        <?php foreach ($nav_experiences as $nav_experience) :
            $experience = $nav_experience['experience']; // page
            $experience_display = $nav_experience['experience_display'];
        ?>
            <a href="<?php echo $experience ?>" class="nav-mobile__content-panel__button mobile-link">
                <?php echo $experience_display ?>
            </a>
        <?php endforeach; ?>
    </div>
    <!-- End Level 2 -->


    <!-- Level 3 -->
    <!-- Cruises -->
    <?php foreach ($nav_cruises as $nav_cruise) :
        $region = $nav_cruise['region']; // page
        $region_display = $nav_cruise['region_display'];
        $nav_destinations = $nav_cruise['destinations'];
    ?>
        <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuId="<?php echo slugify($region_display) ?>">
            <a class="nav-mobile__content-panel__button back-link" menuLinkTo="mobile-nav-cruises">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <span>
                    Back
                </span>
            </a>
            <?php foreach ($nav_destinations as $nav_destination) :
                $destination = $nav_destination['destination']; // page
                $destination_display = $nav_destination['destination_display'];
                $is_sub = $nav_destination['is_sub'];
            ?>
                <a href="<?php echo $destination ?>" class="nav-mobile__content-panel__button mobile-link"><?php echo $destination_display ?> <?php echo $is_sub ? " - " : "" ?></a>
            <?php endforeach; ?>
            <a href="<?php echo $region ?>" class="nav-mobile__content-panel__button mobile-link divider">View All</a>
        </div>
    <?php endforeach; ?>

    <!-- Packages -->
    <?php foreach ($nav_packages as $nav_package) :
        $package = $nav_package['category']; // page
        $package_display = $nav_package['category_display'];
        $package_items = $nav_package['category_items'];
    ?>
        <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuId="<?php echo slugify($package_display) . '-category' ?>">
            <a class="nav-mobile__content-panel__button back-link" menuLinkTo="mobile-nav-packages">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <span>
                    Back
                </span>
            </a>
            <?php foreach ($package_items as $package_item) :
                $item = $package_item['item']; // page
                $item_display = $package_item['item_display'];
            ?>
                <a href="<?php echo $item ?>" class="nav-mobile__content-panel__button mobile-link"><?php echo $item_display ?></a>
            <?php endforeach; ?>
            <a href="<?php echo $package ?>" class="nav-mobile__content-panel__button mobile-link divider">View All</a>
        </div>
    <?php endforeach; ?>





</nav>
<!-- End Mobile Menu -->

<!-- Desktop Header -->
<!-- Header -->
<header class="header " id="header">

    <!-- Top Level Nav -->
    <div class="header__main <?php echo ($alwaysActiveHeader == true) ? 'active' : ''; ?>">
        <!-- Logo -->
        <div class="header__main__logo-area">
            <a href="<?php echo get_home_url(); ?>" class="header__main__logo-area__logo">
                <?php
                $logo = get_theme_mod('custom_logo');
                $image = wp_get_attachment_image_src($logo, 'full');
                $image_url = $image[0];
                ?>
                <img src="<?php echo $image_url ?>" alt="<?php echo get_bloginfo('name') ?>" />
            </a>
        </div>
        <!-- Main Nav -->
        <nav class="header__main__nav">
            <div class="header__main__nav__list">
                <li class="header__main__nav__list__item">
                    <span class="header__main__nav__list__item__link mega" navelement="cruises">Cruises</a>
                </li>
                <li class="header__main__nav__list__item">
                    <span class="header__main__nav__list__item__link mega" navelement="packages">Packages</a>
                </li>
                <li class="header__main__nav__list__item">
                    <span class="header__main__nav__list__item__link mega" navelement="experiences">Experiences</a>
                </li>
                <li class="header__main__nav__list__item">
                    <a class="header__main__nav__list__item__link no-mega" href="<?php echo $top_level_deals_page ?>">Deals</a>
                </li>
                <li class="header__main__nav__list__item">
                    <a class="header__main__nav__list__item__link no-mega" href="<?php echo $top_level_guide_page ?>">Guide</a>
                </li>
                <li class="header__main__nav__list__item">
                    <a class="header__main__nav__list__item__link no-mega" href="<?php echo $top_level_about_page ?>">About</a>
                </li>
            </div>
        </nav>
        <!-- Right Side -->
        <div class="header__main__right">


            <!-- Contact Mail -->
            <a href="<?php echo get_home_url(); ?>/contact" class="header__main__right__contact-link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                </svg>
            </a>
            <!-- Contact Phone -->
            <div class="header__main__right__phone-desktop divider-left">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
                </svg>
                <span class="phone-popover">
                    <div class="phone-popover__container">
                        <div class="phone-popover__container__arrow"></div>
                        <div class="phone-popover__container__content">
                            <div class="phone-popover__container__content__header">
                                Give Us a Call
                            </div>
                            <a class="phone-popover__container__content__number" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                                <?php echo get_field('phone_number', 'options'); ?>
                            </a>
                        </div>
                    </div>
                </span>
            </div>
            <!-- Language Switch -->
            <?php
            if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                <div class="header__main__right__language divider-left">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
                    </svg>
                    <span>

                        <?php echo do_shortcode("[language-switcher]"); ?>
                    </span>
                </div>
            <?php endif; ?>
            <div class="header__main__right__agents divider-left">
                <a class="" href="<?php echo $top_level_agents_page; ?>">
                    Agents
                </a>
            </div>
            <!-- Burger Menu -->
            <div class="burger-button" id="burger-menu">
                <span class="burger-button__bar "></span>
            </div>

        </div>
    </div>

    <!-- Mega desktop -->
    <div class="nav-mega">
        <!-- Cruises -->
        <div class="nav-mega__nav nav-mega__nav--cruises">

            <div class="nav-mega__nav__main"  style="margin-top: 3rem;">
                <?php foreach ($nav_cruises as $nav_cruise) :
                    $region = $nav_cruise['region']; // page
                    $region_display = $nav_cruise['region_display'];
                    $nav_destinations = $nav_cruise['destinations'];
                ?>
                    <div class="nav-mega__nav__main__sub-group">
                        <a class="nav-mega__nav__main__sub-group__title" href="<?php echo $region ?>"><?php echo $region_display ?></a>
                        <ul class="nav-mega__nav__main__sub-group__list">

                            <?php foreach ($nav_destinations as $nav_destination) :
                                $destination = $nav_destination['destination']; // page
                                $destination_display = $nav_destination['destination_display'];
                                $is_sub = $nav_destination['is_sub'];
                            ?>
                                <li class="nav-mega__nav__main__sub-group__item">
                                    <a href="<?php echo $destination ?>" class="nav-mega__nav__main__sub-group__link"><?php echo $is_sub ? " - " : "" ?><?php echo $destination_display ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="nav-mega__nav__all">
                <a class="btn-outline btn-outline--dark  btn-outline--xsmall" href="<?php echo $top_level_cruises_page ?>">View All Cruises</a>
            </div>

        </div>
        <!-- Packages -->
        <div class="nav-mega__nav nav-mega__nav--packages">

            <div class="nav-mega__nav__main" style="margin-top: 3rem;">
                <?php foreach ($nav_packages as $nav_package) :
                    $package = $nav_package['category']; // page
                    $package_display = $nav_package['category_display'];
                    $package_items = $nav_package['category_items'];
                ?>
                    <div class="nav-mega__nav__main__sub-group">
                        <a class="nav-mega__nav__main__sub-group__title" href="<?php echo $package ?>"><?php echo $package_display ?></a>
                        <ul class="nav-mega__nav__main__sub-group__list">

                            <?php foreach ($package_items as $package_item) :
                                $item = $package_item['item']; // page
                                $item_display = $package_item['item_display'];
                            ?>
                                <li class="nav-mega__nav__main__sub-group__item">
                                    <a href="<?php echo $item ?>" class="nav-mega__nav__main__sub-group__link"><?php echo $item_display ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>

            </div>
                  <div class="nav-mega__nav__all">
                    <a class="btn-outline btn-outline--dark  btn-outline--xsmall" href="<?php echo $top_level_packages_page ?>">View All Packages</a>
                </div>

        </div>
        <div class="nav-mega__nav nav-mega__nav--experiences">
            <div class="nav-mega__nav__main">
                <?php foreach ($nav_experiences as $nav_experience) :
                    $experience = $nav_experience['experience'];
                    $experience_display = $nav_experience['experience_display'];
                ?>
                    <a href="<?php echo $experience ?>" class="nav-mega__nav__link"><?php echo $experience_display ?></a>
                <?php endforeach; ?>

            </div>

        </div>
    </div>

    <div class="nav-mega-overlay"></div>



    <!-- Product Secondary Nav -->
    <?php if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges') :
        get_template_part('template-parts/content', 'nav-product');
    endif; ?>



    <!-- Destination Secondary Nav -->
    <?php
    if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) :
        get_template_part('template-parts/content', 'nav-destination');
    endif; ?>

</header>