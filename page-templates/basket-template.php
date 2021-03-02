<?php
/**
 * Template Name: Basket Page Template
 *
 * @package Organic_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'basket.twig' , $context );