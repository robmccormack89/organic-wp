<?php
/**
 * Woo functions
 *
 * @package RMcC_Uikit_Starter
*/

// remove woo scripts and styles selectively
function theme_woo_script_styles()
{
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
  wp_dequeue_style( 'woocommerce_frontend_styles' );
  wp_dequeue_style( 'woocommerce-general');
  wp_dequeue_style( 'woocommerce-layout' );
  wp_dequeue_style( 'woocommerce-smallscreen' );
  wp_dequeue_style( 'woocommerce_fancybox_styles' );
  wp_dequeue_style( 'woocommerce_chosen_styles' );
  wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
  wp_dequeue_script( 'selectWoo' );
  wp_deregister_script( 'selectWoo' );
  wp_dequeue_script( 'select2' );
  wp_deregister_script( 'select2' );
  // wp_dequeue_script( 'wc-add-payment-method' );
  // wp_dequeue_script( 'wc-lost-password' );
  // wp_dequeue_script( 'wc_price_slider' );
  // wp_dequeue_script( 'wc-single-product' );
  // wp_dequeue_script( 'flexslider' );
  // wp_dequeue_script( 'zoom' );
  // wp_dequeue_script( 'wc-add-to-cart' );
  // wp_dequeue_script( 'wc-cart-fragments' );
  // wp_dequeue_script( 'wc-credit-card-form' );
  // wp_dequeue_script( 'wc-checkout' );
  // wp_dequeue_script( 'wc-add-to-cart-variation' );
  // wp_dequeue_script( 'wc-single-product' );
  // wp_dequeue_script( 'wc-cart' );
  // wp_dequeue_script( 'wc-chosen' );
  // wp_dequeue_script( 'woocommerce' );
  // wp_dequeue_script( 'prettyPhoto' );
  // wp_dequeue_script( 'prettyPhoto-init' );
  // wp_dequeue_script( 'jquery-blockui' );
  // wp_dequeue_script( 'jquery-placeholder' );
  // wp_dequeue_script( 'jquery-payment' );
  // wp_dequeue_script( 'fancybox' );
  // wp_dequeue_script( 'jqueryui' );
}
add_action( 'wp_enqueue_scripts', 'theme_woo_script_styles', 99 );

/**
 * Woo filters
*/

// filters the header cart's items count html via woocommerce_add_to_cart_fragments
function theme_cart_count_fragments( $fragments )
{
  $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'theme_cart_count_fragments', 10, 1 );

// filters the header cart's subtotal html via woocommerce_add_to_cart_fragments
function theme_subtotal_fragments( $fragments )
{
  $fragments['div.subtotal-cart'] = '<div class="subtotal-cart"><strong>' . esc_html__( 'Subtotal', 'woocommerce' ) . ':</strong>' . WC()->cart->get_cart_subtotal() . '</div>';
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'theme_subtotal_fragments', 10, 1 );

function custom_filter_wc_cart_item_remove_link( $sprintf, $cart_item_key ) {
  if ( is_admin() && ! defined( 'DOING_AJAX' ) )
  return $sprintf;
  $sprintf = str_replace('&times;', '<i class="fas fa-times"></i>', $sprintf);
  return $sprintf;
};
add_filter( 'woocommerce_cart_item_remove_link', 'custom_filter_wc_cart_item_remove_link', 10, 2 );

// // adding theme classes to woo checkout form elements via woocommerce_checkout_fields filter
// function theme_checkout_fields( $fields )
// {
//   $fields['billing']['billing_first_name']['class'] = array('uk-width-1-2');
//   $fields['billing']['billing_last_name']['class'] = array('uk-width-1-2');
//   $fields['billing']['billing_company']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_address_1']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_address_2']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_city']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_postcode']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_country']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_state']['class'] = array('uk-width-1-1');
//   $fields['billing']['billing_email']['class'] = array('uk-width-1-2');
//   $fields['billing']['billing_phone']['class'] = array('uk-width-1-2');
//   $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
//   $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
//   $fields['billing']['billing_company']['placeholder'] = 'Company';
//   $fields['billing']['billing_address_1']['placeholder'] = 'Street Address';
//   $fields['billing']['billing_address_2']['placeholder'] = 'Address Additional';
//   $fields['billing']['billing_city']['placeholder'] = 'City / Town';
//   $fields['billing']['billing_postcode']['placeholder'] = 'Postcode';
//   $fields['billing']['billing_email']['placeholder'] = 'Email Address';
//   $fields['billing']['billing_phone']['placeholder'] = 'Phone No.';
//   return $fields;
// }
// add_filter( 'woocommerce_checkout_fields' , 'theme_checkout_fields' );
// 
// // adding theme classes to various woo form elements via woocommerce_form_field_args filter
// function theme_woo_form_field_args( $args, $key, $value = null )
// {
//   switch ( $args['type'] ) {
// 
//   case "select" :  /* Targets all select input type elements, except the country and state select input types */
//     $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
//     $args['input_class'] = array('uk-select');
//     //$args['custom_attributes']['data-plugin'] = 'select2';
//     $args['label_class'] = array('uk-form-label');
//     // $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
//   break;
// 
//   case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
//     $args['class'][] = 'form-group single-country';
//     $args['label_class'] = array('uk-form-label');
//     $args['input_class'] = array('uk-select');
//   break;
// 
//   case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
//     $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
//     $args['input_class'] = array('uk-select');
//     //$args['custom_attributes']['data-plugin'] = 'select2';
//     $args['label_class'] = array('uk-form-label');
//     $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
//   break;
// 
//   case "password" :
// 
//   case "text" :
//     $args['input_class'] = array('uk-input', 'uk-form-controls');
//     $args['label_class'] = array('uk-form-label');
//   break;
// 
//   case "email" :
//     $args['input_class'] = array('uk-input');
//     $args['label_class'] = array('uk-form-label');
//   break;
// 
//   case "tel" :
//     $args['input_class'] = array('uk-input');
//     $args['label_class'] = array('uk-form-label');
//   break;
// 
//   case "number" :
//     $args['input_class'] = array('uk-input');
//     $args['label_class'] = array('uk-form-label');
//   break;
// 
//   case 'textarea' :
//     $args['input_class'] = array('uk-textarea');
//     $args['custom_attributes'] = array( 'rows' => '8'  );
//     $args['label_class'] = array('uk-form-label');
//   break;
// 
//   case 'checkbox' :
//   break;
// 
//   case 'radio' :
//   break;
// 
//   default :
//     $args['class'][] = 'form-group';
//     $args['input_class'] = array('form-control', 'input-lg');
//     $args['label_class'] = array('control-label');
//   break;
// 
//   }
//   return $args;
// }
// add_filter('woocommerce_form_field_args','theme_woo_form_field_args',10,3);

/**
 * Woo actions
*/

// function monarch_checkout_message()
// {
//   echo '<div class=""><p><span class="uk-label uk-text-capitalize uk-text-bold">To avail of our delivery options, dont forget to enter your eircode in the shipping calulator below by clicking change address. Delivery limited to n91 & c15 eircodes</span></p></div>';
// }
// add_action('woocommerce_before_cart_contents', 'monarch_checkout_message');

// Purchase now requires a minimum total purchase amount (30euro)
// function required_min_cart_subtotal_amount()
// {
//   // Only run in the Cart or Checkout pages
//   if( is_cart() || is_checkout() ) {
//     // HERE Set minimum cart total amount
//     $min_total = 30;
//     // Total (before taxes and shipping charges)
//     $total = WC()->cart->subtotal;
//     // Add an error notice is cart total is less than the minimum required
//     if( $total < $min_total  ) {
//       // Display an error message
//       wc_add_notice( '<strong>' . sprintf( __("A minimum total purchase amount of %s is required to checkout."), wc_price($min_total) ) . '</strong>', 'error' );
//     }
//   }  
// }
// add_action( 'woocommerce_check_cart_items', 'required_min_cart_subtotal_amount' );

// changes the html for the the woo reset variations button
function woocommerce_reset_variations_link_new_html()
{
  echo '<a class="reset_variations" href="#"><i class="fas fa-redo"></i></a>';
}
add_action( 'woocommerce_reset_variations_link' , 'woocommerce_reset_variations_link_new_html', 15 );

// ajax result count
function cart_ajax_result_count()
{
  echo '<span class="header-cart-count">';
  echo WC()->cart->get_cart_contents_count();
  echo '</span>';
}
add_action( 'cart_ajax_result_count', 'cart_ajax_result_count' );

// ajax result count
function cart_ajax_subtotal()
{
  echo '<div class="subtotal-cart"><strong>' . esc_html__( 'Subtotal', 'woocommerce' ) . ':</strong>';
  echo WC()->cart->get_cart_subtotal();
  echo '</div>';
}
add_action( 'cart_ajax_subtotal', 'cart_ajax_subtotal' );

/**
 * Custom actions
*/

// Add custom mini cart
function custom_mini_cart()
{
  woocommerce_mini_cart();
}
add_action( 'custom_mini_cart', 'custom_mini_cart' );

// custom single product sales flash
function custom_sales_flash()
{
  global $post, $product;
  if ( $product->is_on_sale() ) :
  echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale uk-card-badge uk-label">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product );
  endif;
}
add_action( 'custom_sales_flash', 'custom_sales_flash' );

// add list product add_to_cart
function get_list_product_add_to_cart()
{
  global $product; 
  echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
  	sprintf( '<div><a href="%s" data-quantity="%s" class="uk-button uk-width-1-1 uk-button-primary %s" %s>%s</a></div>',
  		esc_url( $product->add_to_cart_url() ),
  		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
  		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
  		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
  		esc_html( $product->add_to_cart_text() )
  	),
  $product, $args );
}
add_action( 'list_product_add_to_cart', 'get_list_product_add_to_cart' );

// add list product price
function get_list_product_price()
{
  global $product;
  if ($price_html = $product->get_price_html()) :
  	echo '<span class="price uk-margin-small-bottom" style="float: right">';
  	echo $price_html;
  	echo '</span>';
  endif; 
}
add_action( 'list_product_price', 'get_list_product_price' );

// add list product rating
function get_list_product_rating()
{
  global $product;
  if ( ! wc_review_ratings_enabled() ) {
    return;
  }
  echo wc_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.
}
add_action( 'list_product_rating', 'get_list_product_rating' );

/**
 * Add/remove actions
*/

// remove cross sells from cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); // remove cross sells from cart page - TEMPORARY
// remove  woo shop toolbar pagination (archive)
remove_action( 'woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30 );
// archive
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); // remove woo breads
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); // remove woo wrapper div start
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); // remove woo wrapper div end
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
// reorder catalog in ProductToolbar from 3rd to 1st
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // unset catalog ordering
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 ); // and reset it as first
// reposition notices on archives
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 ); // take notices out of ProductToolbar
add_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 40 ); // and put theme back here, where breadcrumbs are
// tease
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' ); // remove unnecessary link open html 
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' ); // remove unnecessary link close html 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' ); // remove standard product image; we will do our own image with custom markup
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' ); // remove standard product title; we will do our own title with custom markup
// single product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );