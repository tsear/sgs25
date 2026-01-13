<?php
/**
 * AJAX Handlers
 *
 * @package SmartGrantSolutions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Contact form handled by HubSpot embedded forms - no AJAX handler needed

/**
 * Handle newsletter signup
 */
function sgs_handle_newsletter_signup() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sgs_nonce')) {
        wp_die(__('Security check failed', 'sgs'));
    }

    // Sanitize email
    $email = sanitize_email($_POST['email']);

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => __('Please enter a valid email address.', 'sgs')
        ));
    }

    // Check if email already exists
    $existing = get_option('sgs_newsletter_subscribers', array());
    if (in_array($email, $existing)) {
        wp_send_json_error(array(
            'message' => __('This email address is already subscribed.', 'sgs')
        ));
    }

    // Add email to subscribers
    $existing[] = $email;
    update_option('sgs_newsletter_subscribers', $existing);

    // Note: Admin notifications handled by HubSpot

    wp_send_json_success(array(
        'message' => __('Thank you for subscribing to our newsletter!', 'sgs')
    ));
}
add_action('wp_ajax_sgs_newsletter_signup', 'sgs_handle_newsletter_signup');
add_action('wp_ajax_nopriv_sgs_newsletter_signup', 'sgs_handle_newsletter_signup');

/**
 * Handle grant application form
 */
function sgs_handle_grant_application() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sgs_nonce')) {
        wp_die(__('Security check failed', 'sgs'));
    }

    // Sanitize form data
    $applicant_name = sanitize_text_field($_POST['applicant_name']);
    $organization = sanitize_text_field($_POST['organization']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $project_title = sanitize_text_field($_POST['project_title']);
    $funding_amount = sanitize_text_field($_POST['funding_amount']);
    $project_description = sanitize_textarea_field($_POST['project_description']);

    // Validate required fields
    if (empty($applicant_name) || empty($email) || empty($project_title) || empty($project_description)) {
        wp_send_json_error(array(
            'message' => __('Please fill in all required fields.', 'sgs')
        ));
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => __('Please enter a valid email address.', 'sgs')
        ));
    }

    // Create application post
    $application_data = array(
        'post_title' => sprintf(__('Grant Application: %s', 'sgs'), $project_title),
        'post_content' => $project_description,
        'post_status' => 'private',
        'post_type' => 'grant_application',
        'meta_input' => array(
            'applicant_name' => $applicant_name,
            'organization' => $organization,
            'email' => $email,
            'phone' => $phone,
            'funding_amount' => $funding_amount,
            'application_date' => current_time('mysql'),
        ),
    );

    $application_id = wp_insert_post($application_data);

    if ($application_id) {
        // Note: Email notifications handled by HubSpot

        wp_send_json_success(array(
            'message' => __('Thank you! Your grant application has been submitted successfully. You will receive a confirmation email shortly.', 'sgs'),
            'application_id' => $application_id
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('Sorry, there was an error submitting your application. Please try again later.', 'sgs')
        ));
    }
}
add_action('wp_ajax_sgs_grant_application', 'sgs_handle_grant_application');
add_action('wp_ajax_nopriv_sgs_grant_application', 'sgs_handle_grant_application');

/**
 * ==============================================================
 * ALL REFERRAL AJAX HANDLERS MOVED TO inc/referral-api.php
 * ==============================================================
 */
