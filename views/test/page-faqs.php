<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package 
 */

$context = Timber::get_context();


Timber::render(  'faqs.twig' , $context );