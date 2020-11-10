<?php

function load_scripts()
{
    //css styles
    wp_enqueue_style('primary-font', 'https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,600,700,800', array(), false, 'all');
    wp_enqueue_style('secondary-font', 'https://fonts.googleapis.com/css?family=Old+Standard+TT:300,400,400i,500,600,700,800', array(), false, 'all');
    wp_enqueue_style('tertiary-font', 'https://fonts.googleapis.com/css?family=Old+Standard+TT:300,400,400i,500,600,700,800', array(), false, 'all');

    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', array(), false, 'all');
    wp_enqueue_style('slick-min', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), false, 'all');

    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css', array(), false, 'all');
    wp_enqueue_style('fancybox-css', get_template_directory_uri() . '/vendor/fancybox/jquery.fancybox-1.3.4.css', array(), false, 'all');
    wp_enqueue_style('daterangepicker-css', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css', array(), false, 'all');


    //wp_enqueue_style('semantic-css', get_template_directory_uri() . '/js/vendor/semantic-ui/semantic.css', array(), false, 'all');


    wp_enqueue_style('template', get_template_directory_uri() . '/css/style.css', array(), false, 'all');

    //js scripts
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1', true);
    wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', array('jquery'), false, true);
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/vendor/fancybox/jquery.fancybox-1.3.4.js', array('jquery'), false, true);

    wp_enqueue_script('moment', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'), false, true);

    wp_enqueue_script('daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery'), false, true);

    
    wp_enqueue_script('utility', get_template_directory_uri() . '/js/utilities.js', array('jquery'), false, true);
    wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array('jquery'), false, true);

}

add_action('wp_enqueue_scripts', 'load_scripts');

//remove_filter( 'the_content', 'wpautop' );

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


/* Add custom classes to list item "li" */
function _namespace_menu_item_class($classes, $item)
{
    $classes[] = "header__main__nav__list__item"; // you can add multiple classes here
    return $classes;
}

add_filter('nav_menu_css_class', '_namespace_menu_item_class', 10, 2);

/* Add custom class to link in menu */
function _namespace_modify_menuclass($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

add_filter('wp_nav_menu', '_namespace_modify_menuclass');


//SCHEDULING --------------
//add schedule interval
add_filter('cron_schedules', 'rfc_add_cron_interval');
function rfc_add_cron_interval($schedules)
{
    $schedules['every_ten_seconds'] = array(
        'interval'  => 60,
        'display'   => __('Every 10 Seconds', 'textdomain')
    );
    return $schedules;
}
//


// Schedule an action if it's not already scheduled
if (!wp_next_scheduled('rfc_add_cron_interval')) {
    wp_schedule_event(time(), 'every_ten_seconds', 'rfc_add_cron_interval');
}

// IMPORTANT - Hook into that action that'll fire every 10 seconds
//add_action( 'rfc_add_cron_interval', 'refresh_cruise_info_all' );

//create function refresh_cruise_info_all - loop through all cruises
function refresh_cruise_info_all()
{
    //get property_id of each rfc_cruises post types

    $args = array(
        'post_type' => 'rfc_cruises',
    );

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();

            // content goes here
            $pid = get_field('property_id', get_the_ID()); //make sure only cruise
            if ($pid) {
                // Do something...
                refresh_cruise_info($pid, get_the_ID());
            }

        endwhile;
        wp_reset_postdata();
    else :
    endif;
}
//----------------------------------------------------------------



//On Save Post
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id)
{
    $dfPropertyId = get_field('property_id', $post_id); //get property data from DF
    if ($dfPropertyId) {
        if ('rfc_cruises' == get_post_type()) {
            refresh_cruise_info($dfPropertyId, $post_id);
        }
        if ('rfc_lodges' == get_post_type()) {
            refresh_cruise_info($dfPropertyId, $post_id);
        }
    }

    if ('rfc_tours' == get_post_type()) {
        if (have_rows('itineraries')) { //calculate length of itinerary
            while (have_rows('itineraries')) {
                the_row();
                $count = count(get_sub_field('daily_activities'));
                update_sub_field('length_in_days', $count);
            }
        }
    }
}
function refresh_cruise_info($propertyId, $post_id)
{
    //LOCAL TEST
    //$url = 'http://localhost:63665/api/wpproperties/';

    //DF WEB
    $url = 'https://departurefinder.azurewebsites.net/api/wpproperties/';
    $url .= $propertyId;

    $request = wp_remote_get($url);

    if (is_wp_error($request)) {
        return false; // Bail early
    }

    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body, true);


    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
    $currentTime =  gmdate("M d, Y  H:i:s", time() + 3600 * ($timezone + date("I")));

    update_field('cruise_data', $data, $post_id);
    update_field('last_updated', $currentTime, $post_id);
}




//Make Last_Updated and Cruise_Data and Length in Days read only in Admin -----------------------
add_filter('acf/load_field/name=last_updated', 'acf_read_only_last_updated');
function acf_read_only_last_updated($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=cruise_data', 'acf_read_only_cruise_data');
function acf_read_only_cruise_data($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=length_in_days', 'acf_read_only_length_in_days');
function acf_read_only_length_in_days($field)
{
    $field['readonly'] = 1;
    return $field;
}


//Admin blue separation styling for tour itineraries
function my_acf_admin_head()
{
?>
    <style type="text/css">
        .admin_itinerary_name {
            font-size: 20px;
            position: relative;
        }

        .admin_itinerary_name::after {
            position: absolute;
            content: "";
            height: 2px;
            width: 100%;
            background-color: cornflowerblue;
            top: 0;
            left: 0;
            z-index: 10;
        }
    </style>
<?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');
//----------------------------------------------------------------------------


//Console Log Utility--------------
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
//--------------------------------



// Custom Post Type - Cruises 
function create_post_type_rfc_cruises()
{
    register_post_type(
        'rfc_cruises',
        array(
            'labels' => array(
                'name' => __('Cruises'),
                'singular_name' => __('Cruise'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'cruises'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_cruises');

// Custom Post Type - Tours 
function create_post_type_rfc_tours()
{
    register_post_type(
        'rfc_tours',
        array(
            'labels' => array(
                'name' => __('Tours'),
                'singular_name' => __('Tour'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'tours'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_tours');


// Custom Post Type - Lodges 
function create_post_type_rfc_lodges()
{
    register_post_type(
        'rfc_lodges',
        array(
            'labels' => array(
                'name' => __('Lodges'),
                'singular_name' => __('Lodge'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'lodges'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_lodges');



// Custom Post Type - Destinations
function create_post_type_rfc_destinations()
{
    register_post_type(
        'rfc_destinations',
        array(
            'labels' => array(
                'name' => __('Destinations'),
                'singular_name' => __('Destination'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'destinations'),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',

            )
        )
    );
}
add_action('init', 'create_post_type_rfc_destinations');


// Custom Post Type - Sub Destinations
function create_post_type_rfc_sub_destinations()
{
    register_post_type(
        'rfc_sub_destinations',
        array(
            'labels' => array(
                'name' => __('Sub Destinations'),
                'singular_name' => __('Sub Destination'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'sub-destinations'),
            'supports' => array(
                'title',
                'thumbnail',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_sub_destinations');


// Custom Post Type - Countries
function create_post_type_rfc_countries()
{
    register_post_type(
        'rfc_countries',
        array(
            'labels' => array(
                'name' => __('Countries'),
                'singular_name' => __('Country'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'countries'),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_countries');



//Excerpt length
function custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

//custom image size for blog thumbnails
add_image_size('blog-image-crop', 510, 414, true);



//Product Date Search
add_action('wp_ajax_productSearch', 'search_filter_product_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_productSearch', 'search_filter_product_search');

function search_filter_product_search()
{
    //Set up 
    //Start / End dates
    //Pass Along Post Id (WP ID of Product)

    $productId = $_POST['productId'];


    if (isset($_POST['dates-itinerary-select']) && $_POST['dates-itinerary-select'])
        $selectedItinerary = $_POST['dates-itinerary-select'];

    if (isset($_POST['dates-month-select']) && $_POST['dates-month-select'])
        $selectedMonth = $_POST['dates-month-select'];

    if (isset($_POST['dates-year-select']) && $_POST['dates-year-select'])
        $selectedYear = $_POST['dates-year-select'];


    $args = array(
        'selectedItinerary' => $selectedItinerary,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'productId' => $productId,
    );
    get_template_part('template-parts/content', 'product-dates-results', $args);



    die();
}


//Main Search
add_action('wp_ajax_mainSearch', 'search_filter_main_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_mainSearch', 'search_filter_main_search');

function search_filter_main_search()
{

    $args = array(
        'posts_per_page' => 8,
        'post_type' => 'rfc_cruises'
    );


    if (isset($_POST['destination-select']) && $_POST['destination-select'])
        $args['meta_query'][] = array(
            'key' => 'destination',
            'value' => '"' . $_POST['destination-select'] . '"',
            'compare' => 'LIKE'
        );


        
    $posts = get_posts($args);
    get_template_part('template-parts/content', 'main-search-results', $posts);





    die();
}


//Old One
add_action('wp_ajax_searchFilter', 'search_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_searchFilter', 'search_filter_function');

function search_filter_function()
{
    $args = array(
        'posts_per_page' => 8,
        'post_type' => 'properties',
        'orderby' => 'date', // we will sort posts by date
        'order'    => $_POST['date'] // ASC or DESC
    );

    // for price order
    if (isset($_POST['extraFilter']) && $_POST['extraFilter'])
        $args = array(
            'posts_per_page' => 8,
            'post_type' => 'properties',
            'meta_key' => 'price_from', // we will sort posts by date
            'orderby' => 'meta_value_num',
            'order' => $_POST['extraFilter'] // ASC or DESC
        );

    $args['meta_query'] = array('relation' => 'AND'); // AND means that all conditions of meta_query should be true
    // for style
    if (isset($_POST['styleFilter']) && $_POST['styleFilter'])
        $args['meta_query'][] = array(
            'key' => 'style',
            'value' => '"' . $_POST['styleFilter'] . '"',
            'compare' => 'LIKE'
        );
    // for destination
    if (isset($_POST['destinationFilter']) && $_POST['destinationFilter'])
        $args['meta_query'][] = array(
            'key' => 'destination',
            'value' => '"' . $_POST['destinationFilter'] . '"',
            'compare' => 'LIKE'
        );

    // for country
    if (isset($_POST['countryFilter']) && $_POST['countryFilter'])
        $args['meta_query'][] = array(
            'key' => 'country',
            'value' => '"' . $_POST['countryFilter'] . '"',
            'compare' => 'LIKE'
        );

    // if both minimum price and maximum price are specified we will use BETWEEN comparison
    if (isset($_POST['price_min']) && $_POST['price_min'] && isset($_POST['price_max']) && $_POST['price_max']) {
        $args['meta_query'][] = array(
            'key' => 'price_from',
            'value' => array($_POST['price_min'], $_POST['price_max']),
            'type' => 'numeric',
            'compare' => 'between'
        );
    } else {
        // if only min price is set
        if (isset($_POST['price_min']) && $_POST['price_min'])
            $args['meta_query'][] = array(
                'key' => 'price_from',
                'value' => $_POST['price_min'],
                'type' => 'numeric',
                'compare' => '>'
            );

        // if only max price is set
        if (isset($_POST['price_max']) && $_POST['price_max'])
            $args['meta_query'][] = array(
                'key' => 'price_from',
                'value' => $_POST['price_max'],
                'type' => 'numeric',
                'compare' => '<'
            );
    }



    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            // template part
            if ($_POST['form-type'] == 'all') {
                get_template_part('template-parts/content', 'search-travel');
            }
            if ($_POST['form-type'] == 'destinations') {
                get_template_part('template-parts/content', 'properties-grid');
            }

        //echo '<h2>' . $query->post->post_title . '</h2>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    die();
}
