<?php
/**
 * The search
 *
 * @package Organic_Theme
 */

$context = Timber::get_context();

  $context['title'] = 'You have searched for - '. get_search_query();
  $posts = Timber::get_posts();
  $context['products'] = $posts;
  $context['pagination'] = Timber::get_pagination();
  $context['paged'] = $paged;

Timber::render( 'woo-archive.twig', $context );