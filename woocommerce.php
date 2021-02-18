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
  
  // get the main post object
  $context['post'] = Timber::query_post();
  // get the product object via the post object id
  $product = wc_get_product($context['post']->ID);
  // set the product object as variable
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

  // get the main posts query
  $posts = new Timber\PostQuery();
  // set main query as products cariable 
  $context['products'] = $posts;
  // main template for woo archives is woo-archive
  $templates = array( 'shop.twig' );
  // main tease template
  $tease_template = array('tease-product.twig');
  
  // set the woo archive columns setting
  $context['columns'] = wc_get_loop_prop('columns');
  // set the woo archive products per page setting
  $context['cols'] = wc_get_loop_prop('per_page');

  // get grid_list query var
  $grid_list_query_var = get_query_var('grid_list');
  // set grid-list button's active classes
  $context['list_active_class'] = 'not-active';
  $context['grid_active_class'] = 'uk-active'; 

  $context['add_query_arg_list_view'] = add_query_arg_list_view_for_filters();
  $context['add_query_arg_grid_view'] = add_query_arg_grid_view_for_filters();
  
  // get the parent product_cats to build the product cats filters: theme-functions.php
  $context['product_cats_for_filters'] = product_cats_for_filters();
  // get the current product_cat query var: theme-functions.php
  $context['product_cat_var_exists'] = current_product_cat_var();
  $context['product_cat_var'] = get_query_var ('product_cat', '');
  // get the current product orderby query var: theme-functions.php
  $context['product_sort_var_exists'] = current_product_orderby_var();
  $context['product_sort_var'] = get_query_var ('orderby', '');
  // get the current product orderby query var: theme-functions.php
  $context['product_gridlist_var_exists'] = current_product_gridlist_var();
  
  // if is list-view
  if ( $grid_list_query_var == 'list-view' ) {
    // reset grid-list button's active classes
    $context['grid_active_class'] = 'not-active';
    $context['list_active_class'] = 'uk-active';
    // reset the woo archive columns setting
    $context['columns'] = '1';
    // unshit the tease template variable with the new list tease template
  	array_unshift( $tease_template, 'tease-product-list.twig' );
  };
  
  $context['tease_template'] = $tease_template; 

  // if is product category archive
  if ( is_product_category() ) {
    // get the queried object
    $queried_object = get_queried_object();
    // get the term_id with the queried object
    $term_id = $queried_object->term_id;
    // get the category & set variable with get_term using the term id
    $context['category'] = get_term( $term_id, 'product_cat' );
    // set the archive title
    $context['title'] = single_term_title( '', false );
    // then Restore the context and loop back to the main query loop.
    
    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
    $image = wp_get_attachment_url( $thumbnail_id );
    $context['term_img'] = $image;
    
    wp_reset_postdata();
  };

  // if is main shop archive page
  if ( is_shop() ) {
    // set shop page archive title
    $context['title'] = 'Shop';
  };
  
  // render archive woo template with context
  Timber::render( $templates, $context );
}