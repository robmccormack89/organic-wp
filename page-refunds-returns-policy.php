<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package 
 */

$context = Timber::get_context();
$context['post'] = new Timber\Post();

Timber::render(  'refunds-returns-policy.twig' , $context );