<?php
/**
 * Template Name: Contact Page Template
 *
 * @package Organic_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'contact.twig' , $context );