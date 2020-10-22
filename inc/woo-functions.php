<?php
/**
 * Woo functions
 *
 * @package RMcC_Uikit_Starter
 */

// if woocommerce is activated, do this stuff, or not
 if ( class_exists( 'WooCommerce' ) ) {
   
   function get_login_form() {
 
     get_template_part( 'template-parts/form-login' );
 
   }
   add_action( 'woo_login_form', 'get_login_form' );
    
   // add list product price
   function get_list_product_price() {

     global $product;

     if ( $price_html = $product->get_price_html() ) :
     	
     	echo '<span class="price uk-margin-small-bottom" style="float: right">';
     	echo $price_html;
     	echo '</span>';
     	
     endif; 

   }
   add_action( 'list_product_price', 'get_list_product_price' );
   
   // add list product rating
   function get_list_product_rating() {

     global $product;

     if ( ! wc_review_ratings_enabled() ) {
     	return;
     }

     echo wc_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.

   }
   add_action( 'list_product_rating', 'get_list_product_rating' );
  
   // add list product add_to_cart
   function get_list_product_add_to_cart() {

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
   
   // Add custom mini cart
   function custom_mini_cart() {

     woocommerce_mini_cart();

   }
   add_action( 'custom_mini_cart', 'custom_mini_cart' );
   
   // ajax result count
   function cart_ajax_result_count() {

     echo '<span class="header-cart-count">';
     echo WC()->cart->get_cart_contents_count();
     echo '</span>';

   }
   add_action( 'cart_ajax_result_count', 'cart_ajax_result_count' );
   
   // ajax result count
   function cart_ajax_subtotal() {

     echo '<div class="subtotal-cart"><strong>' . esc_html__( 'Subtotal', 'woocommerce' ) . ':</strong>';
     echo WC()->cart->get_cart_subtotal();
     echo '</div>';

   }
   add_action( 'cart_ajax_subtotal', 'cart_ajax_subtotal' );
   
   // custom single product sales flash
   function custom_sales_flash() {

     global $post, $product;

     if ( $product->is_on_sale() ) :

       echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale uk-card-badge uk-label">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product );

     endif;

   }
   add_action( 'custom_sales_flash', 'custom_sales_flash' );
   

   
 }
   
