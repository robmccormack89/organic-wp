<?php
/**
 * Organic Theme functions and definitions
 *
 * @package Organic_Theme
*/

// load Theme functions
require get_template_directory() . '/inc/theme-functions.php';

// if Timber class exists, load timber functions
if( class_exists( 'Timber' ) ) {
		require get_template_directory() . '/inc/timber-functions.php';
}

// if Woo class exists, do some stuff
if ( class_exists( 'WooCommerce' ) ) {
		function timber_set_product( $post ) {
				global $product;
				
				if ( is_woocommerce() || is_search() || is_front_page() ) {
						$product = wc_get_product( $post->ID );
				}
		}
		// load woo functions
		require get_template_directory() . '/inc/woo-functions.php';
}

// load the Custom Widget
require get_template_directory() . '/widgets/uikit-html-widget.php';