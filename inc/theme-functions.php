<?php
/**
* Theme functions & bits
*
* @package Organic_Theme
*/

if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
  	'key' => 'group_5fc51ff79687a',
  	'title' => 'Home Banner Slides Fields',
  	'fields' => array(
  		array(
  			'key' => 'field_5fc52020bdb94',
  			'label' => 'Home Banner Slide Subtitle',
  			'name' => 'home_banner_slide_subtitle',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => 'Add the subtitle for the Banner Slide',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array(
  			'key' => 'field_5fc52053bdb95',
  			'label' => 'Home Banner Slide Button Text',
  			'name' => 'home_banner_slide_button_text',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => 'Add the text for the button in the Banner Slide',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array(
  			'key' => 'field_5fc52079bdb96',
  			'label' => 'Home Banner Slide Button Link',
  			'name' => 'home_banner_slide_button_link',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => 'Add the URL for the Banner Slide button',
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'slide',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));

  acf_add_local_field_group(array(
  	'key' => 'group_5fc412fb178ea',
  	'title' => 'Home Info Slides Fields',
  	'fields' => array(
  		array(
  			'key' => 'field_5fc4130fc8952',
  			'label' => 'Info Slide Icon HTML',
  			'name' => 'info_slide_icon_html',
  			'type' => 'textarea',
  			'instructions' => 'See https://fontawesome.com/icons?d=gallery for icon html examples.',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => 'Example: <i class="fas fa-hand-point-up fa-2x"></i>',
  			'maxlength' => '',
  			'rows' => 2,
  			'new_lines' => '',
  		),
  		array(
  			'key' => 'field_5fc414d618055',
  			'label' => 'Info Slide Link URL',
  			'name' => 'info_slide_link_url',
  			'type' => 'url',
  			'instructions' => 'Enter in the URL for a destination to send the info slide to',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '#',
  			'placeholder' => '',
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'info_slide',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));

  acf_add_local_field_group(array(
  	'key' => 'group_5fc3a43747544',
  	'title' => 'Mega Menu Fields',
  	'fields' => array(
  		array(
  			'key' => 'field_5fc3a45ebfc03',
  			'label' => 'Mega Menu',
  			'name' => 'mega_menu',
  			'type' => 'radio',
  			'instructions' => 'Select no if this item has regular dropdown items',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				'yes' => 'Yes',
  				'no' => 'No',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'default_value' => 'no',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  			'save_other_choice' => 0,
  		),
  		array(
  			'key' => 'field_5fc3d6c004f67',
  			'label' => 'Select Mega Menu',
  			'name' => 'select_mega_menu',
  			'type' => 'post_object',
  			'instructions' => 'Pick the Mega Menu to display under this menu item',
  			'required' => 1,
  			'conditional_logic' => array(
  				array(
  					array(
  						'field' => 'field_5fc3a45ebfc03',
  						'operator' => '==',
  						'value' => 'yes',
  					),
  				),
  			),
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'mega_menu',
  			),
  			'taxonomy' => '',
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'object',
  			'ui' => 1,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'nav_menu_item',
  				'operator' => '==',
  				'value' => 'location/main',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));

  acf_add_local_field_group(array(
  	'key' => 'group_5fc3ebf0d7bb9',
  	'title' => 'Site Settings',
  	'fields' => array(
  		array(
  			'key' => 'field_5fc3ec1c28779',
  			'label' => 'Homepage Settings',
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array(
  			'key' => 'field_5fc3ec732877b',
  			'label' => 'Homepage Product Selection',
  			'name' => 'homepage_product_selection',
  			'type' => 'post_object',
  			'instructions' => 'Pick the product (custom product box) to show on the Homepage',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array(
  				0 => 'product',
  			),
  			'taxonomy' => '',
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'id',
  			'ui' => 1,
  		),
  		array(
  			'key' => 'field_5fc41a5c8995f',
  			'label' => 'Homepage Product Category Section Title',
  			'name' => 'homepage_product_category_section_title',
  			'type' => 'text',
  			'instructions' => 'Enter a title to go to the top of the homepage product category section',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Shop by Category',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array(
  			'key' => 'field_5fc3ed22adf5d',
  			'label' => 'Homepage Product Category Selection',
  			'name' => 'homepage_product_category_selection',
  			'type' => 'taxonomy',
  			'instructions' => 'Pick the product categories to show on the Homepage',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'taxonomy' => 'product_cat',
  			'field_type' => 'multi_select',
  			'allow_null' => 0,
  			'add_term' => 0,
  			'save_terms' => 0,
  			'load_terms' => 0,
  			'return_format' => 'id',
  			'multiple' => 0,
  		),
  		array(
  			'key' => 'field_5fc418ec337fa',
  			'label' => 'Homepage Product Category Columns',
  			'name' => 'homepage_product_category_columns',
  			'type' => 'select',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array(
  				3 => '3',
  				4 => '4',
  				5 => '5',
  				6 => '6',
  			),
  			'default_value' => 3,
  			'allow_null' => 0,
  			'multiple' => 0,
  			'ui' => 0,
  			'return_format' => 'value',
  			'ajax' => 0,
  			'placeholder' => '',
  		),
  		array(
  			'key' => 'field_5fc3ecc02877c',
  			'label' => 'General Settings',
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array(
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  	),
  	'location' => array(
  		array(
  			array(
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'site-settings',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => true,
  	'description' => '',
  ));

endif;

function editor_settings( $settings ) {
  
  global $post_type;
  
  if ( $post_type == 'slide' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  if ( $post_type == 'mega_menu' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  return $settings;
}

add_filter( 'wp_editor_settings', 'editor_settings' );

/* add options page in backend via acf */;
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// helper function: finding strings; see below
function strpos_recursive($haystack, $needle, $offset = 0, &$results = array()) {
  $offset = strpos($haystack, $needle, $offset);
  if($offset === false) {
    return $results;           
  } else {
    $results[] = $offset;
    return strpos_recursive($haystack, $needle, ($offset + 1), $results);
  }
}
// get the product cat filters -> woocommerce.php
function product_cats_for_filters() {
  $cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => 0,
  );
  return get_terms($cats_args);
}
// check to see if product cat has children
function product_cat_has_children($term_id) { 
  if ( count( get_term_children( $term_id, 'product_cat' ) ) > 0 ) {
    return true;
  } else {
    return false;
  };
};
// get the sub product_cat filters based on parent term_id
function subs_product_cats_for_filters($term_id) {
  $subs_cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => $term_id,
  );
  return get_terms($subs_cats_args);
}
// add query arg link for product_cats in filters & escape the url
function add_query_arg_product_cats_for_filters($cat_slug) {
  // set the query arg url for product_cat from the product_cat->slug, removing _pjax
  $query_arg_product_cats_args = array(
    'product_cat' => $cat_slug,
    '_pjax' => false,
  );
  $the_url = add_query_arg($query_arg_product_cats_args);
  // parse the url into an array
  $parsed_url = wp_parse_url($the_url);
  // get the page path from the array
  $url_path = $parsed_url['path'];
  // the value we will use to search for in string
  $key_value = 'category'; 
  // find key_value string in the page path
  $found = strpos_recursive($url_path, $key_value);
  // if the 'category' exists in the current page path
  if($found) {
    // before new path
    $new_path = '/shop';
    // remove the current url page path from url string & set new path
    $new_path .= str_replace($url_path,'/',$the_url);
  } else {
    // if 'category' doesnt exist in current page url, set the add_query_arg url to the default state abouve
    $new_path = $the_url;
  }
  // return the new path
  return esc_url($new_path);
}
// add query arg link for product_cats in filters & escape the url
function remove_query_arg_product_cats_for_filters() {
  // get the current gloabl url with paths & parameters
  global $wp;
  $current_url = home_url( add_query_arg( array(), $wp->request ) );
  // get the current page path
  $current_url_page_path = $_SERVER['REQUEST_URI'];
  // get the current query string
  $current_url_query_string = $_SERVER['QUERY_STRING'];
  // if query_string exists
  if (!empty($current_url_query_string)) {
    // set link for reset filters; removes product_cat & _pjax from link
    $new_path = remove_query_arg($arr_params = array( 'product_cat', '_pjax'));
  };
  // if page path exists
  if (!empty($current_url_page_path)) {
    // current page path to be striped of last /
    $fixed_path = $current_url_page_path;
    // stripping last /
    $fixed_path = substr_replace($fixed_path, '', strrpos($fixed_path, '/'), 1);
    // 'category' is again our search key
    $key_value = 'category'; 
    // find 'category' string in the page path
    $found = strpos_recursive($current_url_page_path, $key_value);
    // if the 'category' exists in the current page path
    if($found) {
      // rebuild the remove query arg link removing product-category path from it
      $new_path = str_replace($fixed_path,'/shop',$current_url);
    } else {
      $new_path = remove_query_arg($arr_params = array( 'product_cat', '_pjax'));
    }   
  };
  // return the new path
  return esc_url($new_path);  
}
// get the current product_cat query var; check if isset first -> woocommerce.php
function current_product_cat_var() {
  if (isset($_GET['product_cat'])) {
    return $_GET['product_cat'];
  }
};
// get the current product orderby query var; check if isset first -> woocommerce.php
function current_product_orderby_var() {
  if (isset($_GET['orderby'])) {
    return $_GET['orderby'];
  }
};
// get the current grid_list query var; check if isset first -> woocommerce.php
function current_product_gridlist_var() {
  if (isset($_GET['grid_list'])) {
    return $_GET['grid_list'];
  }
};
// add query arg for grid view filter
function add_query_arg_grid_view_for_filters(){
  $args = array(
    'grid_list' => 'grid-view',
    '_pjax' => false,
  );
  return esc_url(add_query_arg($args));
};
// add query arg for list view filter
function add_query_arg_list_view_for_filters(){
  $args = array(
    'grid_list' => 'list-view',
    '_pjax' => false,
  );
  return esc_url(add_query_arg($args));
};
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
// ajax search php, theme-functions.php
function ajax_live_search() {

 $data = array(
   'result' => 0,
   'response' => ''
 );
 
 $query = $_POST['query'];
 $query_string_upper = ucwords($query);

 if (!empty($query)) {

   $data['result'] = 1;

   $cat_args = array(
     'fields' => 'all',
     'name__like' => $query, 
   );
   $product_categories = get_terms( 'product_cat', $cat_args );

   $products = wc_get_products( array(
     'status' => 'publish',
     'limit' => -1,
     'search_term' => $query,
     'meta_query' => array(
       array(
         'key' => '_stock_status',
         'value' => 'instock'
       ),
     )
   ));
   
   $matching_terms = get_terms( array(
     'taxonomy' => 'product_cat',
     'fields' => 'slugs',
     'name__like' => $query, 
   ));
   $products_in_cat_args = array(
     'posts_per_page' => -1,
     'post_type' => 'product',
     'orderby' => 'title',
     'meta_query' => array(
       array(
         'key' => '_stock_status',
         'value' => 'instock'
       ),
     ),
     'tax_query' => array(
       'relation' => 'AND',
       array(
         'taxonomy' => 'product_cat',
         'field' => 'slug',
         'terms' => $matching_terms
       ),
     ),
   );
   $products_in_cat = new Timber\PostQuery($products_in_cat_args);

   if (!empty($product_categories) || !empty($products) || !empty($products_in_cat) ) {

     $response = '<ul class="">';

     if (!empty($product_categories)) {
       foreach ($product_categories as $product_cateory) {
         $response .= '<li><a class="uk-link-text" href="' . get_term_link($product_cateory) . '">' . $product_cateory->name . ' <span class="uk-text-meta ajax-search-meta">Category</span></a></li>';
       }
     }

     if (!empty($products)) {
       foreach ($products as $product) {
         $response .= '<li><a class="uk-link-text" href="' . get_permalink($product->id) . '">' . $product->name . ' <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
       }
     }
     
     if (!empty($products_in_cat)) {
       foreach ($products_in_cat as $product_in_cat) {
         $response .= '<li><a class="uk-link-text" href="' . get_permalink($product_in_cat->id) . '">' . $product_in_cat->title . ' ('.$query_string_upper.') <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
       }
     }

     $response .= '</ul>';

   }

   $data['response'] = $response;

 }

 echo json_encode($data);

 die();
}
add_action( 'wp_ajax_ajax_live_search', 'ajax_live_search' );
add_action( 'wp_ajax_nopriv_ajax_live_search', 'ajax_live_search' );
// support 's' -> 'search_term' matching; for ajax_live_search
function support_search_term_query_var( $query, $query_vars ) {
  if( empty( $query_vars['search_term'] ) ) {
    return $query;
  }
  $query['s'] = $query_vars['search_term'];
  return $query;
 }
 add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'support_search_term_query_var', 10, 2 );
// filter for yoast breadcrumb seo separator
function organic_filter_yoast_breadcrumb_separator($this_options_breadcrumbs_sep)
{
  return '<i class="fas fa-angle-right fa-xs uk-padding-small uk-padding-remove-vertical"></i>';
}
add_filter('wpseo_breadcrumb_separator','organic_filter_yoast_breadcrumb_separator', 10, 1);
// register the required plugins(Timber) see TGM Plugin activation library for php
function organic_theme_register_required_plugins() {
  $plugins = array(
    array(
      'name' => 'Timber',
      'slug' => 'timber-library',
      'required' => true
    )
  );
  $config  = array(
    'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '', // Default absolute path to bundled plugins.
    'menu' => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug' => 'themes.php', // Parent menu slug.
    'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices' => true, // Show admin notices or not.
    'dismissable' => true, // If false, a user cannot dismiss the nag message.
    'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false, // Automatically activate plugins after installation or not.
    'message' => '' // Message to output right before the plugins table.
  );
  tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'organic_theme_register_required_plugins');