<?php
/**
 * Theme functions & bits
 *
 * @package Organic_Theme
 */
 
 //ajax search
function new_ajax_search() {

  $data = array(
    'result' => 0,
    'response' => ''
  );
  
  $query = $_POST['query'];
  $query_string_upper = ucwords($query);

  if (!empty($query)) {

    $data['result'] = 1;

    $cat_args = array(
      'fields' => 'all',
      'name__like' => $query, 
    );
    $product_categories = get_terms( 'product_cat', $cat_args );

    $products = wc_get_products( array(
      'status' => 'publish',
      'limit' => -1,
      'search_term' => $query,
      'meta_query' => array(
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        ),
      )
    ));
    
    $matching_terms = get_terms( array(
      'taxonomy' => 'product_cat',
      'fields' => 'slugs',
      'name__like' => $query, 
    ));
    $products_in_cat_args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'orderby' => 'title',
      'meta_query' => array(
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        ),
      ),
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          'terms' => $matching_terms
        ),
      ),
    );
    $products_in_cat = new Timber\PostQuery($products_in_cat_args);

    if (!empty($product_categories) || !empty($products) || !empty($products_in_cat) ) {

      $response = '<ul class="">';

      if (!empty($product_categories)) {
        foreach ($product_categories as $product_cateory) {
          $response .= '<li><a class="uk-link-text" href="' . get_term_link($product_cateory) . '">' . $product_cateory->name . ' <span class="uk-text-meta ajax-search-meta">Category</span></a></li>';
        }
      }

      if (!empty($products)) {
        foreach ($products as $product) {
          $response .= '<li><a class="uk-link-text" href="' . get_permalink($product->id) . '">' . $product->name . ' <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
        }
      }
      
      if (!empty($products_in_cat)) {
        foreach ($products_in_cat as $product_in_cat) {
          $response .= '<li><a class="uk-link-text" href="' . get_permalink($product_in_cat->id) . '">' . $product_in_cat->title . ' ('.$query_string_upper.') <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
        }
      }

      $response .= '</ul>';

    }

    $data['response'] = $response;

  }

  echo json_encode($data);

  die();
}
add_action( 'wp_ajax_new_ajax_search', 'new_ajax_search' );
add_action( 'wp_ajax_nopriv_new_ajax_search', 'new_ajax_search' );

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
function limit_searches_to_products($query) {
  
    if ( $query->is_main_query() && is_search() ) {
        $query->set( 'post_type', 'product' );
    }
    return $query;
}
add_filter( 'pre_get_posts','limit_searches_to_products' );

// Add support for 'search_term' query var (Add to functions file)
function support_search_term_query_var( $query, $query_vars ) {
    if( empty( $query_vars['search_term'] ) ) {
        return $query;
    }

    $query['s'] = $query_vars['search_term'];
    return $query;
 }
 add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'support_search_term_query_var', 10, 2 );

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
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

// register the required plugins. see TGM Plugin activation library for php
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
add_action('tgmpa_register', 'organic_theme_register_required_plugins');