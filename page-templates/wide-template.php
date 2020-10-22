<?php
/**
 * Template Name: Wide Template
 *
 * @package Organic_Theme
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'wide-template.twig' , $context );