<?php
/**
 * Theme functions & bits
 *
 * @package Organic_Theme
 */
 
// check to see if page is a paginated page
function is_paginated() {
   global $wp_query;
   if ( $wp_query->max_num_pages > 1 ) {
       return true;
   } else {
       return false;
   }
}

// Remove pages from search results
function exclude_pages_from_search($query) {
  
    if ( $query->is_main_query() && is_search() ) {
        $query->set( 'post_type', 'product' );
    }
    return $query;
}
add_filter( 'pre_get_posts','exclude_pages_from_search' );

// add custom url paramater key
function custom_query_vars_filter($vars) {
    $vars[] .= 'grid-list';
    return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

// change the yoast breadcrumb seo separator
function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
    return '<i class="fas fa-angle-right fa-xs uk-padding-small uk-padding-remove-vertical"></i>';
};
// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'organic_theme_register_required_plugins');

function organic_theme_register_required_plugins() {
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