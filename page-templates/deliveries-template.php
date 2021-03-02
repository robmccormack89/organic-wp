<?php
/**
 * Template Name: Deliveries Template
 *
 * @package Organic_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'deliveries.twig' , $context );