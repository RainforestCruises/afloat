<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan Lewis">

    <!-- Custom OG Meta -->
    <?php
    $og_featured_image = null;


    // product
    if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges' || get_post_type() == 'rfc_travel_guides') {
        $og_featured_image = get_field('featured_image');
    }
    // home, destination
    if (is_page_template('template-home.php') || is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) {
        $slider = get_field('hero_slider');
        $og_featured_image = $slider[0]['image'];
    }
    // experience
    if (is_page_template('template-experiences.php')) {
        $og_featured_image = get_field('hero_image');
    }
    // Note: use WP Featured Image for Serps and Guide Landing Pages
    if ($og_featured_image) : ?>

    <meta property="og:image" content="<?php echo $og_featured_image['url']; ?>" />
    <meta property="og:image:secure_url" content="<?php echo $og_featured_image['url']; ?>" />
    <meta property="og:width" content="<?php echo $og_featured_image['width']; ?>" />
    <meta property="og:height" content="<?php echo $og_featured_image['height']; ?>" />
    <meta property="og:alt" content="<?php echo $og_featured_image['alt']; ?>" />
    <meta property="og:type" content="image/jpeg" />
    <meta name="twitter:image" content="<?php echo $og_featured_image['url']; ?>" />

    <?php endif; ?>


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

<body <?php body_class("global"); ?> id="body">


    <?php
    wp_body_open();
    get_template_part('template-parts/content', 'nav-rfc');
    ?>