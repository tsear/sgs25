<?php
/**
 * Theme Customizer
 *
 * @package SmartGrantSolutions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sgs_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'sgs_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'sgs_customize_partial_blogdescription',
            )
        );
    }

    // Theme Options Section
    $wp_customize->add_section('sgs_theme_options', array(
        'title'    => __('Theme Options', 'sgs'),
        'priority' => 130,
    ));

    // Header Logo
    $wp_customize->add_setting('sgs_header_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sgs_header_logo', array(
        'label'    => __('Header Logo', 'sgs'),
        'section'  => 'sgs_theme_options',
        'settings' => 'sgs_header_logo',
    )));

    // Primary Color
    $wp_customize->add_setting('sgs_primary_color', array(
        'default'           => '#007cba',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sgs_primary_color', array(
        'label'    => __('Primary Color', 'sgs'),
        'section'  => 'sgs_theme_options',
        'settings' => 'sgs_primary_color',
    )));
}
add_action('customize_register', 'sgs_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sgs_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sgs_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sgs_customize_preview_js() {
    wp_enqueue_script('sgs-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), SGS_THEME_VERSION, true);
}
add_action('customize_preview_init', 'sgs_customize_preview_js');
