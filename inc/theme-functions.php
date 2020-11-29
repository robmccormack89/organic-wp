<?php
/**
* Theme functions & bits
*
* @package Organic_Theme
*/

function editor_settings( $settings ) {
  
  global $post_type;
  
  if ( $post_type == 'slide' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  if ( $post_type == 'mega_menu' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  return $settings;
}

add_filter( 'wp_editor_settings', 'editor_settings' );

/* add options page in backend via acf */;
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// helper function: finding strings; see below
function strpos_recursive($haystack, $needle, $offset = 0, &$results = array()) {
  $offset = strpos($haystack, $needle, $offset);
  if($offset === false) {
    return $results;           
  } else {
    $results[] = $offset;
    return strpos_recursive($haystack, $needle, ($offset + 1), $results);
  }
}
// get the product cat filters -> woocommerce.php
function product_cats_for_filters() {
  $cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => 0,
  );
  return get_terms($cats_args);
}
// check to see if product cat has children
function product_cat_has_children($term_id) { 
  if ( count( get_term_children( $term_id, 'product_cat' ) ) > 0 ) {
    return true;
  } else {
    return false;
  };
};
// get the sub product_cat filters based on parent term_id
function subs_product_cats_for_filters($term_id) {
  $subs_cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => $term_id,
  );
  return get_terms($subs_cats_args);
}
// add query arg link for product_cats in filters & escape the url
function add_query_arg_product_cats_for_filters($cat_slug) {
  // set the query arg url for product_cat from the product_cat->slug, removing _pjax
  $query_arg_product_cats_args = array(
    'product_cat' => $cat_slug,
    '_pjax' => false,
  );
  $the_url = add_query_arg($query_arg_product_cats_args);
  // parse the url into an array
  $parsed_url = wp_parse_url($the_url);
  // get the page path from the array
  $url_path = $parsed_url['path'];
  // the value we will use to search for in string
  $key_value = 'category'; 
  // find key_value string in the page path
  $found = strpos_recursive($url_path, $key_value);
  // if the 'category' exists in the current page path
  if($found) {
    // before new path
    $new_path = '/shop';
    // remove the current url page path from url string & set new path
    $new_path .= str_replace($url_path,'/',$the_url);
  } else {
    // if 'category' doesnt exist in current page url, set the add_query_arg url to the default state abouve
    $new_path = $the_url;
  }
  // return the new path
  return esc_url($new_path);
}
// add query arg link for product_cats in filters & escape the url
function remove_query_arg_product_cats_for_filters() {
  // get the current gloabl url with paths & parameters
  global $wp;
  $current_url = home_url( add_query_arg( array(), $wp->request ) );
  // get the current page path
  $current_url_page_path = $_SERVER['REQUEST_URI'];
  // get the current query string
  $current_url_query_string = $_SERVER['QUERY_STRING'];
  // if query_string exists
  if (!empty($current_url_query_string)) {
    // set link for reset filters; removes product_cat & _pjax from link
    $new_path = remove_query_arg($arr_params = array( 'product_cat', '_pjax'));
  };
  // if page path exists
  if (!empty($current_url_page_path)) {
    // current page path to be striped of last /
    $fixed_path = $current_url_page_path;
    // stripping last /
    $fixed_path = substr_replace($fixed_path, '', strrpos($fixed_path, '/'), 1);
    // 'category' is again our search key
    $key_value = 'category'; 
    // find 'category' string in the page path
    $found = strpos_recursive($current_url_page_path, $key_value);
    // if the 'category' exists in the current page path
    if($found) {
      // rebuild the remove query arg link removing product-category path from it
      $new_path = str_replace($fixed_path,'/shop',$current_url);
    } else {
      $new_path = remove_query_arg($arr_params = array( 'product_cat', '_pjax'));
    }   
  };
  // return the new path
  return esc_url($new_path);  
}
// get the current product_cat query var; check if isset first -> woocommerce.php
function current_product_cat_var() {
  if (isset($_GET['product_cat'])) {
    return $_GET['product_cat'];
  }
};
// get the current product orderby query var; check if isset first -> woocommerce.php
function current_product_orderby_var() {
  if (isset($_GET['orderby'])) {
    return $_GET['orderby'];
  }
};
// get the current grid_list query var; check if isset first -> woocommerce.php
function current_product_gridlist_var() {
  if (isset($_GET['grid_list'])) {
    return $_GET['grid_list'];
  }
};
// add query arg for grid view filter
function add_query_arg_grid_view_for_filters(){
  $args = array(
    'grid_list' => 'grid-view',
    '_pjax' => false,
  );
  return esc_url(add_query_arg($args));
};
// add query arg for list view filter
function add_query_arg_list_view_for_filters(){
  $args = array(
    'grid_list' => 'list-view',
    '_pjax' => false,
  );
  return esc_url(add_query_arg($args));
};
// custom search queries, allows the use of multiple hidden filters on search.php
function SearchFilter($query) {
  $post_type = $_GET['post_type'];
  if (!$post_type) {
    $post_type = 'any';
  }
  if ($query->is_search) {
    $query->set('post_type', $post_type);
  };
  return $query;
}
// ajax search php, theme-functions.php
function ajax_live_search() {

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
add_action( 'wp_ajax_ajax_live_search', 'ajax_live_search' );
add_action( 'wp_ajax_nopriv_ajax_live_search', 'ajax_live_search' );
// support 's' -> 'search_term' matching; for ajax_live_search
function support_search_term_query_var( $query, $query_vars ) {
  if( empty( $query_vars['search_term'] ) ) {
    return $query;
  }
  $query['s'] = $query_vars['search_term'];
  return $query;
 }
 add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'support_search_term_query_var', 10, 2 );
// filter for yoast breadcrumb seo separator
function organic_filter_yoast_breadcrumb_separator($this_options_breadcrumbs_sep)
{
  return '<i class="fas fa-angle-right fa-xs uk-padding-small uk-padding-remove-vertical"></i>';
}
add_filter('wpseo_breadcrumb_separator','organic_filter_yoast_breadcrumb_separator', 10, 1);
// register the required plugins(Timber) see TGM Plugin activation library for php
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