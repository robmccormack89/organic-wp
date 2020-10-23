<?php
/**
 * The search
 *
 * @package Organic_Theme
 */

$context = Timber::context();

$context['title'] = 'You have searched for - '. get_search_query();

$posts = new Timber\PostQuery();
$context['products'] = $posts;
  
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

$context['list_active_class'] = 'not-active';
$context['grid_active_class'] = 'uk-active'; 
$context['grid_list_layout_class'] = 'uk-child-width-1-5@m';
$context['tease_template'] = 'tease-product.twig';    

Timber::render( 'woo-archive.twig', $context );