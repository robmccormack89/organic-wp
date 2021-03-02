<?php
/**
 * Woo functions
 *
 * @package RMcC_Uikit_Starter
*/

// Purchase now requires a minimum total purchase amount (30euro)
function required_min_cart_subtotal_amount()
{  
  // Only run in the Cart or Checkout pages
  if( is_cart() || is_checkout() ) {
    // HERE Set minimum cart total amount
    $min_total = 30;
    // Total (before taxes and shipping charges)
    $total = WC()->cart->subtotal;
    // Add an error notice is cart total is less than the minimum required
    if( $total <= $min_total  ) {
      // Display an error message
      wc_add_notice( '<p class="uk-text-danger">' . sprintf( __("A minimum total purchase amount of %s is required to checkout."), wc_price($min_total) ) . '</p>', 'error' );
    }
  }  
}
add_action( 'woocommerce_check_cart_items', 'required_min_cart_subtotal_amount' );

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

/**
 * Woo actions
*/

function monarch_checkout_message()
{
  echo '<div class="uk-background-muted padding-10">To avail of our local delivery option, dont forget to enter your eircode in the shipping calulator below by clicking change address. Delivery limited to n91 & c15 eircodes</div>';
}
add_action('woocommerce_before_cart_contents', 'monarch_checkout_message');

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