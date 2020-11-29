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
    'views/parts/footer',
    'views/parts/header',
    'views/parts/header/header-main',
    'views/parts/tease',
    'views/singular',
    'views/woo',
    'views/woo/parts',
    'views/woo/parts/archive',
    'views/woo/parts/related',
    'views/woo/parts/single',
    'views/woo/parts/tease',
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
      add_filter('pre_get_posts', array( $this, 'organic_products_only_search'));
      add_filter('query_vars', array( $this, 'organic_gridlist_query_vars_filter'));
      
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
      // Register Post Type
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

    // register custom context variables
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

        // checks to see if is cart or if is checkout
        $context['is_cart'] = is_cart();
        $context['is_checkout'] = is_checkout();
        
        $query_var = get_query_var('grid-list');
        
        if ( $query_var == 'grid-view' || $query_var == '' ) {
          $context['list_active_class'] = 'not-active';
          $context['grid_active_class'] = 'uk-active'; 
          $context['grid_list_layout_class'] = 'uk-child-width-1-4@m';
          $context['tease_template'] = 'tease-product.twig';    
        } elseif ( $query_var == 'list-view' ) {
          $context['grid_active_class'] = 'not-active';
          $context['list_active_class'] = 'uk-active';
          $context['grid_list_layout_class'] = 'uk-child-width-1-1@m'; 
          $context['tease_template'] = 'tease-product-list.twig';   
        }

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
    }
    
    // Remove theme's tags support from posts
    public function organic_unregister_tags()
    {
      unregister_taxonomy_for_object_type('post_tag', 'post');
    }
    
    // Limit searches to products
    public function organic_products_only_search($query)
    {
      if ( $query->is_main_query() && is_search() ) {
        $query->set( 'post_type', 'product' );
      }
      return $query;
    }
    
    // add grid-list url paramater key
    public function organic_gridlist_query_vars_filter($vars)
    {
      $vars[] .= 'grid-list';
      return $vars;
    }
    
    // enqueue theme assets
    public function organic_theme_enqueue_assets()
    {
      // jquery
      wp_enqueue_script( 'jquery' );
      // custom scripts
      wp_enqueue_script(
        'global',
        get_template_directory_uri() . '/assets/js/scripts.js',
        array( 'jquery' ),
        '1.0.0',
        true
      );
      // localize custom scripts
      wp_localize_script(
        'global',
        'global',
        array(
          'ajax' => admin_url( 'admin-ajax.php' ),
        )
      );
      // theme scripts
      wp_enqueue_script(
        'organic-theme-js',
        get_template_directory_uri() . '/assets/js/main/main.js',
        '',
        '3.1.5',
        false
      );
      // localize theme scripts
      wp_localize_script(
        'organic-theme-js',
        'myAjax',
        array(
          'ajaxurl' => admin_url( 'admin-ajax.php')
        )
      );
      // font awesome
      wp_enqueue_style(
        'fontawesome-theme-css',
        get_template_directory_uri() . '/assets/css/all.min.css'
      );
      // base css
      wp_enqueue_style(
        'organic-theme-css',
        get_template_directory_uri() . '/assets/css/base.css'
      );
      // theme stylesheet
      wp_enqueue_style(
        'organic-theme-styles', get_stylesheet_uri()
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
