<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan Lewis">

    <!-- Structured Data / Rich Snippets -->
    <?php
    //Destination
    if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) {
        echo structuredData('destination'); //Breadcrumbs
        echo structuredDataFaq(); // FAQ
    }

    //Product
    if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges') {
        echo structuredData('product');
    }

    //Search
    if (is_page_template('template-search.php')) {
        echo structuredData('product'); //identical structures
    }

    //Travel Guide Landing Page
    if (is_page_template('template-travel-guide.php')) {
        echo structuredData('guideLanding');
    }

    //Travel Guide
    if (get_post_type() == 'rfc_travel_guides') {
        echo structuredData('guide');
    }

    ?>

    <!-- Load Head / Style Sheets -->
    <?php wp_head(); ?>
</head>




<?php

$menu_name = 'main_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);


$menu_toplevel = [];
$menu_destination_groups = [];
$menu_experiences = [];

$alwaysActiveHeader = checkActiveHeader(); //return true/false depending on if current template header bar should never be transparent

foreach ($menuitems as $m) {

    //Top Level
    if ($m->menu_item_parent == 0) {
        $menu_toplevel[] = $m;


        //Destinations
        if ($m->post_name == "destinations") {
            //$menu_toplevel[] = $m;

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {

                $destinationGroup_ID = $mm->ID;
                if ($mm->menu_item_parent == $toplevel_ID) {


                    //loop again to get this destination group 
                    $destinations = [];
                    foreach ($menuitems as $mmm) {
                        if ($mmm->menu_item_parent == $destinationGroup_ID) {
                            $destination = array(
                                'id' => $mmm->ID,
                                'title' => $mmm->title,
                                'url' => $mmm->url,

                            );

                            $destinations[] = $destination;
                        }
                    }

                    $destinationGroup = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url,
                        'destinations' => $destinations,
                        'parentId' => $toplevel_ID,

                    );

                    $menu_destination_groups[] = $destinationGroup;
                }
            }
        } else if ($m->post_name == "experiences") {

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {
                if ($mm->menu_item_parent == $toplevel_ID) {


                    $experience = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url
                    );

                    $menu_experiences[] = $experience;
                }
            }
        }
    }
}
?>




<body <?php body_class("global"); ?> id="body">

    <!-- Mobile Menu -->
    <nav class="nav-mobile">

        <div class="burger-button close" id="burger-menu-close">
            <span class="burger-button__bar "></span>
        </div>
        <!-- Top level Menu -->
        <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">
            <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                <?php if ($toplevelItem->object != 'page') : ?>
                    <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $toplevelItem->ID ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                        </svg>
                        <span>
                            <?php echo $toplevelItem->title ?>
                        </span>

                    </a>
                <?php else : ?>
                    <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $toplevelItem->url ?>"><?php echo $toplevelItem->title ?></a>

                <?php endif; ?>
            <?php endforeach; ?>

            <a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_home_url(); ?>/contact">Contact</a>

            <a class="nav-mobile__content-panel__button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                <?php echo get_field('phone_number', 'options'); ?>
            </a>
        </div>


        <!-- Level 2 -->
        <?php foreach ($menu_toplevel as $toplevelItem) : ?>
            <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="<?php echo $toplevelItem->ID ?>">
                <a class="nav-mobile__content-panel__button back-link" menuLinkTo="top">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                    </svg>
                    <span>
                        Back
                    </span>

                </a>

                <?php if ($toplevelItem->title == 'Destinations') : ?>
                    <?php foreach ($menu_destination_groups as $destination_group) : ?>
                        <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $destination_group['id'] ?>">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                            </svg>
                            <span>
                                <?php echo $destination_group['title'] ?>
                            </span>

                        </a>
                    <?php endforeach; ?>
                <?php endif ?>

                <?php if ($toplevelItem->title == 'Experiences') : ?>
                    <?php foreach ($menu_experiences as $experience) : ?>
                        <a href="<?php echo $experience['url'] ?>" class="nav-mobile__content-panel__button mobile-link">
                            <?php echo $experience['title'] ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif ?>

            </div>
        <?php endforeach; ?>

        <!-- Level 3 -->

        <?php foreach ($menu_destination_groups as $destination_group) : ?>
            <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuId="<?php echo $destination_group['id'] ?>">
                <a class="nav-mobile__content-panel__button back-link" menuLinkTo="<?php echo $destination_group['parentId'] ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                    </svg>
                    <span>
                        Back
                    </span>

                </a>

                <!-- Cruises -->


                <?php $destinationsMenuArray = $destination_group['destinations']; ?>
                <?php foreach ($destinationsMenuArray as $destinationMenuItem) : ?>
                    <a href="<?php echo $destinationMenuItem['url'] ?>" class="nav-mobile__content-panel__button mobile-link"><?php echo $destinationMenuItem['title'] ?></a>
                <?php endforeach; ?>
                <a href="<?php echo $destination_group['url'] ?>" class="nav-mobile__content-panel__button mobile-link divider">

                    View All

                </a>
            </div>
        <?php endforeach; ?>



    </nav>

    <!-- Desktop Header -->
    <!-- Header -->
    <header class="header " id="header">

        <!-- Top Level Nav -->
        <div class="header__main <?php echo ($alwaysActiveHeader == true) ? 'active' : ''; ?>">
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

            <nav class="header__main__nav">
                <div class="header__main__nav__list">
                    <?php
                    foreach ($menu_toplevel as $toplevelItem) :
                        $megaClass = ($toplevelItem->title == 'Destinations' || $toplevelItem->title == 'Experiences') ? 'mega' : 'no-mega';
                    ?>
                        <li class="header__main__nav__list__item">
                            <?php if ($toplevelItem->object != 'page') : ?>
                                <span class="header__main__nav__list__item__link <?php echo $megaClass ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></span>
                            <?php else : ?>
                                <a class="header__main__nav__list__item__link <?php echo $megaClass ?>" href="<?php echo $toplevelItem->url ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </div>
            </nav>
            <div class="header__main__right">
            <?php echo do_shortcode("[language-switcher]"); ?>
                <a href="<?php echo get_home_url(); ?>/contact" class="header__main__right__contact-link">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                    </svg>
                    <span>
                        Contact
                    </span>
                </a>
                <div class="header__main__right__phone-desktop">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
                    </svg>
                    <span>
                        <?php echo get_field('phone_number', 'options'); ?>
                    </span>
                </div>
                <!-- Burger Menu -->
                <div class="burger-button" id="burger-menu">
                    <span class="burger-button__bar "></span>
                </div>

            </div>
        </div>


        <!-- Mega desktop -->
        <div class="nav-mega">
            <!-- Destinations -->
            <div class="nav-mega__nav nav-mega__nav--destinations">
                <?php foreach ($menu_destination_groups as $destination_group) : ?>
                    <div class="nav-mega__nav__sub-group">
                        <a class="nav-mega__nav__sub-group__title" href="<?php echo $destination_group['url'] ?>"><?php echo $destination_group['title'] ?></a>
                        <ul class="nav-mega__nav__sub-group__list">
                            <?php $destinationsArray = $destination_group['destinations']; ?>
                            <?php foreach ($destinationsArray as $destinationMenuItem) : ?>
                                <li class="nav-mega__nav__sub-group__item">
                                    <a href="<?php echo $destinationMenuItem['url'] ?>" class="nav-mega__nav__sub-group__link"><?php echo $destinationMenuItem['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="nav-mega__nav nav-mega__nav--experiences">
                <?php foreach ($menu_experiences as $experiencesItem) : ?>
                    <a href="<?php echo $experiencesItem['url'] ?>" class="nav-mega__nav__link"><?php echo $experiencesItem['title'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="nav-mega-overlay"></div>



        <!-- Product Secondary Nav -->
        <?php if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges') : ?>

            <?php
            $productTitle = "";
            $showOverview = true;

            if (get_post_type() == 'rfc_tours') :
                $productTitle = get_field('tour_name');
                $showOverview  = get_field('show_overview');
            else :
                $productTitle = get_the_title();
            endif;
            ?>

            <nav class="nav-secondary" id="nav-secondary">
                <div class="nav-secondary__main">
                    <div class="nav-secondary__main__title-area">
                        <a class="nav-secondary__main__title-area__title" id="nav-secondary-title" href="#top">
                            <?php echo $productTitle ?>
                        </a>
                        <button class="nav-secondary__main__title-area__button" id="nav-secondary-button">
                            <div class="nav-secondary__main__title-area__button__icon-area">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                                </svg>
                            </div>
                            <div class="nav-secondary__main__title-area__button__text-area">
                                <?php echo $productTitle ?>
                            </div>

                        </button>

                    </div>
                    <ul class="nav-secondary__main__links">
                        <?php if ($showOverview) : ?>
                            <li>
                                <a href="#overview">Overview</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="#itineraries"><?php echo (get_post_type() != 'rfc_tours') ? ('Itineraries & Prices') : ('Itinerary & Prices'); ?></a>
                        </li>
                        <li>
                            <a href="#accommodations">Accommodations</a>
                        </li>
                    </ul>
                    <div class="nav-secondary__main__cta">
                        <button class="btn-cta-round btn-cta-round--small" id="nav-secondary-cta">
                            Inquire
                        </button>
                    </div>
                </div>
            </nav>



            <!--mobile menu expand-->
            <nav class="nav-secondary-mobile ">
                <ul class="nav-secondary-mobile__list">
                    <?php if ($showOverview) : ?>
                        <li class="nav-secondary-mobile__list__item">
                            <a class="nav-secondary-mobile__list__item__link" href="#overview">Overview</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a class="nav-secondary-mobile__list__item__link" href="#itineraries"><?php echo (get_post_type() != 'rfc_tours') ? ('Itineraries & Prices') : ('Itinerary & Prices'); ?></a>
                    </li>
                    <li class="nav-secondary-mobile__list__item">
                        <a class="nav-secondary-mobile__list__item__link" href="#accommodations">Accommodations</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>



        <!-- Destination Secondary Nav -->
        <?php
        if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) : ?>
            <?php
            $navTitle = "";
            $destinationType = "";

            $accommodationDisplayText = 'Lodges';

            if(is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-region.php')){
                $accommodationDisplayText = get_field('accommodations_label');

                if($accommodationDisplayText == null) {
                    $accommodationDisplayText = 'Lodges';
                }
            }


            if (is_page_template('template-destinations-region.php')) :
                $r = get_field('region_post');
                $navTitle = get_field('navigation_title', $r);
                $destinationType = "region";
            elseif (is_page_template('template-destinations-destination.php')) :
                $d = get_field('destination_post');
                $navTitle = get_field('navigation_title', $d);
                $destinationType = "destination";
            else :
                $d = get_field('destination_post');
                $navTitle = get_field('navigation_title', $d);
                $destinationType = "cruise";
            endif; ?>

            <nav class="nav-secondary" id="nav-secondary">
                <div class="nav-secondary__main">
                    <div class="nav-secondary__main__title-area">
                        <a class="nav-secondary__main__title-area__title" id="nav-secondary-title" href="#top">
                            <?php echo $navTitle ?>
                        </a>
                        <button class="nav-secondary__main__title-area__button" id="nav-secondary-button">
                            <div class="nav-secondary__main__title-area__button__icon-area">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                                </svg>
                            </div>
                            <div class="nav-secondary__main__title-area__button__text-area">
                                <?php echo $navTitle ?>
                            </div>

                        </button>

                    </div>
                    <ul class="nav-secondary__main__links">

                        <!-- Order depending on template type -->
                        <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                            <li>
                                <a href="#packages">Packages</a>
                            </li>
                            <?php if ($destinationType == 'destination') {
                                $hide_cruises = get_field('hide_cruises');
                                if (!$hide_cruises) { ?>
                                    <li>
                                        <a href="#cruises">Cruises</a>
                                    </li>
                                <?php }
                            } else { ?>
                                <li>
                                    <a href="#cruises">Cruises</a>
                                </li>
                            <?php } ?>

                            <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                                $hide_accommodations = get_field('hide_accommodations');
                                if (!$hide_accommodations) { ?>
                                    <li>
                                        <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                                    </li>
                                <?php }
                            } else { ?>
                                <li>
                                    <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                                </li>
                            <?php } ?>

                        <?php } else if ($destinationType == 'cruise') { ?>
                            <li>
                                <a href="#cruises">Cruises</a>
                            </li>
                            <li>
                                <a href="#packages">Packages</a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="#travel-guide">Travel Guide</a>
                        </li>
                        <?php if (get_field('show_testimonials') == true) { ?>
                            <li>
                                <a href="#testimonials">Testimonials</a>
                            </li>
                        <?php } ?>
                        <li href="#faq">
                            <a href="#faq">FAQ</a>
                        </li>
                    </ul>
                    <div class="nav-secondary__main__cta">
                        <button class="btn-cta-round btn-cta-round--small " id="nav-secondary-cta">
                            Inquire
                        </button>
                    </div>
                </div>
            </nav>



            <!--mobile menu expand-->
            <nav class="nav-secondary-mobile ">
                <ul class="nav-secondary-mobile__list">

                    <!-- Order depending on template type -->
                    <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                        <li class="nav-secondary-mobile__list__item">
                            <a href="#packages" class="nav-secondary-mobile__list__item__link">Packages</a>
                        </li>
                        <?php if ($destinationType == 'destination') {
                            $hide_cruises = get_field('hide_cruises');
                            if (!$hide_cruises) { ?>
                                <li class="nav-secondary-mobile__list__item">
                                    <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
                                </li>
                            <?php }
                        } else { ?>
                            <li class="nav-secondary-mobile__list__item">
                                <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
                            </li>
                        <?php } ?>

                        <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                            $hide_accommodations = get_field('hide_accommodations');
                            if (!$hide_accommodations) { ?>
                                <li class="nav-secondary-mobile__list__item">
                                    <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                                </li>
                            <?php }
                        } else { ?>
                            <li class="nav-secondary-mobile__list__item">
                                <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                            </li>
                        <?php } ?>

                    <?php } else if ($destinationType == 'cruise') { ?>
                        <li class="nav-secondary-mobile__list__item">
                            <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
                        </li>
                        <li class="nav-secondary-mobile__list__item">
                            <a href="#packages" class="nav-secondary-mobile__list__item__link">Packages</a>
                        </li>
                    <?php } ?>

                    <li class="nav-secondary-mobile__list__item">
                        <a href="#travel-guide" class="nav-secondary-mobile__list__item__link">Travel Guide</a>
                    </li>

                    <?php if (get_field('show_testimonials') == true) { ?>
                        <li class="nav-secondary-mobile__list__item">
                            <a href="#testimonials" class="nav-secondary-mobile__list__item__link">Testimonials</a>
                        </li>
                    <?php } ?>
                    <li class="nav-secondary-mobile__list__item" href="#faq">
                        <a href="#faq" class="nav-secondary-mobile__list__item__link">FAQ</a>
                    </li>

                </ul>
            </nav>

        <?php endif; ?>



    </header>