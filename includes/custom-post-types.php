<?php 


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
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_destinations');


// Custom Post Type - Locations
function create_post_type_rfc_locations()
{
    register_post_type(
        'rfc_locations',
        array(
            'labels' => array(
                'name' => __('Locations'),
                'singular_name' => __('Location'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'locations'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_locations');


// Custom Post Type - Regions
function create_post_type_rfc_regions()
{
    register_post_type(
        'rfc_regions',
        array(
            'labels' => array(
                'name' => __('Regions'),
                'singular_name' => __('Region'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'regions'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_regions');


// Custom Post Type - countries
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
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_countries');

// Custom Post Type - experiences
function create_post_type_rfc_experiences()
{
    register_post_type(
        'rfc_experiences',
        array(
            'labels' => array(
                'name' => __('Experiences'),
                'singular_name' => __('Experience'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'experiences'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_experiences');


