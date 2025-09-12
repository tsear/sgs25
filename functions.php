<?php
/**
 * Smart Grant Solutions Theme Functions
 *
 * @package SGS
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('SGS_THEME_VERSION', '1.0.0');
define('SGS_THEME_URI', get_template_directory_uri());
define('SGS_THEME_DIR', get_template_directory());

// Theme setup
add_action('after_setup_theme', 'sgs_theme_setup');
function sgs_theme_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'sgs'),
        'footer' => __('Footer Menu', 'sgs'),
        'mobile' => __('Mobile Menu', 'sgs'),
    ));

    // Add custom image sizes
    add_image_size('sgs-hero', 1440, 331, true);
    add_image_size('sgs-blog-thumbnail', 400, 200, true);
    add_image_size('sgs-blog-large', 800, 400, true);
}

// Enqueue scripts and styles
add_action('wp_enqueue_scripts', 'sgs_enqueue_assets');
function sgs_enqueue_assets() {
    // Enqueue Tilda CSS files for 1:1 recreation
    wp_enqueue_style('tilda-grid', SGS_THEME_URI . '/assets/css/tilda-grid-3.0.min.css', array(), SGS_THEME_VERSION);
    wp_enqueue_style('tilda-blocks-main', SGS_THEME_URI . '/assets/css/tilda-blocks-page68194609.min.css', array(), SGS_THEME_VERSION);
    wp_enqueue_style('tilda-animation', SGS_THEME_URI . '/assets/css/tilda-animation-2.0.min.css', array(), SGS_THEME_VERSION);
    
    // Enqueue our compiled SASS (for additional styling)
    wp_enqueue_style('sgs-style', get_stylesheet_uri(), array(), SGS_THEME_VERSION);
    
    // Enqueue fonts (Poppins for hero, DM Sans for content)
    wp_enqueue_style('sgs-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
    
    // Enqueue JavaScript - Use bundled version
    wp_enqueue_script('sgs-main', SGS_THEME_URI . '/assets/js/dist/main.bundle.js', array(), SGS_THEME_VERSION, true);
    wp_enqueue_script('sgs-trusted-orgs-carousel', SGS_THEME_URI . '/assets/js/modules/trusted-organizations-carousel.js', array(), SGS_THEME_VERSION, true);
    wp_enqueue_script('sgs-video-features', SGS_THEME_URI . '/assets/js/modules/video-features.js', array('jquery'), SGS_THEME_VERSION, true);
    wp_enqueue_script('sgs-rocket-animations', SGS_THEME_URI . '/assets/js/modules/rocket-animations.js', array(), SGS_THEME_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('sgs-main', 'sgs_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sgs_nonce'),
    ));
}

// Include theme modules
require_once SGS_THEME_DIR . '/inc/customizer.php';
require_once SGS_THEME_DIR . '/inc/post-types.php';
require_once SGS_THEME_DIR . '/inc/theme-options.php';
require_once SGS_THEME_DIR . '/inc/ajax-handlers.php';

// Widget areas
add_action('widgets_init', 'sgs_register_widgets');
function sgs_register_widgets() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'sgs'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here.', 'sgs'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'sgs'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here.', 'sgs'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'sgs'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here.', 'sgs'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}

// Custom excerpt length
add_filter('excerpt_length', 'sgs_excerpt_length', 999);
function sgs_excerpt_length($length) {
    return 20;
}

// Custom excerpt more
add_filter('excerpt_more', 'sgs_excerpt_more');
function sgs_excerpt_more($more) {
    return '...';
}

// Clean up head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Security enhancements
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wp_resource_hints', 2);
?>
