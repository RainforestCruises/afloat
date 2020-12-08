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
}

add_action('after_setup_theme', 'afloat_config', 0); //last parameter is priority


//Excerpt length
function custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

//custom image size for blog thumbnails
add_image_size('blog-image-crop', 510, 414, true);
?>