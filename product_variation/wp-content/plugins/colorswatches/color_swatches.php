<?php
/*
Plugin Name: Color Swatches
Description: Display color swatches for each available color variation below the product image.
Version: 1.0
Author: Ifran Saad
*/

// Plugin activation hook
register_activation_hook(__FILE__, 'color_swatches_activation');

function color_swatches_activation() {
    // Add any activation tasks here if needed
}

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'color_swatches_deactivation');

function color_swatches_deactivation() {
    // Add any deactivation tasks here if needed
}

// Add enqueue functions
add_action('wp_enqueue_scripts', 'color_swatches_enqueue_scripts');

function color_swatches_enqueue_scripts() {
    // Enqueue color swatches CSS
    wp_enqueue_style('color-swatches-css', plugins_url('color-swatches.css', __FILE__));

    // Enqueue color swatches JS
    wp_enqueue_script('color-swatches-js', plugins_url('color-swatches.js', __FILE__), array('jquery'), '1.0', true);
}


// Function to validate and sanitize color attribute
function validate_sanitize_color($color) {
    // Define the allowed color values or patterns
    $allowed_colors = array('color-1', 'color-2', 'color-3');

    // Check if the given color is in the allowed list
    if (in_array($color, $allowed_colors)) {
        return $color;
    }

    // If the color is not in the allowed list, use a default color
    return 'default-color';
}

// Function to validate and sanitize size attribute
function validate_sanitize_size($size) {
    // Define the allowed size values or patterns
    $allowed_sizes = array('small', 'medium', 'large');

    // Check if the given size is in the allowed list
    if (in_array($size, $allowed_sizes)) {
        return $size;
    }

    // If the size is not in the allowed list, use a default size
    return 'default-size';
}



// Add custom setting to WooCommerce settings
add_filter('woocommerce_get_settings_pages', 'add_custom_settings');

function add_custom_settings($settings) {
    $settings[] = include('custom-settings.php');
    return $settings;
}


// Save the custom setting value
add_action('woocommerce_update_options', 'save_custom_setting');

function save_custom_setting() {
    $enable_custom_display = isset($_POST['color_swatches_enable']) ? 'yes' : 'no';
    update_option('color_swatches_enable', $enable_custom_display);
}

// Add color swatches to product page
add_action('woocommerce_before_single_product_summary', 'color_swatches_display');



// Include the plugin class file
require_once(plugin_dir_path(__FILE__) . 'class-color-swatches.php');

// Create the plugin instance
$color_swatches_plugin = new Color_Swatches_Plugin();

