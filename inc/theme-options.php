<?php
/**
 * Theme Options
 *
 * @package SmartGrantSolutions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme options page
 */
function sgs_add_theme_options_page() {
    add_theme_page(
        __('Theme Options', 'sgs'),
        __('Theme Options', 'sgs'),
        'manage_options',
        'sgs-theme-options',
        'sgs_theme_options_page'
    );
}
add_action('admin_menu', 'sgs_add_theme_options_page');

/**
 * Theme options page content
 */
function sgs_theme_options_page() {
    if (isset($_POST['submit'])) {
        update_option('sgs_contact_email', sanitize_email($_POST['sgs_contact_email']));
        update_option('sgs_contact_phone', sanitize_text_field($_POST['sgs_contact_phone']));
        update_option('sgs_social_facebook', esc_url_raw($_POST['sgs_social_facebook']));
        update_option('sgs_social_twitter', esc_url_raw($_POST['sgs_social_twitter']));
        update_option('sgs_social_linkedin', esc_url_raw($_POST['sgs_social_linkedin']));
        update_option('sgs_footer_text', wp_kses_post($_POST['sgs_footer_text']));
    // HubSpot IDs
    update_option('sgs_hubspot_portal_id', sanitize_text_field($_POST['sgs_hubspot_portal_id']));
    update_option('sgs_hubspot_newsletter_form_id', sanitize_text_field($_POST['sgs_hubspot_newsletter_form_id']));
    update_option('sgs_hubspot_contact_form_id', sanitize_text_field($_POST['sgs_hubspot_contact_form_id']));
    update_option('sgs_hubspot_grant_form_id', sanitize_text_field($_POST['sgs_hubspot_grant_form_id']));
        
        // Save footer badges
        sgs_save_footer_badges();
        
        echo '<div class="notice notice-success is-dismissible"><p>' . __('Settings saved.', 'sgs') . '</p></div>';
    }

    $contact_email = get_option('sgs_contact_email', '');
    $contact_phone = get_option('sgs_contact_phone', '');
    $social_facebook = get_option('sgs_social_facebook', '');
    $social_twitter = get_option('sgs_social_twitter', '');
    $social_linkedin = get_option('sgs_social_linkedin', '');
    $footer_text = get_option('sgs_footer_text', '');
    $hubspot_portal_id = get_option('sgs_hubspot_portal_id', '');
    $hubspot_newsletter_form_id = get_option('sgs_hubspot_newsletter_form_id', '');
    $hubspot_contact_form_id = get_option('sgs_hubspot_contact_form_id', '');
    $hubspot_grant_form_id = get_option('sgs_hubspot_grant_form_id', '');
    ?>
    <div class="wrap">
        <h1><?php _e('Theme Options', 'sgs'); ?></h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('sgs_theme_options', 'sgs_theme_options_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th colspan="2"><h2><?php _e('HubSpot Integration', 'sgs'); ?></h2></th>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="sgs_hubspot_portal_id"><?php _e('HubSpot Portal ID', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="sgs_hubspot_portal_id" name="sgs_hubspot_portal_id" value="<?php echo esc_attr($hubspot_portal_id); ?>" class="regular-text" />
                        <p class="description"><?php _e('Used when submitting native forms to HubSpot Forms API.', 'sgs'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="sgs_hubspot_newsletter_form_id"><?php _e('Newsletter Form ID (GUID)', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="sgs_hubspot_newsletter_form_id" name="sgs_hubspot_newsletter_form_id" value="<?php echo esc_attr($hubspot_newsletter_form_id); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="sgs_hubspot_contact_form_id"><?php _e('Contact Form ID (GUID)', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="sgs_hubspot_contact_form_id" name="sgs_hubspot_contact_form_id" value="<?php echo esc_attr($hubspot_contact_form_id); ?>" class="regular-text" />
                        <p class="description"><?php _e('Used for embedded HubSpot contact form. Make sure CAPTCHA is enabled in HubSpot form settings.', 'sgs'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="sgs_hubspot_grant_form_id"><?php _e('Grant Application Form ID (GUID)', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="sgs_hubspot_grant_form_id" name="sgs_hubspot_grant_form_id" value="<?php echo esc_attr($hubspot_grant_form_id); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="sgs_contact_email"><?php _e('Contact Email', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="email" id="sgs_contact_email" name="sgs_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="sgs_contact_phone"><?php _e('Contact Phone', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="sgs_contact_phone" name="sgs_contact_phone" value="<?php echo esc_attr($contact_phone); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="sgs_social_facebook"><?php _e('Facebook URL', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="url" id="sgs_social_facebook" name="sgs_social_facebook" value="<?php echo esc_attr($social_facebook); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="sgs_social_twitter"><?php _e('Twitter URL', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="url" id="sgs_social_twitter" name="sgs_social_twitter" value="<?php echo esc_attr($social_twitter); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="sgs_social_linkedin"><?php _e('LinkedIn URL', 'sgs'); ?></label>
                    </th>
                    <td>
                        <input type="url" id="sgs_social_linkedin" name="sgs_social_linkedin" value="<?php echo esc_attr($social_linkedin); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="sgs_footer_text"><?php _e('Footer Text', 'sgs'); ?></label>
                    </th>
                    <td>
                        <textarea id="sgs_footer_text" name="sgs_footer_text" rows="4" cols="50" class="large-text"><?php echo esc_textarea($footer_text); ?></textarea>
                        <p class="description"><?php _e('Custom text to display in the footer.', 'sgs'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label><?php _e('Footer Badges', 'sgs'); ?></label>
                    </th>
                    <td>
                        <div id="footer-badges-container">
                            <?php 
                            $badges = sgs_get_footer_badges();
                            echo '<!-- DEBUG: Retrieved ' . count($badges) . ' badges from database -->';
                            if (empty($badges)) {
                                // Default badges
                                $badges = [
                                    [
                                        'image' => get_template_directory_uri() . '/assets/images/get-app.png',
                                        'alt' => 'GetApp Recognition',
                                        'link' => '',
                                        'enabled' => true
                                    ],
                                    [
                                        'image' => get_template_directory_uri() . '/assets/images/software-advice.png',
                                        'alt' => 'Software Advice Badge',
                                        'link' => '',
                                        'enabled' => true
                                    ]
                                ];
                            }
                            
                            foreach ($badges as $index => $badge) {
                                sgs_render_badge_row($badge, $index);
                            }
                            ?>
                        </div>
                        <button type="button" id="add-badge" class="button"><?php _e('Add Badge', 'sgs'); ?></button>
                        <p class="description"><?php _e('Manage badges displayed in the footer carousel. Images will auto-rotate every 4 seconds.', 'sgs'); ?></p>
                        <?php wp_nonce_field('sgs_footer_badges_action', 'sgs_footer_badges_nonce'); ?>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Helper functions to get theme options
 */
function sgs_get_contact_email() {
    return get_option('sgs_contact_email', '');
}

function sgs_get_contact_phone() {
    return get_option('sgs_contact_phone', '');
}

function sgs_get_social_facebook() {
    return get_option('sgs_social_facebook', '');
}

function sgs_get_social_twitter() {
    return get_option('sgs_social_twitter', '');
}

function sgs_get_social_linkedin() {
    return get_option('sgs_social_linkedin', '');
}

function sgs_get_footer_text() {
    return get_option('sgs_footer_text', '');
}

// HubSpot helpers
function sgs_get_hubspot_portal_id() {
    return get_option('sgs_hubspot_portal_id', '');
}

function sgs_get_hubspot_form_id($key) {
    $map = array(
        'newsletter' => get_option('sgs_hubspot_newsletter_form_id', ''),
        'contact' => get_option('sgs_hubspot_contact_form_id', ''),
        'grant' => get_option('sgs_hubspot_grant_form_id', ''),
    );
    return isset($map[$key]) ? $map[$key] : '';
}

/**
 * Footer Badge Management Functions
 */

/**
 * Save footer badges from admin form
 */
function sgs_save_footer_badges() {
    if (!isset($_POST['sgs_footer_badges_nonce']) || 
        !wp_verify_nonce($_POST['sgs_footer_badges_nonce'], 'sgs_footer_badges_action')) {
        error_log('Badge save failed: Nonce verification failed');
        return;
    }
    
    $badges = [];
    
    if (isset($_POST['badge_image']) && is_array($_POST['badge_image'])) {
        error_log('Processing ' . count($_POST['badge_image']) . ' badge images from POST');
        foreach ($_POST['badge_image'] as $index => $image_url) {
            error_log("Badge $index: Image URL = '$image_url'");
            if (!empty($image_url)) {
                $badge_data = [
                    'image' => esc_url_raw($image_url),
                    'alt' => sanitize_text_field($_POST['badge_alt'][$index] ?? ''),
                    'link' => esc_url_raw($_POST['badge_link'][$index] ?? ''),
                    'enabled' => isset($_POST['badge_enabled'][$index]) && $_POST['badge_enabled'][$index] == '1'
                ];
                $badges[] = $badge_data;
                error_log("Badge $index saved: " . print_r($badge_data, true));
            } else {
                error_log("Badge $index skipped: empty image URL");
            }
        }
    } else {
        error_log('No badge_image POST data found');
    }
    
    error_log('POST data for badges: ' . print_r($_POST, true));
    
    update_option('sgs_footer_badges', $badges);
    error_log('Footer badges saved: ' . count($badges) . ' badges');
    error_log('Badge data: ' . print_r($badges, true));
}

/**
 * Get footer badges
 */
function sgs_get_footer_badges() {
    return get_option('sgs_footer_badges', []);
}

/**
 * Render a single badge row in admin
 */
function sgs_render_badge_row($badge = [], $index = 0) {
    $image = $badge['image'] ?? '';
    $alt = $badge['alt'] ?? '';
    $link = $badge['link'] ?? '';
    $enabled = $badge['enabled'] ?? true;
    ?>
    <div class="badge-row" data-index="<?php echo $index; ?>">
        <div class="badge-preview">
            <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>" style="max-width: 60px; max-height: 40px; object-fit: contain;">
            <?php else : ?>
                <div class="no-image"><?php _e('No image selected', 'sgs'); ?></div>
            <?php endif; ?>
        </div>
        
        <div class="badge-fields">
            <input type="hidden" name="badge_image[<?php echo $index; ?>]" value="<?php echo esc_attr($image); ?>" class="badge-image-url">
            
            <label><?php _e('Alt Text:', 'sgs'); ?></label>
            <input type="text" name="badge_alt[<?php echo $index; ?>]" value="<?php echo esc_attr($alt); ?>" placeholder="Badge description">
            
            <label><?php _e('Link URL (optional):', 'sgs'); ?></label>
            <input type="url" name="badge_link[<?php echo $index; ?>]" value="<?php echo esc_attr($link); ?>" placeholder="https://">
            
            <label>
                <input type="checkbox" name="badge_enabled[<?php echo $index; ?>]" value="1" <?php checked($enabled); ?>>
                <?php _e('Enabled', 'sgs'); ?>
            </label>
        </div>
        
        <div class="badge-actions">
            <button type="button" class="button select-image"><?php _e('Select Image', 'sgs'); ?></button>
            <button type="button" class="button remove-badge"><?php _e('Remove', 'sgs'); ?></button>
        </div>
    </div>
    <?php
}

/**
 * Add admin scripts for badge management
 */
function sgs_admin_scripts($hook) {
    if ($hook !== 'appearance_page_sgs-theme-options') {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script('sgs-admin-badges', get_template_directory_uri() . '/assets/js/admin-badges.js', ['jquery'], '1.0.0', true);
    wp_enqueue_style('sgs-admin-badges', get_template_directory_uri() . '/assets/css/admin-badges.css', [], '1.0.0');
}
add_action('admin_enqueue_scripts', 'sgs_admin_scripts');
