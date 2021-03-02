<?php
/**
 * Template Name: Narrow Template
 *
 * @package Organic_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'narrow.twig' , $context );