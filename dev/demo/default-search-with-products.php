<?php

/**
 * The search - search.php, default search renders with woo templates
 *
 * @package Organic_Theme
 */

$context = Timber::context();

$context['title'] = 'You have searched for - '. get_search_query();

$posts = new Timber\PostQuery();
$context['products'] = $posts;
  
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

$context['list_active_class'] = 'not-active';
$context['grid_active_class'] = 'uk-active'; 
$context['grid_list_layout_class'] = 'uk-child-width-1-5@m';
$context['tease_template'] = 'tease-product.twig';    

Timber::render( 'woo-archive.twig', $context );

// Limit default searches to products, theme-functions.php
function organic_products_only_search($query)
{
  if ( $query->is_main_query() && is_search() ) {
    $query->set( 'post_type', 'product' );
  }
  return $query;
}
add_filter('pre_get_posts', 'organic_products_only_search');

?>

<div id="SimpleSearchForm" class="uk-navbar-item height-content pull-right-30" data-template="header-main-search.twig">
  <form role="search" method="get" action="{{site.url}}">
    <div class="uk-inline uk-light">
      <a class="uk-form-icon uk-form-icon-flip uk-link-reset"><i class="fas fa-search fa-lg"></i></a>
      <input class="uk-input uk-form-width-medium mark-this-value" type="text" placeholder="Search for products" id="SearchDesktop" name="s" autocomplete="off">
    </div>
  </form>
</div>