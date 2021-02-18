<?php
/**
 * Template Name: Narrow Template
 *
 * @package Ubiquitous_Waddle
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'narrow.twig' , $context );