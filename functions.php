<?php

require_once(__DIR__ . '/includes/load-scripts.php');
require_once(__DIR__ . '/includes/theme-config.php');
require_once(__DIR__ . '/includes/menu-config.php');
require_once(__DIR__ . '/includes/post-meta-scripts.php');
require_once(__DIR__ . '/includes/utilities.php');
require_once(__DIR__ . '/includes/custom-post-types.php');
require_once(__DIR__ . '/includes/tour-functions.php');
require_once(__DIR__ . '/includes/property-functions.php');
require_once(__DIR__ . '/includes/search-forms.php');
require_once(__DIR__ . '/includes/search-functions.php');
require_once(__DIR__ . '/includes/custom-shortcodes.php');



//ACP local files system storage
add_filter('acp/storage/file/directory', function () {
    // Use a writable path, directory will be created for you
    return get_stylesheet_directory() . '/acp-settings';
});

//enable migrations
add_filter('acp/storage/file/directory/migrate', '__return_true');


function sortImportance($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($a->importance, $b->importance);
    }
}

//enable ACF options page
if (function_exists('acf_add_options_page')) {

    acf_add_options_page();
}

// Same Name Spam Check
function custom_name_validation( $errors, $form_data ) {
    // Get form fields
    $fields = $form_data['fields'];
    $name_field_id = null;
    
    // Loop through fields to find the one with your custom CSS class
    foreach ($fields as $id => $field) {
        // Check if the field has CSS classes defined
        if (isset($field['css']) && strpos($field['css'], 'name-check-field') !== false) {
            $name_field_id = $id;
            break;
        }
    }
    
    // If we found a field with the custom class
    if ($name_field_id) {
        $first_name = isset($_POST['wpforms']['fields'][$name_field_id]['first']) ? 
            sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['first']) : '';
        $last_name = isset($_POST['wpforms']['fields'][$name_field_id]['last']) ? 
            sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['last']) : '';
        
        if (strtolower($first_name) === strtolower($last_name) && !empty($first_name)) {
            $errors[$form_data['id']]['header'] = esc_html__('First name and last name cannot be identical.', 'wpforms');
        }
    }
    
    return $errors;
 }
 add_filter( 'wpforms_process_initial_errors', 'custom_name_validation', 10, 2 );