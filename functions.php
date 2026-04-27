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
    $fields = $form_data['fields'];
    $is_multipage = false;

    if ($form_data['id'] == get_field('newsletter_form_id', 'options')) {
        $is_multipage = true;
    }

    // ── Case 1: Built-in name field with "name-check-field" class ──────────────
    $name_field_id = null;

    foreach ($fields as $id => $field) {
        if (isset($field['css']) && strpos($field['css'], 'name-check-field') !== false) {
            $name_field_id = $id;
            break;
        }
    }

    if ($name_field_id && isset($_POST['wpforms']['fields'][$name_field_id])) {
        $first_name = isset($_POST['wpforms']['fields'][$name_field_id]['first'])
            ? sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['first'])
            : '';
        $last_name = isset($_POST['wpforms']['fields'][$name_field_id]['last'])
            ? sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['last'])
            : '';

        if (!empty($first_name) && strtolower($first_name) === strtolower($last_name)) {
            if ($is_multipage) {
                $errors[$form_data['id']][$name_field_id] = esc_html__('First name and last name cannot be identical.', 'wpforms');
            } else {
                $errors[$form_data['id']]['header'] = esc_html__('First name and last name cannot be identical.', 'wpforms');
            }
        }
    }

    // ── Case 2: Two separate fields with "name-check-multifield" class ─────────
    $multifields = [];

    foreach ($fields as $id => $field) {
        if (isset($field['css']) && strpos($field['css'], 'name-check-multifield') !== false) {
            $multifields[] = $id;
        }
    }

    // Expect exactly two fields; first one = first name, second = last name
    if (count($multifields) === 2) {
        $first_field_id = $multifields[0];
        $second_field_id = $multifields[1];

        $submitted = $_POST['wpforms']['fields'] ?? [];

        if (isset($submitted[$first_field_id]) && isset($submitted[$second_field_id])) {
            $first_name = sanitize_text_field($submitted[$first_field_id]);
            $last_name  = sanitize_text_field($submitted[$second_field_id]);

            if (!empty($first_name) && strtolower($first_name) === strtolower($last_name)) {
                if ($is_multipage) {
                    // Attach the error to the last-name field so it's visible on the right page
                    $errors[$form_data['id']][$second_field_id] = esc_html__('First name and last name cannot be identical.', 'wpforms');
                } else {
                    $errors[$form_data['id']]['header'] = esc_html__('First name and last name cannot be identical.', 'wpforms');
                }
            }
        }
    }

    return $errors;
}
add_filter( 'wpforms_process_initial_errors', 'custom_name_validation', 10, 2 );