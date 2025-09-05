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
        
        echo '<div class="notice notice-success is-dismissible"><p>' . __('Settings saved.', 'sgs') . '</p></div>';
    }

    $contact_email = get_option('sgs_contact_email', '');
    $contact_phone = get_option('sgs_contact_phone', '');
    $social_facebook = get_option('sgs_social_facebook', '');
    $social_twitter = get_option('sgs_social_twitter', '');
    $social_linkedin = get_option('sgs_social_linkedin', '');
    $footer_text = get_option('sgs_footer_text', '');
    ?>
    <div class="wrap">
        <h1><?php _e('Theme Options', 'sgs'); ?></h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('sgs_theme_options', 'sgs_theme_options_nonce'); ?>
            
            <table class="form-table">
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
