<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package 
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;

$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '-1',
   'orderby' => 'title',
   'post__not_in' => array(423),
   'tax_query'             => array(
       array(
           'taxonomy'      => 'product_cat',
           'terms'         => 30,
           'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
       ),
   )
);
$context['subscription_products'] = Timber::get_posts($args);

/* get product cats */
$shopcats = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'parent' => 0,
    'exclude' => array( 32 ),
) );
$context['shopcats'] = $shopcats;

$wc_options = get_option('woocommerce_permalinks');
$product_category_base = $wc_options['category_base'];
/* join the site url to product cat base */
$context['product_category_base'] = '/' . $product_category_base . '';

Timber::render(  'front-page.twig' , $context );