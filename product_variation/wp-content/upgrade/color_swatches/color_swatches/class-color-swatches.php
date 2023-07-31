<?php
class Color_Swatches_Plugin {

    public function __construct() {
        add_action('woocommerce_before_single_product_summary', array($this, 'display_color_swatches'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('woocommerce_update_options', array($this, 'save_custom_setting'));
    }

    public function display_color_swatches() {
        if ($this->is_variation_display_enabled()) {
            global $product;

            if ($product->is_type('variable')) {
                $variations = $product->get_available_variations();
                ?>
                <div class="color-swatches">
                    <?php foreach ($variations as $variation) : ?>
                        <?php
                        // Get the color and size attributes
                        $color = $this->validate_sanitize_color($variation['attributes']['attribute_pa_color']);
                        $size = $this->validate_sanitize_size($variation['attributes']['attribute_pa_size']);
                        ?>
                        <div class="swatch" data-color="<?php echo esc_attr($color); ?>" style="background-color: <?php echo esc_attr($color); ?>;"></div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
        }
    }

    public function enqueue_scripts() {
        if ($this->is_variation_display_enabled()) {
            // Enqueue color swatches CSS
            wp_enqueue_style('color-swatches-css', plugins_url('color-swatches.css', __FILE__));
            // Enqueue color swatches JS
            wp_enqueue_script('color-swatches-js', plugins_url('color-swatches.js', __FILE__), array('jquery'), '1.0', true);
        }
    }

    public function save_custom_setting() {
        if (isset($_POST['color_swatches_enable'])) {
            update_option('color_swatches_enable', 'yes');
        } else {
            update_option('color_swatches_enable', 'no');
        }
    }

    public function is_variation_display_enabled() {
        return get_option('color_swatches_enable', 'no') === 'yes';
    }

    public function validate_sanitize_color($color) {
        // Define the allowed color values or patterns
        $allowed_colors = apply_filters('color_swatches_allowed_colors', array('color-1', 'color-2', 'color-3'));

        // Check if the given color is in the allowed list
        if (in_array($color, $allowed_colors)) {
            return $color;
        }

        // If the color is not in the allowed list, use a default color
        return 'default-color';
    }

    public function validate_sanitize_size($size) {
        // Define the allowed size values or patterns
        $allowed_sizes = apply_filters('color_swatches_allowed_sizes', array('small', 'medium', 'large'));

        // Check if the given size is in the allowed list
        if (in_array($size, $allowed_sizes)) {
            return $size;
        }

        // If the size is not in the allowed list, use a default size
        return 'default-size';
    }

}