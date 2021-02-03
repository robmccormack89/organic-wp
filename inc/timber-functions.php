<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Organic_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views/',
  'views/archive',
  'views/parts',
  'views/singular',
  'views/woo',
  'views/woo/parts',
);

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class OrganicTheme extends TimberSite
{
  
  public function __construct()
  {
    
    // custom
    add_action('after_setup_theme', array( $this, 'theme_supports'));
    add_action('wp_enqueue_scripts', array( $this, 'organic_theme_enqueue_assets'));
    add_action('widgets_init', array( $this, 'organic_custom_uikit_widgets_init'));
    add_action('init', array( $this, 'organic_unregister_tags'));
    add_filter('query_vars', array( $this, 'organic_gridlist_query_vars_filter'));
    add_action( 'wp_footer', array( $this, 'deregister_embed'));
    // timber
    add_filter('timber/context', array( $this, 'add_to_context' ));
    add_filter('timber/twig', array( $this, 'add_to_twig' ));
    add_action('init', array( $this, 'register_post_types' ));
    add_action('init', array( $this, 'register_taxonomies' ));
    add_action('init', array( $this, 'register_widget_areas' ));
    add_action('init', array( $this, 'register_navigation_menus' ));
    parent::__construct();
    
  }

  // register custom post types
  public function register_post_types()
  {
    
  	$labels_one = array(
  		'name'                  => _x( 'Banner Slides', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Banner Slide', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Home Banner Slides', 'text_domain' ),
  		'name_admin_bar'        => __( 'Banner Slide', 'text_domain' ),
  		'archives'              => __( 'Banner Slide Archives', 'text_domain' ),
  		'attributes'            => __( 'Item Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Slides', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
  		'add_new'               => __( 'Add New', 'text_domain' ),
  		'new_item'              => __( 'New Item', 'text_domain' ),
  		'edit_item'             => __( 'Edit Item', 'text_domain' ),
  		'update_item'           => __( 'Update Item', 'text_domain' ),
  		'view_item'             => __( 'View Item', 'text_domain' ),
  		'view_items'            => __( 'View Items', 'text_domain' ),
  		'search_items'          => __( 'Search Item', 'text_domain' ),
  		'not_found'             => __( 'Not found', 'text_domain' ),
  		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  		'featured_image'        => __( 'Featured Image', 'text_domain' ),
  		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
  		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
  		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
  		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
  		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
  		'items_list'            => __( 'Items list', 'text_domain' ),
  		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
  		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  	);
  	$args_one = array(
  		'label'                 => __( 'Banner Slide', 'text_domain' ),
  		'description'           => __( 'Banner Slides for the Home Page Banner', 'text_domain' ),
  		'labels'                => $labels_one,
  		'supports'              => array( 'title', 'editor', 'thumbnail' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => false,
  		'can_export'            => true,
  		'has_archive'           => false,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'slide', $args_one );
    
    $labels_three = array(
  		'name'                  => _x( 'Info Slides', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Info Slide', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Home Info Slides', 'text_domain' ),
  		'name_admin_bar'        => __( 'Info Slide', 'text_domain' ),
  		'archives'              => __( 'Info Slides Archives', 'text_domain' ),
  		'attributes'            => __( 'Item Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Items', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
  		'add_new'               => __( 'Add New', 'text_domain' ),
  		'new_item'              => __( 'New Item', 'text_domain' ),
  		'edit_item'             => __( 'Edit Item', 'text_domain' ),
  		'update_item'           => __( 'Update Item', 'text_domain' ),
  		'view_item'             => __( 'View Item', 'text_domain' ),
  		'view_items'            => __( 'View Items', 'text_domain' ),
  		'search_items'          => __( 'Search Item', 'text_domain' ),
  		'not_found'             => __( 'Not found', 'text_domain' ),
  		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  		'featured_image'        => __( 'Featured Image', 'text_domain' ),
  		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
  		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
  		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
  		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
  		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
  		'items_list'            => __( 'Items list', 'text_domain' ),
  		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
  		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  	);
  	$args_three = array(
  		'label'                 => __( 'Home Info Slide', 'text_domain' ),
  		'description'           => __( 'Home Info Slides for Homepage (under banner)', 'text_domain' ),
  		'labels'                => $labels_three,
  		'supports'              => array( 'title', 'editor' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => false,
  		'can_export'            => true,
      'has_archive'           => false,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'info_slide', $args_three );
    
  	$labels_two = array(
  		'name'                  => _x( 'Mega Menus', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Mega Menu', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Mega Menus', 'text_domain' ),
  		'name_admin_bar'        => __( 'Mega Menu', 'text_domain' ),
  		'archives'              => __( 'Mega Menus Archives', 'text_domain' ),
  		'attributes'            => __( 'Item Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Items', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
  		'add_new'               => __( 'Add New', 'text_domain' ),
  		'new_item'              => __( 'New Item', 'text_domain' ),
  		'edit_item'             => __( 'Edit Item', 'text_domain' ),
  		'update_item'           => __( 'Update Item', 'text_domain' ),
  		'view_item'             => __( 'View Item', 'text_domain' ),
  		'view_items'            => __( 'View Items', 'text_domain' ),
  		'search_items'          => __( 'Search Item', 'text_domain' ),
  		'not_found'             => __( 'Not found', 'text_domain' ),
  		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  		'featured_image'        => __( 'Featured Image', 'text_domain' ),
  		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
  		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
  		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
  		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
  		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
  		'items_list'            => __( 'Items list', 'text_domain' ),
  		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
  		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  	);
  	$args_two = array(
  		'label'                 => __( 'Mega Menu', 'text_domain' ),
  		'description'           => __( 'Mega Menu for Main Menu', 'text_domain' ),
  		'labels'                => $labels_two,
  		'supports'              => array( 'title', 'editor', 'thumbnail' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => false,
  		'can_export'            => true,
  		'has_archive'           => false,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'mega_menu', $args_two );
    


  }

  // register custom taxonomies
  public function register_taxonomies()
  {
    // Register Custom Taxonomy
  }

  // register widget areas
  public function register_widget_areas()
  {
    // Register widget areas
    if (function_exists('register_sidebar')) {
      
      register_sidebar(array(
        'name' => esc_html__('Header Top', 'organic-theme'),
        'id' => 'header-top',
        'description' => esc_html__('Header Top', 'organic-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title uk-h4" hidden>',
        'after_title' => '</h3>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer One', 'organic-theme'),
        'id' => 'footer-one',
        'description' => esc_html__('Footer One Widget Area', 'organic-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title uk-h4">',
        'after_title' => '</h3>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Two', 'organic-theme'),
        'id' => 'footer-two',
        'description' => esc_html__('Footer Two Widget Area', 'organic-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title uk-h4">',
        'after_title' => '</h3>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Three', 'organic-theme'),
        'id' => 'footer-three',
        'description' => esc_html__('Footer Three Widget Area', 'organic-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title uk-h4">',
        'after_title' => '</h3>'
      ));
      
    }
  }

  // register nav menus
  public function register_navigation_menus()
  {
    
    // This theme uses wp_nav_menu() in one locations.
    register_nav_menus(array(
      'main' => __('Main Menu', 'organic-theme'),
      'mobile' => __('Mobile Menu', 'organic-theme'),
    ));
    
  }

  // register custom context variables; global contexts
  public function add_to_context($context)
  {
    // set site context
    $context['site'] = $this;
    
    // main menu args
    $main_menu_args = array(
        'depth' => 2,
    );
    // register our menus
    $context['menu_main'] = new \Timber\Menu( 'main' );
    $context['menu_mobile'] = new \Timber\Menu('mobile');
    // checks for if the menus are present
    $context['has_menu_main'] = has_nav_menu( 'main' );
    $context['has_menu_mobile'] = has_nav_menu( 'mobile' );
    
    // get the cutomizer logo option & set variable
    $theme_logo_id = get_theme_mod( 'custom_logo' );
    $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
    $context['theme_logo_url'] = $theme_logo_url;
    
    // add sidebars to them context
    $context['header_top']  = Timber::get_widgets('Header Top');
    $context['footer_one']  = Timber::get_widgets('Footer One');
    $context['footer_two']  = Timber::get_widgets('Footer Two');
    $context['footer_three']  = Timber::get_widgets('Footer Three');

    // checks to see if is cart or if is checkout
    $context['is_cart'] = is_cart();
    $context['is_checkout'] = is_checkout();
    $context['is_front_page'] = is_front_page();
    
    // get mega menu
    $mega_args = array(
       'post_type'             => 'mega_menu',
       'post_status'           => 'publish',
       'posts_per_page' => 1,
    );
    $context['mega_menus'] = new Timber\PostQuery($mega_args);

    return $context;
  }

  // just normal theme supports & setup
  public function theme_supports()
  {
    
    // theme support for title tag
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('post-formats', array(
      'gallery',
      'quote',
      'video',
      'aside',
      'image',
      'link'
    ));
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('woocommerce');
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
    ));
    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
      'height' => 30,
      'width' => 261,
      'flex-width' => true,
      'flex-height' => true
    ));
    // add custom thumbs sizes.
    add_image_size('organic-theme-featured-image-archive', 800, 300, true);
    add_image_size('organic-theme-wide-template-featured-image', 1000, 500, true);
    add_image_size('organic-theme-woocommerce', 600, 600, true);
    add_image_size('organic-theme-woo-archive-grid', 260, 260, true);
    add_image_size('organic-theme-cart-image', 80, 80, true);
    // add woo theme supports
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    // stop the br tag madness in the content editor
    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_excerpt', 'wpautop' );
    
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
  }
  
  public function deregister_embed()
  {
    wp_deregister_script( 'wp-embed' );
  }

  // Remove theme's tags support from posts
  public function organic_unregister_tags()
  {
    unregister_taxonomy_for_object_type('post_tag', 'post');
  }

  // add grid-list url paramater key
  public function organic_gridlist_query_vars_filter($vars)
  {
    $vars[] .= 'grid_list';
    return $vars;
  }

  // enqueue theme assets
  public function organic_theme_enqueue_assets()
  {
    
    // theme base scripts; not jquery dependent
    wp_enqueue_script(
      'organic-theme',
      get_template_directory_uri() . '/assets/js/main/main.js',
      '',
      '3.1.5',
      true
    );
    
    // enqueue wp jquery
    wp_enqueue_script( 'jquery' );
    
    // global (site wide) scripts; uses jquery
    wp_enqueue_script(
      'global',
      get_template_directory_uri() . '/assets/js/global.js',
      'jquery',
      '1.0.0',
      true
    );
    // localize theme scripts for ajax
    wp_localize_script(
      'global',
      'myAjax',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php')
      )
    );
    
    // font awesome
    wp_enqueue_style(
      'fontawesome-theme',
      get_template_directory_uri() . '/assets/css/all.min.css'
    );
    // theme base css
    wp_enqueue_style(
      'organic-theme',
      get_template_directory_uri() . '/assets/css/base.css'
    );
    // theme stylesheet; used for globals (site wide)
    wp_enqueue_style(
      'organic-theme-stylesheet', get_stylesheet_uri()
    );
    
  }

  // register theme widget
  public function organic_custom_uikit_widgets_init()
  {
    register_widget("Organic_Theme_Custom_UIKIT_Widget_Class");
  }

  public function add_to_twig($twig)
  {
    /* this is where you can add your own functions to twig */
    $twig->addExtension(new Twig_Extension_StringLoader());
    return $twig;
  }
  
}

new OrganicTheme();
