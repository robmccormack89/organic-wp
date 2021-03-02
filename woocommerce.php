<?php
/**
 * The template for making woocommerce work with timber/twig. sets the templates & context for woo's archive & singular views
 *
 * @package Organic_Theme
 */

// make sure timber is activated first
if (!class_exists('Timber')) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

// get the main context
$context = Timber::context();

// if is single product
if ( is_singular('product') ) {
  
  // main object
  $context['post'] = Timber::query_post();
  $product = wc_get_product($context['post']->ID);
  $context['product'] = $product;
  
  // gets shipping class & sets variable
  $context['shipping_class'] = $product->get_shipping_class();
  
  // Get related products
  $related_limit = wc_get_loop_prop('per_page');
  $related_ids = wc_get_related_products( $context['post']->id, 12 );
  $context['related_products_title'] = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );
  $context['related_products'] = Timber::get_posts( $related_ids );
  
  // Get upsells
  $upsell_ids = $product->get_upsell_ids();
  $context['up_sells_title'] = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );
  $context['up_sells'] =  Timber::get_posts( $upsell_ids );
  
  // Restore the context and loop back to the main query loop.
  wp_reset_postdata();
  
  // render singular woo template
  Timber::render( array( 'product-single-' . $post->post_name . '.twig', 'product-single-' . $product->get_type() . '.twig', 'product-single.twig' ), $context );
  
} else { // if is any other woo page, probably an archive

  $posts = new Timber\PostQuery();
  $context['products'] = $posts;
  
  // main & tease templates
  $templates = array( 'shop.twig' );
  $tease_template = array('tease-product.twig');
  
  // set the woo archive columns setting
  $context['products_grid_columns'] = wc_get_loop_prop('columns');
  
  // get query var product_cat
  $term_slug = get_query_var('product_cat');
  $context['the_term'] = get_term_by('slug', $term_slug, 'product_cat');
  
  // if is list-view
  if ( get_query_var('grid_list') == 'list-view' ) {
    // reset the woo archive columns setting
    $context['products_grid_columns'] = '1';
    // unshit the tease template variable with the new list tease template
  	array_unshift( $tease_template, 'tease-product-list.twig' );
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  $context['tease_template'] = $tease_template; 

  // if is product category archive
  if ( is_product_category() ) {
    // get the queried object
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['category'] = get_term( $term_id, 'product_cat' );
    // set the archive title
    $context['title'] = single_term_title( '', false );
    
    // if is actual product category archive (not ?product_cat query archive)
    if ( is_product_cat() ) {
      // get product category thumbnail
      $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
      $context['archive_header_bg'] = wp_get_attachment_url( $thumbnail_id );
    }
    
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // if is main shop archive page
  if ( is_shop() ) {
    // set shop page archive title
    $context['title'] = 'Shop';
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // render archive woo template with context
  Timber::render( $templates, $context );
}