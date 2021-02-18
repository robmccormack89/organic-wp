<?php
/**
 * Template Name: My Account Page Template
 *
 * @package Ubiquitous_Waddle
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'account.twig' , $context );