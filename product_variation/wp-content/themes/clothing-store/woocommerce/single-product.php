<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
$clothing_store_wocommerce_single_page_sidebar = get_option( 'clothing_store_wocommerce_single_page_sidebar',false );
 if ( '1' == $clothing_store_wocommerce_single_page_sidebar ) {
   $clothing_store_colmd = 'col-lg-12 col-md-12';
 } else { 
   $clothing_store_colmd = 'col-lg-8 col-md-8';
 } 
?>

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
?>

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

?>


<main id="content">
	<div class="container">
		<div class="row m-0">
			<div class="<?php echo esc_html( $clothing_store_colmd ); ?>">
				<?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
				?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>
			</div>
			<?php if ( '1' != $clothing_store_wocommerce_single_page_sidebar ) {?>
			<div class="col-lg-4 col-md-4">
				<?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>
			</div>
		<?php } ?>
		</div>
	</div>
</main>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
