<?php
/**
 * Theme functions & bits
 *
 * @package Organic_Theme
 */

function organic_theme_setup()
{
  // theme support for title tag
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('post-formats', array(
      'gallery',
      'quote',
      'video',
      'aside',
      'image',
      'link'
  ));
  add_theme_support('align-wide');
  add_theme_support('responsive-embeds');
  add_theme_support('woocommerce');

  // Switch default core markup for search form, comment form, and comments to output valid HTML5.
  add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
  ));

  // Add support for core custom logo.
  add_theme_support('custom-logo', array(
      'height' => 30,
      'width' => 261,
      'flex-width' => true,
      'flex-height' => true
  ));


  // add custom thumbs sizes.
  add_image_size('organic-theme-featured-image-archive', 800, 300, true);
  add_image_size('organic-theme-woocommerce', 600, 600, true);
  add_image_size('organic-theme-woo-archive-grid', 260, 260, true);
  add_image_size('organic-theme-cart-image', 80, 80, true);
  
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
  
}
add_action('after_setup_theme', 'organic_theme_setup');


// Remove pages from search results
function exclude_pages_from_search($query) {
    if ( $query->is_main_query() && is_search() ) {
        $query->set( 'post_type', 'product' );
    }
    return $query;
}
add_filter( 'pre_get_posts','exclude_pages_from_search' );

function is_paginated() {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        return true;
    } else {
        return false;
    }
}

// add custom url paramater key
function custom_query_vars_filter($vars) {
  $vars[] .= 'grid_list';
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );



// UNSET A SHIPPING METHOD FOR PACKAGE BASED ON THE SHIPPING CLASS(es) OF ITS CONTENTS
add_filter( 'woocommerce_package_rates', 'hide_shipping_method_based_on_shipping_class', 10, 2 );
function hide_shipping_method_based_on_shipping_class( $rates, $package )
{
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    foreach( $package['contents'] as $package_item ){ // Look at the shipping class of each item in package

        $product_id = $package_item['product_id']; // Grab product_id
        $_product   = wc_get_product( $product_id ); // Get product info using that id

        if( $_product->get_shipping_class_id() == 56 ){ // If we DO find this shipping class ID
            unset($rates['flat_rate:13']); // Then remove this shipping method
            break; // Stop the loop, since we've already removed the shipping method from this package
        }
    }
    return $rates;
}

// theme assets
function organic_theme_enqueue_assets() {
  
  wp_enqueue_style('organic-theme-css', get_template_directory_uri() . '/assets/css/base.css');
  wp_enqueue_script('organic-theme-js', get_template_directory_uri() . '/assets/js/main/main.js', '', '', false);
  wp_enqueue_style('organic-theme-styles', get_stylesheet_uri());
  
}
add_action('wp_enqueue_scripts', 'organic_theme_enqueue_assets'); 



function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
    return '<i class="fas fa-angle-right fa-xs uk-padding-small uk-padding-remove-vertical"></i>';
};
// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);



// regisers custom widget
function organic_custom_uikit_widgets_init() {
  register_widget("Organic_Theme_Custom_UIKIT_Widget_Class");
}
add_action("widgets_init", "organic_custom_uikit_widgets_init");




// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'organic_theme_register_required_plugins');

function organic_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'Timber',
            'slug' => 'timber-library',
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