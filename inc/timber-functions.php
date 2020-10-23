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
    'views/pages',
    'views/parts',
    'views/parts/comments',
    'views/parts/sidebars',
    'views/singular',
    'views/woo',
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
        add_action('after_setup_theme', array( $this, 'theme_supports' ));
        add_action('wp_enqueue_scripts', array( $this, 'organic_theme_enqueue_assets'));
        add_action('widgets_init', array( $this, 'organic_custom_uikit_widgets_init'));
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
              'name' => esc_html__('Left Sidebar Area', 'organic-theme'),
              'id' => 'sidebar-left',
              'description' => esc_html__('Sidebar Area for Left Sidebar Templates, you can add multiple widgets here.', 'organic-theme'),
              'before_widget' => '',
              'after_widget' => '',
              'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
              'after_title' => '</span></h3>'
          ));
            register_sidebar(array(
                'name' => esc_html__('Right Sidebar Area', 'organic-theme'),
                'id' => 'sidebar-right',
                'description' => esc_html__('Sidebar Area for Right Sidebar Templates, you can add multiple widgets here.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Cart Area', 'organic-theme'),
                'id' => 'sidebar-woo-cart',
                'description' => esc_html__('Sidebar Area for Woo Cart Area, best to add the Woo Cart Widget here.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Sidebar Area', 'organic-theme'),
                'id' => 'sidebar-woo',
                'description' => esc_html__('Sidebar Area for Woocommerce.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Filters Area', 'organic-theme'),
                'id' => 'sidebar-woo-filters',
                'description' => esc_html__('Sidebar Area for Woocommerce Filters.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Mega Menu Area', 'organic-theme'),
                'id' => 'sidebar-megamenu',
                'description' => esc_html__('Mega Menu area for Woocommerce Category Navigation.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area', 'organic-theme'),
                'id' => 'sidebar-footer',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 1', 'organic-theme'),
                'id' => 'sidebar-footer-1',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold uk-text-muted widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 2', 'organic-theme'),
                'id' => 'sidebar-footer-2',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold uk-text-muted widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 3', 'organic-theme'),
                'id' => 'sidebar-footer-3',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold uk-text-muted widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 4', 'organic-theme'),
                'id' => 'sidebar-footer-4',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold uk-text-muted widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 5', 'organic-theme'),
                'id' => 'sidebar-footer-5',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold uk-text-muted widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Left Area', 'organic-theme'),
                'id' => 'sidebar-footer-left',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Right Area', 'organic-theme'),
                'id' => 'sidebar-footer-right',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'organic-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
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
        // check to see if is paginated; see theme-functions.php
        $context['is_paginated'] = is_paginated();
        // check if is search archive
        $context['is_search'] = is_search();
        // checks to see if is cart or if is checkout
        $context['is_cart'] = is_cart();
        $context['is_checkout'] = is_checkout();
        // get the sidebar widget areas
        $context['sidebar_left'] = Timber::get_widgets('Left Sidebar Area');
        $context['sidebar_right'] = Timber::get_widgets('Right Sidebar Area');
        $context['sidebar_footer'] = Timber::get_widgets('Main Footer Area');
        $context['sidebar_cart'] = Timber::get_widgets('Woo Cart Area');
        $context['sidebar_filters'] = Timber::get_widgets('Woo Filters Area');
        $context['sidebar_woo'] = Timber::get_widgets('Woo Sidebar Area');
        $context['sidebar_megamenu'] = Timber::get_widgets('Mega Menu Area');
        $context['sidebar_footer_1'] = Timber::get_widgets('Footer Area 1');
        $context['sidebar_footer_2'] = Timber::get_widgets('Footer Area 2');
        $context['sidebar_footer_3'] = Timber::get_widgets('Footer Area 3');
        $context['sidebar_footer_4'] = Timber::get_widgets('Footer Area 4');
        $context['sidebar_footer_5'] = Timber::get_widgets('Footer Area 5');
        $context['sidebar_footer_left'] = Timber::get_widgets('Footer Bottom Left Area');
        $context['sidebar_footer_right'] = Timber::get_widgets('Footer Bottom Right Area');
        // set the article_width_classs variable
        if ( is_page_template( 'page-templates/no-sidebar-template.php' ) ) {
            $context['article_width_class'] = 'uk-width-1-1';
        } else {
            $context['article_width_class'] = 'uk-width-2-3@s';
        };
        // checks to see if it should be left sidebar, or right sidebar; depends on preferred template setup
        $context['is_left_sidebar'] = is_page_template( 'page-templates/left-sidebar-template.php' );
        $context['is_right_sidebar'] = is_single() || is_page() && !is_page_template(array('page-templates/left-sidebar-template.php', 'page-templates/no-sidebar-template.php'));

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
        add_image_size('organic-theme-woocommerce', 600, 600, true);
        add_image_size('organic-theme-woo-archive-grid', 260, 260, true);
        add_image_size('organic-theme-cart-image', 80, 80, true);
        // add woo theme supports
        add_theme_support( 'woocommerce' );
        // add_theme_support( 'wc-product-gallery-zoom' );
        // add_theme_support( 'wc-product-gallery-lightbox' );
        // add_theme_support( 'wc-product-gallery-slider' );
    }
    
    // enqueue theme assets
    public function organic_theme_enqueue_assets()
    {
        wp_enqueue_style('organic-theme-css', get_template_directory_uri() . '/assets/css/base.css');
        wp_enqueue_script('organic-theme-js', get_template_directory_uri() . '/assets/js/main/main.js', '', '', false);
        wp_enqueue_style('organic-theme-styles', get_stylesheet_uri());
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
