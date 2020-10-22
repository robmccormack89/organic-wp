<?php
/**
 * The default template for displaying all single posts
 *
 * @package Organic_Theme
 */

$context = Timber::get_context();
$context['post'] = new Timber\Post();
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;


if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single-' . $post->slug . '.twig', 'single.twig' ), $context );
}