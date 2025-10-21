<?php
/**
 * HubSpot API Integration
 * Handles form submissions to HubSpot via API for different form types
 *
 * @package SGS_Theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * HubSpot API Form Submission Handler
 */
class SGS_HubSpot_API {
    
    private $portal_id;
    private $api_endpoint;
    
    public function __construct() {
        $this->portal_id = get_option('sgs_hubspot_portal_id', '44675524');
        $this->api_endpoint = "https://api.hsforms.com/submissions/v3/integration/submit/{$this->portal_id}";
        
        // Hook into AJAX actions
        add_action('wp_ajax_sgs_submit_hubspot_form', array($this, 'handle_form_submission'));
        add_action('wp_ajax_nopriv_sgs_submit_hubspot_form', array($this, 'handle_form_submission'));
    }
    
    /**
     * Handle AJAX form submissions
     */
    public function handle_form_submission() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'sgs_hubspot_form_nonce')) {
            wp_send_json_error('Security check failed');
            return;
        }
        
        $form_type = sanitize_text_field($_POST['form_type']);
        $form_data = $_POST['form_data'];
        
        // Get form-specific configuration
        $form_config = $this->get_form_config($form_type);
        if (!$form_config) {
            wp_send_json_error('Invalid form type');
            return;
        }
        
        // Submit to HubSpot
        $result = $this->submit_to_hubspot($form_config['form_id'], $form_data, $form_config['context']);
        
        if ($result['success']) {
            wp_send_json_success($result['data']);
        } else {
            wp_send_json_error($result['message']);
        }
    }
    
    /**
     * Get form configuration based on type
     */
    private function get_form_config($form_type) {
        $configs = array(
            'newsletter' => array(
                'form_id' => get_option('sgs_hubspot_newsletter_form_id', ''),
                'context' => array(
                    'pageUri' => wp_get_referer() ?: home_url(),
                    'pageName' => 'Newsletter Signup'
                ),
                'required_fields' => array('email')
            ),
            'contact' => array(
                'form_id' => get_option('sgs_hubspot_contact_form_id', ''),
                'context' => array(
                    'pageUri' => wp_get_referer() ?: home_url('/contact'),
                    'pageName' => 'Contact Form'
                ),
                'required_fields' => array('firstname', 'lastname', 'email')
            ),
            'grant' => array(
                'form_id' => get_option('sgs_hubspot_grant_form_id', ''),
                'context' => array(
                    'pageUri' => wp_get_referer() ?: home_url('/grants'),
                    'pageName' => 'Grant Application'
                ),
                'required_fields' => array('firstname', 'lastname', 'email', 'company')
            ),
            'download' => array(
                'form_id' => get_option('sgs_hubspot_download_form_id', '') ?: get_option('sgs_hubspot_contact_form_id', ''),
                'context' => array(
                    'pageUri' => wp_get_referer() ?: home_url('/downloads'),
                    'pageName' => 'Download Gate'
                ),
                'required_fields' => array('firstname', 'lastname', 'email')
            )
        );
        
        return isset($configs[$form_type]) ? $configs[$form_type] : false;
    }
    
    /**
     * Submit data to HubSpot Forms API
     */
    private function submit_to_hubspot($form_id, $form_data, $context = array()) {
        if (empty($form_id)) {
            return array(
                'success' => false,
                'message' => 'Form ID not configured'
            );
        }
        
        // Format data for HubSpot API - simplified format
        $fields = array();
        foreach ($form_data as $name => $value) {
            if (!empty($value)) { // Only send non-empty values
                $fields[] = array(
                    'name' => $name,
                    'value' => sanitize_text_field($value)
                );
            }
        }
        
        $submission_data = array(
            'fields' => $fields
        );
        
        // Make API request
        $response = wp_remote_post("{$this->api_endpoint}/{$form_id}", array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode($submission_data),
            'timeout' => 30
        ));
        
        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'message' => 'Connection error: ' . $response->get_error_message()
            );
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);
        
        if ($response_code === 200) {
            return array(
                'success' => true,
                'data' => json_decode($response_body, true)
            );
        } else {
            // Log detailed error for debugging
            error_log('HubSpot API Error: ' . $response_code);
            error_log('Response Body: ' . $response_body);
            error_log('Submission Data: ' . json_encode($submission_data));
            
            $error_data = json_decode($response_body, true);
            $error_message = 'Submission failed: ' . $response_code;
            
            if ($error_data && isset($error_data['message'])) {
                $error_message .= ' - ' . $error_data['message'];
            }
            
            return array(
                'success' => false,
                'message' => $error_message,
                'debug_info' => array(
                    'response_code' => $response_code,
                    'response_body' => $response_body,
                    'sent_data' => $submission_data
                )
            );
        }
    }
}

// Initialize the HubSpot API handler
new SGS_HubSpot_API();

/**
 * Helper function to generate HubSpot form nonce
 */
function sgs_get_hubspot_form_nonce() {
    return wp_create_nonce('sgs_hubspot_form_nonce');
}