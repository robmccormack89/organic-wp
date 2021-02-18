<?php
/**
* Ajax Live Search functions
*
* @package Ubiquitous_Waddle
*/

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

function ajax_live_search_mobile() {

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
add_action( 'wp_ajax_ajax_live_search_mobile', 'ajax_live_search_mobile' );
add_action( 'wp_ajax_nopriv_ajax_live_search_mobile', 'ajax_live_search_mobile' );

// support 's' -> 'search_term' matching; for ajax_live_search
function support_search_term_query_var( $query, $query_vars ) {
  if( empty( $query_vars['search_term'] ) ) {
    return $query;
  }
  $query['s'] = $query_vars['search_term'];
  return $query;
}
add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'support_search_term_query_var', 10, 2 );