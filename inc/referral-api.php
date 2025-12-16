<?php
/**
 * Referral System - HubSpot API Integration
 * 
 * All referral tracking done via HubSpot API
 * No WordPress database storage
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper: Make HubSpot API request with proper authentication
 * Supports both Private App tokens (Bearer) and Legacy API Keys (hapikey)
 */
function sgs_hubspot_request($url, $method = 'GET', $body = null) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return new WP_Error('no_api_key', 'HubSpot API key not configured');
    }
    
    // Check if it's a Private App token (starts with pat-) or Legacy API key
    $is_private_app = strpos($api_key, 'pat-') === 0;
    
    $args = array(
        'timeout' => 15
    );
    
    if ($is_private_app) {
        // Use Bearer token authentication
        $args['headers'] = array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        );
    } else {
        // Use legacy API key in query string
        $url .= (strpos($url, '?') === false ? '?' : '&') . 'hapikey=' . $api_key;
        $args['headers'] = array(
            'Content-Type' => 'application/json'
        );
    }
    
    if ($body !== null) {
        $args['body'] = is_array($body) ? json_encode($body) : $body;
    }
    
    if ($method === 'GET') {
        return wp_remote_get($url, $args);
    } elseif ($method === 'POST') {
        return wp_remote_post($url, $args);
    } elseif ($method === 'PATCH') {
        $args['method'] = 'PATCH';
        return wp_remote_request($url, $args);
    } elseif ($method === 'PUT') {
        $args['method'] = 'PUT';
        return wp_remote_request($url, $args);
    }
    
    return new WP_Error('invalid_method', 'Invalid HTTP method');
}

/**
 * Generate referral code and create HubSpot contact
 * Called via AJAX after user submits referral signup form
 */
function sgs_api_generate_referral_code() {
    // Verify nonce
    check_ajax_referer('sgs_referral_signup', 'nonce');
    
    error_log('🔥 REFERRAL API: Starting code generation');
    
    // Get form data
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $organization = sanitize_text_field($_POST['organization']);
    $custom_code = sanitize_text_field($_POST['custom_code']);
    
    error_log("📧 Email: {$email}, Name: {$first_name} {$last_name}, Org: {$organization}");
    
    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($organization)) {
        error_log('❌ Missing required fields');
        wp_send_json_error(array(
            'message' => 'Missing required information.'
        ));
    }
    
    // Generate referral code
    if (!empty($custom_code)) {
        error_log("🎯 Using custom code: {$custom_code}");
        // Validate custom code
        if (!preg_match('/^[a-zA-Z0-9]{6,20}$/', $custom_code)) {
            error_log('❌ Custom code validation failed');
            wp_send_json_error(array(
                'message' => 'Referral code must be 6-20 alphanumeric characters.'
            ));
        }
        
        // Check if code exists in HubSpot
        $code_exists = sgs_hubspot_check_code_exists($custom_code);
        if ($code_exists) {
            error_log('❌ Custom code already exists');
            wp_send_json_error(array(
                'message' => 'This referral code is already taken.'
            ));
        }
        
        $referral_code = $custom_code;
    } else {
        // Auto-generate code
        error_log('🎲 Auto-generating code');
        $referral_code = sgs_hubspot_generate_unique_code($first_name, $last_name);
        error_log("✅ Generated code: {$referral_code}");
    }
    
    // Create or update HubSpot contact with referral code
    error_log("🚀 Creating HubSpot contact with code: {$referral_code}");
    $contact_id = sgs_hubspot_create_referral_contact($email, $first_name, $last_name, $organization, $referral_code);
    
    if (!$contact_id) {
        error_log('❌ FAILED to create HubSpot contact');
        wp_send_json_error(array(
            'message' => 'Failed to create referral code. Please try again.'
        ));
    }
    
    error_log("✅ Contact created! ID: {$contact_id}");
    
    // Build referral link
    $referral_link = home_url('/contact/?referral_source=' . $referral_code);
    
    // Return success (no email sent - all communication via CRM)
    wp_send_json_success(array(
        'message' => 'Referral link created successfully!',
        'referral_code' => $referral_code,
        'referral_link' => $referral_link
    ));
}
add_action('wp_ajax_sgs_generate_referral_link', 'sgs_api_generate_referral_code');
add_action('wp_ajax_nopriv_sgs_generate_referral_link', 'sgs_api_generate_referral_code');

/**
 * Check if referral code exists in HubSpot
 */
function sgs_hubspot_check_code_exists($code) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return false;
    }
    
    // Search for contacts with this specific referral_code
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'referral_code',
                        'operator' => 'EQ',
                        'value' => $code
                    )
                )
            )
        ),
        'limit' => 1
    );
    
    $response = sgs_hubspot_request($url, 'POST', $body);
    
    if (is_wp_error($response)) {
        error_log('HubSpot API error: ' . $response->get_error_message());
        return false;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    // Code exists if we found results
    return !empty($data['results']);
}

/**
 * Generate unique referral code (check HubSpot for uniqueness)
 */
function sgs_hubspot_generate_unique_code($first_name, $last_name) {
    // Clean and create base code
    $clean_first = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($first_name));
    $clean_last = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($last_name));
    $base = substr($clean_first, 0, 4) . substr($clean_last, 0, 4);
    
    // Try base code
    if (!sgs_hubspot_check_code_exists($base) && strlen($base) >= 6) {
        return $base;
    }
    
    // Add random suffix
    $attempts = 0;
    while ($attempts < 100) {
        $suffix = substr(md5(uniqid()), 0, 4);
        $code = substr($base . $suffix, 0, 20);
        
        if (!sgs_hubspot_check_code_exists($code) && strlen($code) >= 6) {
            return $code;
        }
        $attempts++;
    }
    
    // Fallback
    return substr(md5(uniqid()), 0, 12);
}

/**
 * Create or update HubSpot contact with referral code
 * 
 * @return int|false Contact ID on success, false on failure
 */
function sgs_hubspot_create_referral_contact($email, $first_name, $last_name, $organization, $referral_code) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    error_log("📞 sgs_hubspot_create_referral_contact called");
    error_log("   Email: {$email}");
    error_log("   Code: {$referral_code}");
    error_log("   API Key present: " . (!empty($api_key) ? 'YES' : 'NO'));
    
    if (empty($api_key)) {
        error_log('❌ HubSpot API key not configured');
        return false;
    }
    
    // Prepare contact properties
    $properties = array(
        'email' => $email,
        'firstname' => $first_name,
        'lastname' => $last_name,
        'referral_code' => $referral_code
    );
    
    if (!empty($organization)) {
        $properties['company'] = $organization;
    }
    
    error_log('📦 Properties: ' . json_encode($properties));
    
    // Create or update contact (upsert)
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts';
    
    $body = array(
        'properties' => $properties
    );
    
    error_log('🌐 Making request to: ' . $url);
    $response = sgs_hubspot_request($url, 'POST', $body);
    
    if (is_wp_error($response)) {
        error_log('❌ HubSpot contact creation failed (WP_Error): ' . $response->get_error_message());
        return false;
    }
    
    $status_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);
    $data = json_decode($response_body, true);
    
    error_log("📡 Response Status: {$status_code}");
    error_log("📡 Response Body: {$response_body}");
    
    // Check if contact already exists (409 conflict)
    if ($status_code === 409) {
        error_log('⚠️ Contact already exists (409 conflict)');
        // Contact exists, update instead
        if (!empty($data['message']) && preg_match('/Contact already exists\. Existing ID: (\d+)/', $data['message'], $matches)) {
            $contact_id = $matches[1];
            error_log("🔄 Updating existing contact: {$contact_id}");
            
            // Update existing contact
            $update_url = 'https://api.hubapi.com/crm/v3/objects/contacts/' . $contact_id;
            
            $update_response = sgs_hubspot_request($update_url, 'PATCH', $body);
            
            if (is_wp_error($update_response)) {
                error_log('❌ HubSpot contact update failed: ' . $update_response->get_error_message());
                return false;
            }
            
            error_log('✅ Contact updated successfully');
            return $contact_id;
        }
    }
    
    // Success - return contact ID
    if ($status_code === 201 && !empty($data['id'])) {
        error_log('✅ New contact created! ID: ' . $data['id']);
        return $data['id'];
    }
    
    error_log('❌ HubSpot API unexpected response');
    error_log('   Status: ' . $status_code);
    error_log('   Body: ' . $response_body);
    return false;
}

/**
 * Fetch all referral contacts from HubSpot with conversion counts
 */
function sgs_fetch_referrals_from_hubspot() {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return array();
    }
    
    // Search for all contacts with a referral_code property (referrers)
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'referral_code',
                        'operator' => 'HAS_PROPERTY'
                    )
                )
            )
        ),
        'properties' => array(
            'email',
            'firstname',
            'lastname',
            'company',
            'referral_code',
            'createdate'
        ),
        'limit' => 100
    );
    
    $response = sgs_hubspot_request($url, 'POST', $body);
    
    if (is_wp_error($response)) {
        error_log('HubSpot API error fetching referrers: ' . $response->get_error_message());
        return array();
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    if (empty($data['results'])) {
        return array();
    }
    
    // Format results for admin table
    $referrals = array();
    
    foreach ($data['results'] as $contact) {
        $props = $contact['properties'];
        $code = $props['referral_code'] ?? '';
        
        if (empty($code)) {
            continue;
        }
        
        $referrals[$code] = array(
            'first_name' => $props['firstname'] ?? '',
            'last_name' => $props['lastname'] ?? '',
            'email' => $props['email'] ?? '',
            'organization' => $props['company'] ?? 'N/A',
            'created_at' => !empty($props['createdate']) ? date('Y-m-d H:i:s', strtotime($props['createdate'])) : 'N/A',
            'hubspot_contact_id' => $contact['id'],
            'conversion_count' => 0,
            'referrals' => array()
        );
    }
    
    // Now fetch all contacts with referral_source property (converted leads)
    $conversions_url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $conversions_body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'referral_source',
                        'operator' => 'HAS_PROPERTY'
                    )
                )
            )
        ),
        'properties' => array(
            'email',
            'firstname',
            'lastname',
            'referral_source',
            'createdate'
        ),
        'limit' => 100
    );
    
    $conversions_response = sgs_hubspot_request($conversions_url, 'POST', $conversions_body);
    
    if (!is_wp_error($conversions_response)) {
        $conversions_data = json_decode(wp_remote_retrieve_body($conversions_response), true);
        
        if (!empty($conversions_data['results'])) {
            // Match conversions to referral codes
            foreach ($conversions_data['results'] as $converted_contact) {
                $converted_props = $converted_contact['properties'];
                $source_code = $converted_props['referral_source'] ?? '';
                
                if (!empty($source_code) && isset($referrals[$source_code])) {
                    $referrals[$source_code]['conversion_count']++;
                    $referrals[$source_code]['referrals'][] = array(
                        'email' => $converted_props['email'] ?? '',
                        'first_name' => $converted_props['firstname'] ?? '',
                        'last_name' => $converted_props['lastname'] ?? '',
                        'created_at' => !empty($converted_props['createdate']) ? date('Y-m-d H:i:s', strtotime($converted_props['createdate'])) : 'N/A'
                    );
                }
            }
        }
    }
    
    return $referrals;
}

/**
 * Track referral click - update HubSpot contact property
 * Called when ?ref= parameter detected
 */
function sgs_hubspot_track_click($referral_code) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return false;
    }
    
    // Find contact with this referral code
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'referral_code',
                        'operator' => 'EQ',
                        'value' => $referral_code
                    )
                )
            )
        ),
        'limit' => 1
    );
    
    $response = sgs_hubspot_request($url, 'POST', $body);
    
    if (is_wp_error($response)) {
        return false;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    if (empty($data['results'][0]['id'])) {
        return false;
    }
    
    $contact_id = $data['results'][0]['id'];
    $current_clicks = intval($data['results'][0]['properties']['referral_clicks'] ?? 0);
    
    // Increment click counter (assuming you have a referral_clicks property)
    $update_url = 'https://api.hubapi.com/crm/v3/objects/contacts/' . $contact_id;
    
    $update_response = wp_remote_request($update_url, array(
        'method' => 'PATCH',
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode(array(
            'properties' => array(
                'referral_clicks' => $current_clicks + 1,
                'last_referral_click' => date('Y-m-d\TH:i:s\Z')
            )
        )),
        'timeout' => 15
    ));
    
    return !is_wp_error($update_response);
}

/**
 * Track referral conversion - create association in HubSpot
 * Called when someone with ?ref= param submits a form
 */
function sgs_hubspot_track_conversion($referral_code, $converted_contact_email) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return false;
    }
    
    // Find referrer contact
    $referrer_id = sgs_hubspot_get_contact_by_referral_code($referral_code);
    
    if (!$referrer_id) {
        error_log("Referrer not found for code: {$referral_code}");
        return false;
    }
    
    // Find converted contact by email
    $converted_id = sgs_hubspot_get_contact_by_email($converted_contact_email);
    
    if (!$converted_id) {
        error_log("Converted contact not found: {$converted_contact_email}");
        return false;
    }
    
    // Create association (type 15 = "Referred")
    // You may need to create a custom association type in HubSpot
    $assoc_url = "https://api.hubapi.com/crm/v3/objects/contacts/{$referrer_id}/associations/contacts/{$converted_id}/15";
    
    $response = wp_remote_request($assoc_url, array(
        'method' => 'PUT',
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'timeout' => 15
    ));
    
    return !is_wp_error($response);
}

/**
 * Helper: Get contact ID by referral code
 */
function sgs_hubspot_get_contact_by_referral_code($code) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return false;
    }
    
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'referral_code',
                        'operator' => 'EQ',
                        'value' => $code
                    )
                )
            )
        ),
        'limit' => 1
    );
    
    $response = wp_remote_post($url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode($body),
        'timeout' => 15
    ));
    
    if (is_wp_error($response)) {
        return false;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    return $data['results'][0]['id'] ?? false;
}

/**
 * Helper: Get contact ID by email
 */
function sgs_hubspot_get_contact_by_email($email) {
    $api_key = get_option('sgs_hubspot_api_key');
    
    if (empty($api_key)) {
        return false;
    }
    
    $url = 'https://api.hubapi.com/crm/v3/objects/contacts/search';
    
    $body = array(
        'filterGroups' => array(
            array(
                'filters' => array(
                    array(
                        'propertyName' => 'email',
                        'operator' => 'EQ',
                        'value' => $email
                    )
                )
            )
        ),
        'limit' => 1
    );
    
    $response = wp_remote_post($url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode($body),
        'timeout' => 15
    ));
    
    if (is_wp_error($response)) {
        return false;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    return $data['results'][0]['id'] ?? false;
}
