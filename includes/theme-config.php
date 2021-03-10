<?php

function afloat_config()
{
    //Registering our menus
    register_nav_menus(
        array(
            'main_menu' => 'Main Menu',
            'footer_menu' => 'Footer Menu'
        )
    );

    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('video', 'image'));
    add_theme_support('title-tag');

    add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'afloat_config', 0); //last parameter is priority


add_action( 'after_setup_theme', 'afloat_images_sizes' );

function afloat_images_sizes() {
    add_image_size( 'full-hero-large', 1920, 1080, true);
    add_image_size( 'full-hero-medium', 1200, 1080, true); 
    add_image_size( 'full-hero-small', 800, 1080, true); 
    add_image_size( 'full-hero-xsmall', 500, 800, true); 

    //landscape (ratio)
    add_image_size( 'wide-slider-medium', 700, 380, true);
    add_image_size( 'wide-slider-small', 500, 380, true);


    add_image_size( 'vertical-large', 500, 700, true); 
    add_image_size( 'vertical-medium', 400, 600, true); 
    add_image_size( 'vertical-small', 285, 320, true); 

    add_image_size( 'square-large', 600, 500, true); 
    add_image_size( 'square-medium', 500, 400, true); 
    add_image_size( 'square-small', 280, 400, true); 


    add_image_size( 'featured-medium', 600, 400, true); 
    add_image_size( 'featured-small', 350, 300, true); 


}

// add_filter( 'image_size_names_choose', 'afloat_images_sizes_add' );
// function afloat_images_sizes_add( $sizes ) {

//     $addsizes = array(
//         "hero-large" => 'Hero Large',
//         "hero-medium" => 'Hero Medium',
//         "hero-portrait" => 'Hero Portrait',
//         "hero-portrait-small" => 'Hero Portrait Small',
//         "landscape-large" => 'Landscape Large',
//         "landscape-medium" => 'Landscape Medium',
//         "landscape-small" => 'Landscape Small',
//         "portriat-medium" => 'Portrait Medium',
//         "portriat-small" => 'Portrait Small',
//         "featured-medium" => 'Featured Medium',
//         "featured-small" => 'Featured Small',

//     );

//     $newsizes = array_merge( $sizes, $addsizes );

//     return $newsizes;

// }


//Excerpt length
function custom_excerpt_length($length)
{
    return 32;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

//custom image size for blog thumbnails
//add_image_size('blog-image-crop', 510, 414, true);

function add_page_categories()
{
    // Add tag metabox to page
    // register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');
}
// Add to the admin_init hook of your theme functions.php file 
add_action('init', 'add_page_categories');




//REMOVE DEFAULT BLOG TYPE ------------
// Remove side menu
add_action('admin_menu', 'remove_default_post_type');

function remove_default_post_type()
{
    remove_menu_page('edit.php');
}

// Remove +New post in top Admin Menu Bar
add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 999);

function remove_default_post_type_menu_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-post');
}

// Remove Quick Draft Dashboard Widget
add_action('wp_dashboard_setup', 'remove_draft_widget', 999);

function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}


//REMOVE COMMENTS ------------------------------
// Removes from admin menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');
