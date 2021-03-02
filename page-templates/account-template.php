<?php
/**
 * Template Name: My Account Page Template
 *
 * @package Organic_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'account.twig' , $context );