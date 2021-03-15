<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- this loads stylesheets  -->
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

<body <?php body_class("global"); ?>>
    <!-- Header -->
    <header class="header" id="header">

        <!-- Top Level Nav -->
        <div class="header__main ">
            <div class="header__main__logo-area">
                <a href="<?php echo get_home_url(); ?>" class="header__main__logo-area__logo">
                    <?php
                    $logo = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($logo, 'full');
                    $image_url = $image[0];
                    ?>
                    <img src="<?php echo $image_url ?>" />
                </a>
            </div>

            <nav class="header__main__nav">
                <div class="header__main__nav__list">
                    <?php
                    foreach ($menu_toplevel as $toplevelItem) :
                        $megaClass = ($toplevelItem->title == 'Destinations' || $toplevelItem->title == 'Experiences') ? 'mega' : 'no-mega';
                    ?>
                        <li class="header__main__nav__list__item">
                            <span class="header__main__nav__list__item__link <?php echo $megaClass ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></span>
                        </li>
                    <?php endforeach; ?>
                </div>
            </nav>
            <div class="header__main__right">
                <div class="header__main__right__item header__main__right__item--contact">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                    </svg>
                    <span>
                        Contact
                    </span>
                </div>
                <div class="header__main__right__item header__main__right__item--phone">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
                    </svg>
                    <span>
                        +1.866.783.9029
                    </span>

                </div>

                <!-- Burger Menu -->
                <div class="burger-menu">
                    <span class="burger-menu__bar "></span>
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

        <!-- Mega mobile -->
        <nav class="nav-mobile">

            <!-- Top level Menu -->
            <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">
                <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                    <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $toplevelItem->ID ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                        </svg>
                        <span>
                            <?php echo $toplevelItem->title ?>
                        </span>

                    </a>
                <?php endforeach; ?>
                <a class="nav-mobile__content-panel__button mobile-link">Contact</a>
            </div>


            <!-- Level 2 -->
            <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="<?php echo $toplevelItem->ID ?>">
                    <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--back" menuLinkTo="top">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                        </svg>
                        <span>
                            <?php echo $toplevelItem->title ?>
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
                    <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--back" menuLinkTo="<?php echo $destination_group['parentId'] ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                        </svg>
                        <span>
                            <?php echo $destination_group['title'] ?>
                        </span>

                    </a>

                    <!-- Cruises -->
                    <a href="<?php echo $destination_group['url'] ?>" class="nav-mobile__content-panel__button mobile-link">View All</a>

                    <?php $destinationsMenuArray = $destination_group['destinations']; ?>
                    <?php foreach ($destinationsMenuArray as $destinationMenuItem) : ?>
                        <a href="<?php echo $destinationMenuItem['url'] ?>" class="nav-mobile__content-panel__button mobile-link"><?php echo $destinationMenuItem['title'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>



        </nav>

    </header>