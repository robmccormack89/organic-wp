<?php
/**
* Theme functions & bits
*
* @package Organic_Theme
*/

// custom search queries, allows the use of multiple hidden filters on search.php
function SearchFilter($query) {
  $post_type = $_GET['post_type'];
  if (!$post_type) {
    $post_type = 'any';
  }
  if ($query->is_search) {
    $query->set('post_type', $post_type);
  };
  return $query;
}

// add post states for custome page templates
function ecs_add_post_state( $post_states, $post ) {
  
  if( get_post_meta($post->ID,'_wp_page_template',true) == 'page-templates/contact-template.php' ) {
		$post_states[] = 'Contact page';
	};
  
  if( get_post_meta($post->ID,'_wp_page_template',true) == 'page-templates/narrow-template.php' ) {
		$post_states[] = 'Narrow Template';
	};

	return $post_states;
}
add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );
 
// filter for yoast breadcrumb seo separator
function organic_filter_yoast_breadcrumb_separator($this_options_breadcrumbs_sep)
{
  return '<i class="fas fa-angle-right fa-xs uk-padding-small uk-padding-remove-vertical"></i>';
}
add_filter('wpseo_breadcrumb_separator','organic_filter_yoast_breadcrumb_separator', 10, 1);