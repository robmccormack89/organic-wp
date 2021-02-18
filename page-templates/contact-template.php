<?php
/**
 * Template Name: Contact Page Template
 *
 * @package Ubiquitous_Waddle
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'contact.twig' , $context );