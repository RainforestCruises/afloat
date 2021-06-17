<?php 
function load_scripts()
{
    //css styles
    wp_enqueue_style('primary-font', 'https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,600,700,800', array(), false, 'all');
    wp_enqueue_style('secondary-font', 'https://fonts.googleapis.com/css?family=Merriweather:300,400,400i,500,600,700,800', array(), false, 'all');
    wp_enqueue_style('tertiary-font', 'https://fonts.googleapis.com/css?family=Old+Standard+TT:300,400,400i,500,600,700,800', array(), false, 'all');
    wp_enqueue_style('fourth-font', 'https://fonts.googleapis.com/css?family=Playfair+Display:300,400,400i,500,600,700,800', array(), false, 'all');

    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', array(), false, 'all');
    wp_enqueue_style('slick-min', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), false, 'all');

    wp_enqueue_style('magnific-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css', array(), false, 'all');

    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css', array(), false, 'all');
    wp_enqueue_style('fancybox-css', get_template_directory_uri() . '/vendor/fancybox/jquery.fancybox-1.3.4.css', array(), false, 'all');
    wp_enqueue_style('daterangepicker-css', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css', array(), false, 'all');
    wp_enqueue_style('ion-css', get_template_directory_uri() . '/vendor/ion-range-slider/css/ion.rangeSlider.min.css', array(), false, 'all');
    wp_enqueue_style('odometer-css', get_template_directory_uri() . '/vendor/odometer/odometer-theme-minimal.css', array(), false, 'all');


    wp_enqueue_style('template', get_template_directory_uri() . '/css/style.css', array(), false, 'all');

    //js scripts
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
    wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('magnific-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js', array('jquery'), false, true);


    wp_enqueue_script('infinite-scroll', 'https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js', array('jquery'), false, true);

    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', array('jquery'), false, true);
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/vendor/fancybox/jquery.fancybox-1.3.4.js', array('jquery'), false, true);
    wp_enqueue_script('ion-js', get_template_directory_uri() . '/vendor/ion-range-slider/js/ion.rangeSlider.min.js', array('jquery'), false, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendor/isotope/isotope.pkgd.min.js', array('jquery'), false, true);
    wp_enqueue_script('odometer', get_template_directory_uri() . '/vendor/odometer/odometer.min.js', array('jquery'), false, true);


    wp_enqueue_script('moment', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'), false, true);
    wp_enqueue_script('daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery'), false, true);

    wp_enqueue_script('cloudinary', 'https://cdnjs.cloudflare.com/ajax/libs/cloudinary-jquery/2.11.3/cloudinary-jquery.min.js', array('jquery'), false, true);

    // wp_enqueue_script('dayjs', 'https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.4/dayjs.min.js', array('jquery'), false, true);


    wp_enqueue_script('utility', get_template_directory_uri() . '/js/utilities.js', array('jquery'), false, true);
    wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array('jquery'), false, true);
//







}

add_action('wp_enqueue_scripts', 'load_scripts');

?>