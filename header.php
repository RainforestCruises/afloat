<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- this loads stylesheets  -->
    <?php wp_head(); ?>
</head>

<body <?php body_class("global"); ?>>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header__main ">
            <div class="header__main__logo-area">
                <a href="<?php echo get_home_url(); ?>" class="header__main__logo-area__logo">
                    <?php 
                    $logo = get_theme_mod( 'custom_logo' );
                    $image = wp_get_attachment_image_src( $logo , 'full' );
                    $image_url = $image[0];
                    ?>
                    <img src="<?php echo $image_url ?>"  />
                </a>
            </div>

            <nav class="header__main__nav" id="mega--destinations">
                <?php wp_nav_menu(array(
                    'theme_location' => 'main_menu',
                    'depth' => 1,
                    'container' => '',
                    'menu_class' => 'header__main__nav__list',
                    //'items_wrap' => 'header__main__nav__list__item',
                )); ?>
            </nav>
            <!-- Burger Menu -->
            <div class="burger-menu">
                <span class="burger-menu__bar "></span>
            </div>
        </div>

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

        <div class="nav-mega">
            <div class="nav-mega__nav">
                <div class="nav-mega__nav__sub-group">
                    <!-- Input , Label, Content -->
                    <!-- <input class="nav-mega__nav__sub-group__radio" type="radio" id="dest-1"> -->
                    <a href="#" class="nav-mega__nav__sub-group__title">Adventure Cruises</a>
                    <ul class="nav-mega__nav__sub-group__list">
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Amazon River</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Galapagos Islands</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Indonesian Archipelego</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Irrawaddy River</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Mekong River</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-mega__nav__sub-group">
                    <a href="#" class="nav-mega__nav__sub-group__title">South America</a>
                    <ul class="nav-mega__nav__sub-group__list">
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Argentina</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Brazil</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Peru</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Amazon</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Galapagos</a>
                        </li>

                    </ul>
                </div>
                <div class="nav-mega__nav__sub-group">
                    <a href="#" class="nav-mega__nav__sub-group__title">Asia</a>
                    <ul class="nav-mega__nav__sub-group__list">
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Cambodia</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Indonesia</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Laos</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Myanmar</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Vietnam</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Thailand</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-mega__nav__sub-group">
                    <a href="#" class="nav-mega__nav__sub-group__title">Bucket List</a>
                    <ul class="nav-mega__nav__sub-group__list">
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Angkor Wat</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Machu Picchu</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Halong Bay</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Iguazu Falls</a>
                        </li>
                        <li class="nav-mega__nav__sub-group__item">
                            <a href="#" class="nav-mega__nav__sub-group__link">Pantanal</a>
                        </li>

                    </ul>
                </div>
            </div>




        </div>

    </header>