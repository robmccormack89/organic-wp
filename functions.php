<?php
/**
* Organic Theme functions and definitions
*
* @package Organic_Theme
*/

// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/lib/class-tgm-plugin-activation.php';

// register the required plugins(Timber) see TGM Plugin activation library for php
function organic_theme_register_required_plugins() {
	$plugins = array(
    array(
      'name' => 'Timber',
      'slug' => 'timber-library',
      'required' => true
    ),
    array(
      'name' => 'WooCommerce',
      'slug' => 'woocommerce',
      'required' => true
    ),
		array(
      'name' => 'Advanced Custom Fields PRO',
      'slug' => 'advanced-custom-fields-pro',
      'required' => true
    )
  );
  $config  = array(
    'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '', // Default absolute path to bundled plugins.
    'menu' => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug' => 'themes.php', // Parent menu slug.
    'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices' => true, // Show admin notices or not.
    'dismissable' => true, // If false, a user cannot dismiss the nag message.
    'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false, // Automatically activate plugins after installation or not.
    'message' => '' // Message to output right before the plugins table.
  );
  tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'organic_theme_register_required_plugins');

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
		$product = wc_get_product( $post->ID );
	}
	// woo functions
	require get_template_directory() . '/inc/woo/woo-functions.php';
	// live product search
	require get_template_directory() . '/inc/woo/live-search.php';
	// shop filters
	require get_template_directory() . '/inc/woo/shop-filters.php';
}

// if ACF class exists, do some stuff
if ( class_exists( 'ACF' ) ) {
	require get_template_directory() . '/inc/acf/acf-functions.php';
}

// load the Custom Widget
require get_template_directory() . '/inc/widgets/uikit-html-widget.php';