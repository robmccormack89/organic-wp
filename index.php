<?php
/**
 * The main template file
 *
 * @package Organic_Theme
 */
 
$context = Timber::context();

$context['posts'] = new Timber\PostQuery();

$post = new Timber\Post();
if ( is_home() && is_front_page() ) {
	$context['title'] =  get_bloginfo( 'name' );
} else {
	$context['title'] =  get_the_title( $post->ID );
};

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

Timber::render( 'index.twig', $context );