<?php
/**
 * Custom Post Types
 *
 * @package SmartGrantSolutions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Types
 */
function sgs_register_post_types() {
    // Grant Opportunities Post Type
    register_post_type('grant_opportunity', array(
        'labels' => array(
            'name'               => __('Grant Opportunities', 'sgs'),
            'singular_name'      => __('Grant Opportunity', 'sgs'),
            'menu_name'          => __('Grant Opportunities', 'sgs'),
            'add_new'            => __('Add New', 'sgs'),
            'add_new_item'       => __('Add New Grant Opportunity', 'sgs'),
            'edit_item'          => __('Edit Grant Opportunity', 'sgs'),
            'new_item'           => __('New Grant Opportunity', 'sgs'),
            'view_item'          => __('View Grant Opportunity', 'sgs'),
            'search_items'       => __('Search Grant Opportunities', 'sgs'),
            'not_found'          => __('No grant opportunities found', 'sgs'),
            'not_found_in_trash' => __('No grant opportunities found in Trash', 'sgs'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'grants'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-money-alt',
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'show_in_rest'        => true,
    ));

    // Success Stories Post Type
    register_post_type('success_story', array(
        'labels' => array(
            'name'               => __('Success Stories', 'sgs'),
            'singular_name'      => __('Success Story', 'sgs'),
            'menu_name'          => __('Success Stories', 'sgs'),
            'add_new'            => __('Add New', 'sgs'),
            'add_new_item'       => __('Add New Success Story', 'sgs'),
            'edit_item'          => __('Edit Success Story', 'sgs'),
            'new_item'           => __('New Success Story', 'sgs'),
            'view_item'          => __('View Success Story', 'sgs'),
            'search_items'       => __('Search Success Stories', 'sgs'),
            'not_found'          => __('No success stories found', 'sgs'),
            'not_found_in_trash' => __('No success stories found in Trash', 'sgs'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'success-stories'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-star-filled',
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'show_in_rest'        => true,
    ));
}
add_action('init', 'sgs_register_post_types');

/**
 * Register Custom Taxonomies
 */
function sgs_register_taxonomies() {
    // Grant Categories
    register_taxonomy('grant_category', 'grant_opportunity', array(
        'labels' => array(
            'name'              => __('Grant Categories', 'sgs'),
            'singular_name'     => __('Grant Category', 'sgs'),
            'search_items'      => __('Search Grant Categories', 'sgs'),
            'all_items'         => __('All Grant Categories', 'sgs'),
            'parent_item'       => __('Parent Grant Category', 'sgs'),
            'parent_item_colon' => __('Parent Grant Category:', 'sgs'),
            'edit_item'         => __('Edit Grant Category', 'sgs'),
            'update_item'       => __('Update Grant Category', 'sgs'),
            'add_new_item'      => __('Add New Grant Category', 'sgs'),
            'new_item_name'     => __('New Grant Category Name', 'sgs'),
            'menu_name'         => __('Grant Categories', 'sgs'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'grant-category'),
        'show_in_rest'      => true,
    ));

    // Funding Amounts
    register_taxonomy('funding_amount', 'grant_opportunity', array(
        'labels' => array(
            'name'              => __('Funding Amounts', 'sgs'),
            'singular_name'     => __('Funding Amount', 'sgs'),
            'search_items'      => __('Search Funding Amounts', 'sgs'),
            'all_items'         => __('All Funding Amounts', 'sgs'),
            'edit_item'         => __('Edit Funding Amount', 'sgs'),
            'update_item'       => __('Update Funding Amount', 'sgs'),
            'add_new_item'      => __('Add New Funding Amount', 'sgs'),
            'new_item_name'     => __('New Funding Amount Name', 'sgs'),
            'menu_name'         => __('Funding Amounts', 'sgs'),
        ),
        'hierarchical'      => false,
        'public'            => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'funding-amount'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'sgs_register_taxonomies');
