<?php
/**
* Shop Filters
*
* @package Ubiquitous_Waddle
*/

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
function sub_cats_for_filters($term_id) {
  $subs_cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => $term_id,
  );
  return get_terms($subs_cats_args);
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
// add query arg link for product_cats in filters & escape the url
function add_query_arg_product_cats_for_filters($cat_slug) {
  // set the query arg url for product_cat from the product_cat->slug, removing _pjax
  $query_arg_product_cats_args = array(
    'product_cat' => $cat_slug,
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
    $new_path = remove_query_arg($arr_params = array( 'product_cat'));
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
      $new_path = remove_query_arg($arr_params = array( 'product_cat'));
    }   
  };
  // return the new path
  return esc_url($new_path);  
}

// check if is product-series via uri paramaters
function is_product_cat() {
  $current_url_page_path = strtok($_SERVER["REQUEST_URI"], '?'); 
  $cat_key_value = 'product-category';
  $found_in_path = strpos_recursive($current_url_page_path, $cat_key_value);
  if($found_in_path) {
    return true;
  };
}