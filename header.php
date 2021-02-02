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

console_log($menuitems);

$menu_toplevel = [];
$menu_destination_groups = [];

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
                        'destinations' => $destinations
                    );

                    $menu_destination_groups[] = $destinationGroup;
                }
            }
        }
    }
}
console_log($menu_toplevel);
console_log($menu_destination_groups);


?>

<body <?php body_class("global"); ?>>
    <!-- Header -->
    <header class="header" id="header">
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

            <nav class="header__main__nav" id="mega--destinations">
                <div class="header__main__nav__list">
                    <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                        <li class="header__main__nav__list__item">
                            <a href="<?php echo $toplevelItem->url ?>" class="nav-link"><?php echo $toplevelItem->title ?></a>
                        </li>
                    <?php endforeach; ?>
                </div>
            </nav>
            <!-- Burger Menu -->
            <div class="burger-menu">
                <span class="burger-menu__bar "></span>
            </div>
        </div>



        <!-- Mega desktop -->
        <div class="nav-mega">
            <!-- Destinations -->
            <div class="nav-mega__nav">
                <?php foreach ($menu_destination_groups as $destination_group) : ?>
                    <!-- <li class="header__main__nav__list__item">
                        <a href="<?php echo $toplevelItem->url ?>" class="nav-link"><?php echo $toplevelItem->title ?></a>
                    </li> -->

                    <div class="nav-mega__nav__sub-group">
                        <div class="nav-mega__nav__sub-group__title"><?php echo $destination_group['title'] ?></div>
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
        </div>

        <!-- Mega mobile -->
        <nav class="header__collapse">

            <!-- Main Panel -->
            <button class="header__collapse__accordion header__collapse__accordion--main">Destinations</button>
            <div class="header__collapse__accordion__panel ">

                <!-- Sub Panel -->
                <div class="header__collapse__accordion header__collapse__accordion__sub-group header__collapse__accordion--destinations">
                    Adventure Cruises</div>
                <ul class="header__collapse__accordion__panel header__collapse__accordion__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Amazon River</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Galapagos Islands</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Indonesian Archipelago</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Irrawaddy River</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Mekong River</a>
                    </li>
                </ul>

                <!-- Sub Panel -->
                <div class="header__collapse__accordion header__collapse__accordion__sub-group header__collapse__accordion--destinations">
                    South America</div>
                <ul class="header__collapse__accordion__panel header__collapse__accordion__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Argentina</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Brazil</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Peru</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Amazon</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Galapagos</a>
                    </li>
                </ul>

                <!-- Sub Panel -->
                <div class="header__collapse__accordion header__collapse__accordion__sub-group header__collapse__accordion--destinations">
                    Asia</div>
                <ul class="header__collapse__accordion__panel header__collapse__accordion__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Cambodia</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Indonesia</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Laos</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Myanmar</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Vietnam</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Thailand</a>
                    </li>
                </ul>

                <!-- Sub Panel -->
                <div class="header__collapse__accordion header__collapse__accordion__sub-group header__collapse__accordion--destinations">
                    Bucket List</div>
                <ul class="header__collapse__accordion__panel header__collapse__accordion__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Angkor Wat</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Machu Picchu</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Halong Bay</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Iguazu Falls</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Pantanal</a>
                    </li>

                </ul>
            </div>
            </div>

            <button class="header__collapse__accordion header__collapse__accordion--main">Experiences</button>
            <div class="header__collapse__accordion__panel">
                <ul class="header__collapse__accordion__panel__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">AAA</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">BVB</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">CC</a>
                    </li>
                </ul>
            </div>

            <button class="header__collapse__accordion header__collapse__accordion--main">Deals</button>
            <div class="header__collapse__accordion__panel">
                <ul class="header__collapse__accordion__panel__list">
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Deal 1</a>
                    </li>
                    <li class="header__collapse__accordion__panel__item">
                        <a href="#" class="header__collapse__accordion__panel__link">Deal 2</a>
                    </li>

                </ul>
            </div>
        </nav>

    </header>