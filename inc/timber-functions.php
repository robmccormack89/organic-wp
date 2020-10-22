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
  'views/page-templates',
  'views/pages',
  'views/parts',
  'views/parts/comments',
  'views/parts/footer',
  'views/parts/header',
  'views/parts/sidebar',
  'views/parts/tease',
  'views/parts/woo',
  'views/single',
  'views/styles',
);

// Define Organic_Theme Child Class
class OrganicTheme extends TimberSite
{
    public function __construct()
    {
        // timber stuff
        add_filter('timber_context', array( $this, 'add_to_context' ));
        add_filter('get_twig', array( $this, 'add_to_twig' ));
        add_action('init', array( $this, 'register_post_types' ));
        add_action('init', array( $this, 'register_taxonomies' ));
        add_action('init', array( $this, 'register_widget_areas' ));
        add_action('init', array( $this, 'register_navigation_menus' ));

        parent::__construct();
    }

    public function register_post_types()
    {
    
    }

    public function register_taxonomies()
    {
      // Register Custom Taxonomy
      
    }

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
      $main_menu_args = array(
          'depth' => 2,
      );
      
      $context['is_search'] = is_search();
      
      $context['menu_main'] = new \Timber\Menu( 'main' );
      $context['menu_mobile'] = new \Timber\Menu('mobile');
      $context['has_menu_main'] = has_nav_menu( 'main' );
      $context['has_menu_mobile'] = has_nav_menu( 'mobile' );
      $context['is_paginated'] = is_paginated();
      $context['site']            = $this;
      $theme_logo_id = get_theme_mod( 'custom_logo' );
      $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
      $context['theme_logo_url'] = $theme_logo_url;
      $context['is_cart'] = is_cart();
      $context['is_checkout'] = is_checkout();
      $context['sidebar_left']  = Timber::get_widgets('Left Sidebar Area');
      $context['sidebar_right'] = Timber::get_widgets('Right Sidebar Area');
      $context['sidebar_footer']   = Timber::get_widgets('Main Footer Area');
      $context['sidebar_cart']  = Timber::get_widgets('Woo Cart Area');
      $context['sidebar_filters'] = Timber::get_widgets('Woo Filters Area');
      $context['sidebar_woo']   = Timber::get_widgets('Woo Sidebar Area');
      $context['sidebar_megamenu']   = Timber::get_widgets('Mega Menu Area');
      $context['sidebar_footer_1']   = Timber::get_widgets('Footer Area 1');
      $context['sidebar_footer_2']   = Timber::get_widgets('Footer Area 2');
      $context['sidebar_footer_3']   = Timber::get_widgets('Footer Area 3');
      $context['sidebar_footer_4']   = Timber::get_widgets('Footer Area 4');
      $context['sidebar_footer_5']   = Timber::get_widgets('Footer Area 5');
      $context['sidebar_footer_left']   = Timber::get_widgets('Footer Bottom Left Area');
      $context['sidebar_footer_right']   = Timber::get_widgets('Footer Bottom Right Area');
      if ( is_page_template( 'page-templates/no-sidebar-template.php' ) ) {
        $context['article_width_class'] = 'uk-width-1-1';
      } else {
        $context['article_width_class'] = 'uk-width-2-3@s';
      };
      $context['is_left_sidebar'] = is_page_template( 'page-templates/left-sidebar-template.php' );
      $context['is_right_sidebar'] = is_single() || is_page() && ! is_page_template( array( 'page-templates/left-sidebar-template.php', 'page-templates/no-sidebar-template.php' ) );

      return $context;
    }

    public function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());

        return $twig;
    }
}

new OrganicTheme();
