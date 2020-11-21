<?php
/**
 * The template for making woocommerce work with timber/twig. sets the templates & context for woo's archive & singular views
 *
 * @package Organic_Theme
 */

// make sure timber is activated first
if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

// get the main context
$context = Timber::context();
// get the shop sidebar widgets
$context['sidebar'] = Timber::get_widgets( 'shop-sidebar' );

// if is single product
if ( is_singular( 'product' ) ) {
  
    // get the main post object
    $context['post'] = Timber::query_post();
    // get the product object via the post object id
    $product = wc_get_product( $context['post']->ID );
    // set the product object as variable
    $context['product'] = $product;
    // gets shipping class & sets variable
    $context['shipping_class'] = $product->get_shipping_class();
    // Restore the context and loop back to the main query loop.
    wp_reset_postdata();
    // render singular woo template
    Timber::render( 'woo-single.twig', $context );
    
} else {
  
    // get the main posts query
    $posts = new Timber\PostQuery();
    // set main query as products cariable 
    $context['products'] = $posts;

    // if is product category archive
    if ( is_product_category() ) {
        // get the queried object
        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        // get the category term
        $context['category'] = get_term( $term_id, 'product_cat' );
        // and set the archive title
        $context['title'] = single_term_title( '', false );
        // then Restore the context and loop back to the main query loop.
        wp_reset_postdata();
    };
    
    // if is shop page
    if ( is_shop() ) {
        // set shop page archive title
        $context['title'] = 'Shop';
    };

    // render archive woo template
    Timber::render( 'woo-archive.twig', $context );
}