<?php
/*
Author: Ifran Saad Omee
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

<?php
// Add enqueue functions
add_action('wp_enqueue_scripts', 'color_swatches_enqueue_scripts');

function color_swatches_enqueue_scripts() {
    // Enqueue color swatches CSS
    wp_enqueue_style('color-swatches-css', plugins_url('color-swatches.css', __FILE__));

    // Enqueue color swatches JS
    wp_enqueue_script('color-swatches-js', plugins_url('color-swatches.js', __FILE__), array('jquery'), '1.0', true);
}

<?php
// Add size dropdown to product page
add_action('woocommerce_before_single_product_summary', 'size_selection_dropdown');

function size_selection_dropdown() {
    global $product;

    // Check if the product is variable (has size variations)
    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        $size_attributes = $product->get_variation_attributes()['attribute_pa_size'];
        ?>
        <div class="size-selection">
            <label for="size-dropdown">Select Size:</label>
            <select id="size-dropdown">
                <?php foreach ($size_attributes as $size) : ?>
                    <option value="<?php echo esc_attr($size); ?>"><?php echo esc_html($size); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
    }
}

<?php
// Add product variation price display to product page
add_action('woocommerce_before_single_product_summary', 'display_product_variation_price');

function display_product_variation_price() {
    global $product;

    // Check if the product is variable (has variations)
    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        ?>
        <div class="product-variation-price">
            <?php foreach ($variations as $variation) : ?>
                <?php
                // Get the color and size attributes
                $color = $variation['attributes']['attribute_pa_color'];
                $size = $variation['attributes']['attribute_pa_size'];

                // Get the price for this variation
                $price = $variation['display_price'];

                // Format the price for display
                $formatted_price = wc_price($price);
                ?>
                <span class="variation-price color-<?php echo esc_attr($color); ?> size-<?php echo esc_attr($size); ?>"><?php echo $formatted_price; ?></span>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

<?php
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

<?php
// Add color swatches to product page
add_action('woocommerce_before_single_product_summary', 'color_swatches_display');

function color_swatches_display() {
    global $product;

    // Check if the product is variable (has color variations)
    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        ?>
        <div class="color-swatches">
            <?php foreach ($variations as $variation) : ?>
                <?php
                // Get the color and size attributes
                $color = validate_sanitize_color($variation['attributes']['attribute_pa_color']);
                $size = validate_sanitize_size($variation['attributes']['attribute_pa_size']);
                ?>
                <div class="swatch" data-color="<?php echo esc_attr($color); ?>" style="background-color: <?php echo esc_attr($color); ?>;"></div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

<?php
// Add custom setting to WooCommerce settings
add_filter('woocommerce_get_settings_pages', 'add_custom_settings');

function add_custom_settings($settings) {
    $settings[] = include('custom-settings.php');
    return $settings;
}

<?php
// Save the custom setting value
add_action('woocommerce_update_options', 'save_custom_setting');

function save_custom_setting() {
    $enable_custom_display = isset($_POST['color_swatches_enable']) ? 'yes' : 'no';
    update_option('color_swatches_enable', $enable_custom_display);
}

<?php
// Add color swatches to product page
add_action('woocommerce_before_single_product_summary', 'color_swatches_display');

function color_swatches_display() {
    global $product;

    // Check if the custom product variation display feature is enabled
    $enable_custom_display = get_option('color_swatches_enable', 'no');

    // Check if the product is variable (has color variations) and the custom display is enabled
    if ($enable_custom_display === 'yes' && $product->is_type('variable')) {
        $variations = $product->get_available_variations();
        ?>
        <div class="color-swatches">
            <?php foreach ($variations as $variation) : ?>
                <?php
                // Get the color and size attributes
                $color = validate_sanitize_color($variation['attributes']['attribute_pa_color']);
                $size = validate_sanitize_size($variation['attributes']['attribute_pa_size']);
                ?>
                <div class="swatch" data-color="<?php echo esc_attr($color); ?>" style="background-color: <?php echo esc_attr($color); ?>;"></div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

<?php

// Include the plugin class file
require_once(plugin_dir_path(__FILE__) . 'class-color-swatches.php');

// Create the plugin instance
$color_swatches_plugin = new Color_Swatches_Plugin();