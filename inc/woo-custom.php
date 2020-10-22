<?php
/**
 * Woo custom
 *
 * @package RMcC_Uikit_Starter
 */

// if woocommerce is activated, do this stuff, or not
 if ( class_exists( 'WooCommerce' ) ) {
   
   
   
   
add_action( 'woocommerce_check_cart_items', 'required_min_cart_subtotal_amount' );
function required_min_cart_subtotal_amount() {
    // Only run in the Cart or Checkout pages
    if( is_cart() || is_checkout() ) {

        // HERE Set minimum cart total amount
        $min_total = 30;

        // Total (before taxes and shipping charges)
        $total = WC()->cart->subtotal;

        // Add an error notice is cart total is less than the minimum required
        if( $total <= $min_total  ) {
            // Display an error message
            wc_add_notice( '<strong>' . sprintf( __("A minimum total purchase amount of %s is required to checkout."), wc_price($min_total) ) . '</strong>', 'error' );
        }
    }
}
   
   
   
   
   add_action( 'woocommerce_reset_variations_link' , 'sd_change_clear_text', 15 );
   function sd_change_clear_text() {
      echo '<a class="reset_variations" href="#"><span uk-icon="refresh"></span></a>';
    
   }
   
   // remove woo scripts and styles selectively
   function theme_woo_script_styles() {
   	 remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
     wp_dequeue_style( 'woocommerce_frontend_styles' );
     wp_dequeue_style( 'woocommerce-general');
     wp_dequeue_style( 'woocommerce-layout' );
     wp_dequeue_style( 'woocommerce-smallscreen' );
     wp_dequeue_style( 'woocommerce_fancybox_styles' );
     wp_dequeue_style( 'woocommerce_chosen_styles' );
     wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
     // wp_dequeue_script( 'selectWoo' );
     // wp_deregister_script( 'selectWoo' );
     // wp_dequeue_script( 'select2' );
     // wp_deregister_script( 'select2' );
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
    *  moving / removing woocommerce actions
    */
   
   // archive
   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // reorder catalog in ProductToolbar from 3rd
   add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 ); // reorder catalog in ProductToolbar to 1st
   remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
   // remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30 );
   
   // tease product
   remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' ); // remove unnecessary link open html 
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' ); // remove unnecessary link close html 
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' ); // remove standard product image
   remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' ); // remove standard product title
   
   // single product
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 ); // remove upsells -TEMPORARY
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 ); // remove related -TEMPORARY
   add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 ); // remove upsells -TEMPORARY
   add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 ); // remove related -TEMPORARY
   remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
   
   // cart
   remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); // remove cross sells from cart page -TEMPORARY
   
   // general
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); // remove unnecessary wrapper div
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); // remove unnecessary wrapper div
   
   // woo notices
   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 ); // takes notices out of ProductToolbar
   remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 ); // takes notices out of ProductToolbar
   add_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 40 ); // put notices back here, where breadcrumbs are
   add_action( 'woocommerce_before_main_content', 'wc_print_notices', 50 ); // put notices back here, where breadcrumbs are
   
  


   /**
    * Using WooCommerce Filters
    */
    
    // filters the results count for ajax
    function iconic_cart_count_fragments( $fragments ) {
       $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
       return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
    
    
    
    // filters the results count for ajax
    function iconic_subtotal_fragments( $fragments ) {
       $fragments['div.subtotal-cart'] = '<div class="subtotal-cart"><strong>' . esc_html__( 'Subtotal', 'woocommerce' ) . ':</strong>' . WC()->cart->get_cart_subtotal() . '</div>';
       return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_subtotal_fragments', 10, 1 );
    

   
   // adding theme classes to woo checkout form elements via woocommerce_checkout_fields filter
   function theme_checkout_fields( $fields ) {
       $fields['billing']['billing_first_name']['class'] = array('uk-width-1-2');
       $fields['billing']['billing_last_name']['class'] = array('uk-width-1-2');
       $fields['billing']['billing_company']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_address_1']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_address_2']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_city']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_postcode']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_country']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_state']['class'] = array('uk-width-1-1');
       $fields['billing']['billing_email']['class'] = array('uk-width-1-2');
       $fields['billing']['billing_phone']['class'] = array('uk-width-1-2');
       $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
       $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
       $fields['billing']['billing_company']['placeholder'] = 'Company';
       $fields['billing']['billing_address_1']['placeholder'] = 'Street Address';
       $fields['billing']['billing_address_2']['placeholder'] = 'Address Additional';
       $fields['billing']['billing_city']['placeholder'] = 'City / Town';
       $fields['billing']['billing_postcode']['placeholder'] = 'Postcode';
       $fields['billing']['billing_email']['placeholder'] = 'Email Address';
       $fields['billing']['billing_phone']['placeholder'] = 'Phone No.';
       return $fields;
   }
   add_filter( 'woocommerce_checkout_fields' , 'theme_checkout_fields' );

   // adding theme classes to various woo form elements via woocommerce_form_field_args filter
   function wc_form_field_args( $args, $key, $value = null ) {
     switch ( $args['type'] ) {
         case "select" :  /* Targets all select input type elements, except the country and state select input types */
             $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
             $args['input_class'] = array('uk-select');
             //$args['custom_attributes']['data-plugin'] = 'select2';
             $args['label_class'] = array('uk-form-label');
             // $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
         break;
         case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
             $args['class'][] = 'form-group single-country';
             $args['label_class'] = array('uk-form-label');
             $args['input_class'] = array('uk-select');
         break;
         case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
             $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
             $args['input_class'] = array('uk-select');
             //$args['custom_attributes']['data-plugin'] = 'select2';
             $args['label_class'] = array('uk-form-label');
             $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
         break;
         case "password" :
         case "text" :
           $args['input_class'] = array('uk-input', 'uk-form-controls');
           $args['label_class'] = array('uk-form-label');
         break;
         case "email" :
           $args['input_class'] = array('uk-input');
           $args['label_class'] = array('uk-form-label');
         break;
         case "tel" :
           $args['input_class'] = array('uk-input');
           $args['label_class'] = array('uk-form-label');
         break;
         case "number" :
             $args['input_class'] = array('uk-input');
             $args['label_class'] = array('uk-form-label');
         break;
         case 'textarea' :
             $args['input_class'] = array('uk-textarea');
             $args['custom_attributes'] = array( 'rows' => '8'  );
             $args['label_class'] = array('uk-form-label');
         break;
         case 'checkbox' :
         break;
         case 'radio' :
         break;
         default :
             $args['class'][] = 'form-group';
             $args['input_class'] = array('form-control', 'input-lg');
             $args['label_class'] = array('control-label');
         break;
         }
         return $args;
   }
   add_filter('woocommerce_form_field_args','wc_form_field_args',10,3);

   
 }
   
