<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

 $context = Timber::get_context();
 
 $context['post']    = Timber::get_post();
 $product            = wc_get_product( $context['post']->ID );
 $context['product'] = $product;
 
 // Get related products
 $related_limit               = wc_get_loop_prop( 'columns' );
 $related_ids                 = wc_get_related_products( $context['post']->id, $related_limit );
 $upsell_ids = $product->get_upsells();
 $context['up_sells'] =  Timber::get_posts( $upsell_ids );

Timber::render(  'up-sells.twig' , $context );
