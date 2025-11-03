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
define('SGS_THEME_VERSION', '1.0.1');
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
    // Enqueue our compiled SASS (will be deferred by critical CSS system)
    wp_enqueue_style('smartgrantsolutions-style', get_stylesheet_uri(), array(), SGS_THEME_VERSION);
    
    // Enqueue fonts (Poppins for hero, DM Sans for content)
    wp_enqueue_style('sgs-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);
    
    // Enqueue JavaScript - Use bundled version
    wp_enqueue_script('sgs-main', SGS_THEME_URI . '/assets/js/dist/main.bundle.js', array(), SGS_THEME_VERSION, true);
    
    // Homepage-specific scripts (not in bundle yet)
    if (is_front_page() || is_home()) {
        wp_enqueue_script('sgs-typed-animation', SGS_THEME_URI . '/assets/js/modules/typed-animation.js', array(), SGS_THEME_VERSION, true);
        wp_enqueue_script('sgs-trusted-orgs-carousel', SGS_THEME_URI . '/assets/js/modules/trusted-organizations-carousel.js', array(), SGS_THEME_VERSION, true);
        wp_enqueue_script('sgs-video-features', SGS_THEME_URI . '/assets/js/modules/video-features.js', array('jquery'), SGS_THEME_VERSION, true);
    }
    
    // Localize script for AJAX
    wp_localize_script('sgs-main', 'sgs_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sgs_nonce')
    ));
}

// Include theme modules
require_once SGS_THEME_DIR . '/inc/customizer.php';
require_once SGS_THEME_DIR . '/inc/post-types.php';
require_once SGS_THEME_DIR . '/inc/theme-options.php';
require_once SGS_THEME_DIR . '/inc/ajax-handlers.php';
require_once SGS_THEME_DIR . '/inc/critical-css.php';

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

// Flush rewrite rules on theme activation and when post types are registered
add_action('after_switch_theme', 'sgs_flush_rewrite_rules');
add_action('init', 'sgs_flush_rewrite_rules_on_init', 20);

function sgs_flush_rewrite_rules() {
    // Make sure our post types are registered first
    if (function_exists('sgs_register_post_types')) {
        sgs_register_post_types();
    }
    if (function_exists('sgs_register_taxonomies')) {
        sgs_register_taxonomies();
    }
    
    // Flush rewrite rules
    flush_rewrite_rules();
}

function sgs_flush_rewrite_rules_on_init() {
    // Only flush if needed (e.g., if a flag is set)
    if (get_option('sgs_flush_rewrite_rules')) {
        flush_rewrite_rules();
        delete_option('sgs_flush_rewrite_rules');
    }
}

// Set flag to flush rewrite rules when post types are updated
add_action('init', function() {
    $post_types_version = get_option('sgs_post_types_version', '0');
    if (version_compare($post_types_version, SGS_THEME_VERSION, '<')) {
        update_option('sgs_flush_rewrite_rules', true);
        update_option('sgs_post_types_version', SGS_THEME_VERSION);
    }
}, 15);

/**
 * Get footer read more categories dynamically
 * Gets first 9 categories total from all post types combined
 */
function sgs_get_footer_categories() {
    global $wpdb;
    
    // Get ALL categories from all taxonomies, ordered by count, limit 9
    $all_terms = $wpdb->get_results("
        SELECT t.term_id, t.name, t.slug, tt.taxonomy, tt.count 
        FROM {$wpdb->terms} t 
        INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id 
        WHERE tt.taxonomy IN ('success_story_category', 'grant_category', 'category') 
        AND tt.count > 0 
        ORDER BY tt.count DESC 
        LIMIT 9
    ");
    
    $categories = array();
    
    if ($all_terms) {
        foreach ($all_terms as $term) {
            $term_link = get_term_link($term->term_id, $term->taxonomy);
            if (!is_wp_error($term_link)) {
                $categories[] = array(
                    'name' => $term->name,
                    'url' => $term_link,
                    'type' => $term->taxonomy
                );
            }
        }
    }
    
    return $categories;
}
?>
