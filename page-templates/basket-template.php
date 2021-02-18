<?php
/**
 * Template Name: Basket Page Template
 *
 * @package Ubiquitous_Waddle
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'basket.twig' , $context );