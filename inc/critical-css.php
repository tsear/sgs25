<?php
/**
 * Critical CSS Loading System
 * Serves page-specific critical CSS for performance optimization
 * 
 * @package SmartGrantSolutions
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class SGS_Critical_CSS {
    
    /**
     * Initialize critical CSS system
     */
    public static function init() {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'defer_main_css'), 999);
        add_action('wp_head', array(__CLASS__, 'output_critical_css'), 1);
    }
    
    /**
     * Output page-specific critical CSS inline in <head>
     */
    public static function output_critical_css() {
        $critical_css_file = self::get_critical_css_file();
        
        if ($critical_css_file) {
            $css_path = get_template_directory() . '/assets/scss/dist/' . $critical_css_file . '.css';
            
            if (file_exists($css_path)) {
                $critical_css = file_get_contents($css_path);
                
                if ($critical_css) {
                    echo '<style id="critical-css">' . $critical_css . '</style>' . "\n";
                    
                    // Mark which critical CSS was loaded (for debugging)
                    echo '<!-- Critical CSS loaded: ' . $critical_css_file . ' -->' . "\n";
                    
                    // Add deferred main CSS loading
                    $main_css_url = get_stylesheet_uri();
                    echo '<link rel="preload" href="' . esc_url($main_css_url) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
                    echo '<noscript><link rel="stylesheet" href="' . esc_url($main_css_url) . '"></noscript>' . "\n";
                }
            }
        }
    }
    
    /**
     * Determine which critical CSS file to use based on current page
     * 
     * @return string|false Critical CSS filename (without extension) or false
     */
    private static function get_critical_css_file() {
        // Homepage - using minimal critical CSS for performance
        if (is_front_page()) {
            return 'critical-home-minimal';
        }
        
        // Blog pages (main blog, categories, tags, author, search)
        if (is_home() || is_category() || is_tag() || is_author() || is_search() || 
            (is_page() && get_post_meta(get_the_ID(), '_wp_page_template', true) === 'page-blog.php')) {
            return 'critical-blog';
        }
        
        // Grants pages
        if (is_post_type_archive('grant_opportunity') || is_tax('grant_category') || 
            is_singular('grant_opportunity') || 
            (is_page() && get_post_meta(get_the_ID(), '_wp_page_template', true) === 'page-grants.php')) {
            return 'critical-grants';
        }
        
        // Success Stories pages
        if (is_post_type_archive('success_story') || is_tax('success_story_category') || 
            is_singular('success_story') || 
            (is_page() && get_post_meta(get_the_ID(), '_wp_page_template', true) === 'page-success-stories.php')) {
            return 'critical-success';
        }
        
        // Contact page
        if (is_page() && get_post_meta(get_the_ID(), '_wp_page_template', true) === 'page-contact.php') {
            return 'critical-contact';
        }
        
        // Testimonials page
        if (is_page() && get_post_meta(get_the_ID(), '_wp_page_template', true) === 'page-testimonials.php') {
            return 'critical-contact'; // Reuse contact critical CSS for now
        }
        
        // Fallback to homepage critical for other pages
        return 'critical-home';
    }
    
    /**
     * Defer main CSS loading to improve perceived performance
     * This is handled inline in output_critical_css() method
     */
    public static function defer_main_css() {
        // Remove the main style.css from normal WordPress enqueue
        wp_dequeue_style('smartgrantsolutions-style');
        wp_deregister_style('smartgrantsolutions-style');
    }
    
    /**
     * Get critical CSS for AJAX/debugging purposes
     * 
     * @return array Available critical CSS files info
     */
    public static function get_critical_css_info() {
        $dist_path = get_template_directory() . '/assets/scss/dist/';
        $css_files = glob($dist_path . 'critical-*.css');
        
        $info = array();
        foreach ($css_files as $file) {
            $filename = basename($file, '.css');
            $info[$filename] = array(
                'file' => $filename,
                'size' => filesize($file),
                'size_formatted' => size_format(filesize($file)),
                'modified' => filemtime($file)
            );
        }
        
        return $info;
    }
}

// Initialize the critical CSS system
SGS_Critical_CSS::init();
