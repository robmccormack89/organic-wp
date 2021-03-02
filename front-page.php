<?php
/**
* The custom template for page with slug 'home'
*
* @package 
*/

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;

// homepage product cats to show via acf options page
$home_product_categories_select_ids = get_field('homepage_product_category_selection', 'option');
// get product cats
$shopcats = get_terms( array(
    'taxonomy' => 'product_cat',
    'include' => $home_product_categories_select_ids,
));
$context['shopcats'] = $shopcats;

$context['homepage_product_category_columns'] = get_field('homepage_product_category_columns', 'option');
$context['homepage_product_category_section_title'] = get_field('homepage_product_category_section_title', 'option');

$wc_options = get_option('woocommerce_permalinks');
$product_category_base = $wc_options['category_base'];
// join the site url to product cat base
$context['product_category_base'] = '/' . $product_category_base . '';

// get some slides
$slides_args = array(
   'post_type' => 'slide',
   'post_status' => 'publish',
   // 'orderby' => 'date',
   // 'order' => 'asc',
);
$context['home_slides'] = new Timber\PostQuery($slides_args);

// homepage product to show via acf options page
$home_product_select_id = get_field('homepage_product_selection', 'option');
$context['product_select_shortcode_id'] = '[product_page id="'.$home_product_select_id.'"]';

// get some slides
$info_slides_args = array(
   'post_type' => 'info_slide',
   'post_status' => 'publish',
   // 'orderby' => 'date',
   // 'order' => 'asc',
);
$context['info_home_slides'] = new Timber\PostQuery($info_slides_args);

$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '8',
);
$context['recent_products'] = new Timber\PostQuery($args);

Timber::render(  'front-page.twig' , $context );