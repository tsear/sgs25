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

    // Testimonials Post Type (formerly Success Stories)
    register_post_type('success_story', array(
        'labels' => array(
            'name'               => __('Testimonials', 'sgs'),
            'singular_name'      => __('Testimonial', 'sgs'),
            'menu_name'          => __('Testimonials', 'sgs'),
            'add_new'            => __('Add New', 'sgs'),
            'add_new_item'       => __('Add New Testimonial', 'sgs'),
            'edit_item'          => __('Edit Testimonial', 'sgs'),
            'new_item'           => __('New Testimonial', 'sgs'),
            'view_item'          => __('View Testimonial', 'sgs'),
            'search_items'       => __('Search Testimonials', 'sgs'),
            'not_found'          => __('No testimonials found', 'sgs'),
            'not_found_in_trash' => __('No testimonials found in Trash', 'sgs'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'testimonials'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-star-filled',
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'show_in_rest'        => true,
    ));

    // Downloadable Content Post Type
    register_post_type('downloadable_content', array(
        'labels' => array(
            'name'               => __('Downloads', 'sgs'),
            'singular_name'      => __('Download', 'sgs'),
            'menu_name'          => __('Downloads', 'sgs'),
            'add_new'            => __('Add New', 'sgs'),
            'add_new_item'       => __('Add New Download', 'sgs'),
            'edit_item'          => __('Edit Download', 'sgs'),
            'new_item'           => __('New Download', 'sgs'),
            'view_item'          => __('View Download', 'sgs'),
            'search_items'       => __('Search Downloads', 'sgs'),
            'not_found'          => __('No downloads found', 'sgs'),
            'not_found_in_trash' => __('No downloads found in Trash', 'sgs'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'downloads'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-download',
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

    // Testimonial Categories (formerly Success Story Categories)
    register_taxonomy('success_story_category', 'success_story', array(
        'labels' => array(
            'name'              => __('Testimonial Categories', 'sgs'),
            'singular_name'     => __('Testimonial Category', 'sgs'),
            'search_items'      => __('Search Testimonial Categories', 'sgs'),
            'all_items'         => __('All Testimonial Categories', 'sgs'),
            'parent_item'       => __('Parent Testimonial Category', 'sgs'),
            'parent_item_colon' => __('Parent Testimonial Category:', 'sgs'),
            'edit_item'         => __('Edit Testimonial Category', 'sgs'),
            'update_item'       => __('Update Testimonial Category', 'sgs'),
            'add_new_item'      => __('Add New Testimonial Category', 'sgs'),
            'new_item_name'     => __('New Testimonial Category Name', 'sgs'),
            'menu_name'         => __('Testimonial Categories', 'sgs'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'testimonial-category'),
        'show_in_rest'      => true,
    ));

    // Download Categories
    register_taxonomy('download_category', 'downloadable_content', array(
        'labels' => array(
            'name'              => __('Download Categories', 'sgs'),
            'singular_name'     => __('Download Category', 'sgs'),
            'search_items'      => __('Search Download Categories', 'sgs'),
            'all_items'         => __('All Download Categories', 'sgs'),
            'parent_item'       => __('Parent Download Category', 'sgs'),
            'parent_item_colon' => __('Parent Download Category:', 'sgs'),
            'edit_item'         => __('Edit Download Category', 'sgs'),
            'update_item'       => __('Update Download Category', 'sgs'),
            'add_new_item'      => __('Add New Download Category', 'sgs'),
            'new_item_name'     => __('New Download Category Name', 'sgs'),
            'menu_name'         => __('Download Categories', 'sgs'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'download-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'sgs_register_taxonomies');

/**
 * Add meta boxes for downloadable content
 */
function sgs_add_downloadable_content_meta_boxes() {
    add_meta_box(
        'downloadable_content_details',
        'Download Details',
        'sgs_downloadable_content_meta_box_callback',
        'downloadable_content',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'sgs_add_downloadable_content_meta_boxes');

/**
 * Meta box callback for downloadable content
 */
function sgs_downloadable_content_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('sgs_downloadable_content_meta_box', 'sgs_downloadable_content_meta_box_nonce');

    // Get current values
    $file_attachment = get_post_meta($post->ID, '_download_file_attachment', true);
    $file_size = get_post_meta($post->ID, '_download_file_size', true);
    $file_type = get_post_meta($post->ID, '_download_file_type', true);
    $download_count = get_post_meta($post->ID, '_download_count', true);
    $featured = get_post_meta($post->ID, '_download_featured', true);
    $preview_text = get_post_meta($post->ID, '_download_preview_text', true);
    $author_name = get_post_meta($post->ID, '_download_author', true);
    $publish_date = get_post_meta($post->ID, '_download_publish_date', true);
    $tags = get_post_meta($post->ID, '_download_tags', true);
    ?>
    
    <style>
        .sgs-meta-row { margin-bottom: 20px; }
        .sgs-meta-row label { display: block; font-weight: bold; margin-bottom: 5px; }
        .sgs-meta-row input[type="text"], 
        .sgs-meta-row input[type="number"], 
        .sgs-meta-row input[type="date"], 
        .sgs-meta-row select, 
        .sgs-meta-row textarea { width: 100%; }
        .sgs-meta-row textarea { height: 100px; }
        .sgs-meta-row small { color: #666; font-style: italic; }
        .sgs-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .sgs-meta-full { grid-column: 1 / -1; }
    </style>

    <div class="sgs-meta-grid">
        
        <!-- File Attachment -->
        <div class="sgs-meta-row sgs-meta-full">
            <label for="download_file_attachment">Download File</label>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="hidden" id="download_file_attachment" name="download_file_attachment" value="<?php echo esc_attr($file_attachment); ?>" />
                <input type="text" id="download_file_attachment_url" readonly value="<?php echo $file_attachment ? wp_get_attachment_url($file_attachment) : ''; ?>" style="flex: 1;" />
                <button type="button" class="button" id="upload_file_button">Select File</button>
                <button type="button" class="button" id="remove_file_button" <?php echo !$file_attachment ? 'style="display:none;"' : ''; ?>>Remove</button>
            </div>
            <small>Upload the file that users will download (PDF, DOC, XLS, etc.)</small>
        </div>

        <!-- File Type -->
        <div class="sgs-meta-row">
            <label for="download_file_type">File Type</label>
            <select id="download_file_type" name="download_file_type">
                <option value="">Select Type</option>
                <option value="PDF Guide" <?php selected($file_type, 'PDF Guide'); ?>>PDF Guide</option>
                <option value="Checklist" <?php selected($file_type, 'Checklist'); ?>>Checklist</option>
                <option value="Template" <?php selected($file_type, 'Template'); ?>>Template</option>
                <option value="Whitepaper" <?php selected($file_type, 'Whitepaper'); ?>>Whitepaper</option>
                <option value="Spreadsheet" <?php selected($file_type, 'Spreadsheet'); ?>>Spreadsheet</option>
                <option value="Presentation" <?php selected($file_type, 'Presentation'); ?>>Presentation</option>
                <option value="Video" <?php selected($file_type, 'Video'); ?>>Video</option>
                <option value="Audio" <?php selected($file_type, 'Audio'); ?>>Audio</option>
                <option value="Other" <?php selected($file_type, 'Other'); ?>>Other</option>
            </select>
        </div>

        <!-- File Size -->
        <div class="sgs-meta-row">
            <label for="download_file_size">File Size</label>
            <input type="text" id="download_file_size" name="download_file_size" value="<?php echo esc_attr($file_size); ?>" placeholder="e.g., 2.5 MB" />
            <small>Will be auto-detected if left blank</small>
        </div>

        <!-- Author -->
        <div class="sgs-meta-row">
            <label for="download_author">Author/Creator</label>
            <input type="text" id="download_author" name="download_author" value="<?php echo esc_attr($author_name); ?>" placeholder="e.g., SGS Team" />
        </div>

        <!-- Publish Date -->
        <div class="sgs-meta-row">
            <label for="download_publish_date">Publish Date</label>
            <input type="date" id="download_publish_date" name="download_publish_date" value="<?php echo esc_attr($publish_date); ?>" />
        </div>

        <!-- Featured -->
        <div class="sgs-meta-row">
            <label>
                <input type="checkbox" name="download_featured" value="1" <?php checked($featured, '1'); ?> />
                Featured Download
            </label>
            <small>Featured downloads appear first in listings</small>
        </div>

        <!-- Download Count (read-only) -->
        <div class="sgs-meta-row">
            <label for="download_count">Download Count</label>
            <input type="number" id="download_count" name="download_count" value="<?php echo esc_attr($download_count ?: 0); ?>" readonly />
            <small>Automatically tracked</small>
        </div>

        <!-- Preview Text -->
        <div class="sgs-meta-row sgs-meta-full">
            <label for="download_preview_text">Preview/Description Text</label>
            <textarea id="download_preview_text" name="download_preview_text" placeholder="Brief description that appears on the download card..."><?php echo esc_textarea($preview_text); ?></textarea>
            <small>This text appears on the download card. If left blank, excerpt will be used.</small>
        </div>

        <!-- Tags -->
        <div class="sgs-meta-row sgs-meta-full">
            <label for="download_tags">Tags</label>
            <input type="text" id="download_tags" name="download_tags" value="<?php echo esc_attr($tags); ?>" placeholder="grant management, compliance, financial, templates" />
            <small>Comma-separated tags for better organization and search</small>
        </div>

    </div>

    <script>
    jQuery(document).ready(function($) {
        // Media uploader
        var mediaUploader;
        
        $('#upload_file_button').click(function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media({
                title: 'Select Download File',
                button: {
                    text: 'Use this file'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#download_file_attachment').val(attachment.id);
                $('#download_file_attachment_url').val(attachment.url);
                $('#remove_file_button').show();
                
                // Auto-fill file type and size if not set
                if (!$('#download_file_type').val()) {
                    var ext = attachment.filename.split('.').pop().toLowerCase();
                    if (ext === 'pdf') $('#download_file_type').val('PDF Guide');
                    else if (['doc', 'docx'].includes(ext)) $('#download_file_type').val('Template');
                    else if (['xls', 'xlsx'].includes(ext)) $('#download_file_type').val('Spreadsheet');
                    else if (['ppt', 'pptx'].includes(ext)) $('#download_file_type').val('Presentation');
                }
                
                if (!$('#download_file_size').val() && attachment.filesizeHumanReadable) {
                    $('#download_file_size').val(attachment.filesizeHumanReadable);
                }
            });
            
            mediaUploader.open();
        });
        
        $('#remove_file_button').click(function(e) {
            e.preventDefault();
            $('#download_file_attachment').val('');
            $('#download_file_attachment_url').val('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Save meta box data
 */
function sgs_save_downloadable_content_meta_box($post_id) {
    // Check if nonce is valid
    if (!isset($_POST['sgs_downloadable_content_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['sgs_downloadable_content_meta_box_nonce'], 'sgs_downloadable_content_meta_box')) {
        return;
    }

    // Check if user has permission
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save all meta fields
    $meta_fields = [
        'download_file_attachment' => 'sanitize_text_field',
        'download_file_size' => 'sanitize_text_field',
        'download_file_type' => 'sanitize_text_field',
        'download_count' => 'absint',
        'download_featured' => 'sanitize_text_field',
        'download_preview_text' => 'sanitize_textarea_field',
        'download_author' => 'sanitize_text_field',
        'download_publish_date' => 'sanitize_text_field',
        'download_tags' => 'sanitize_text_field'
    ];

    foreach ($meta_fields as $field => $sanitize_callback) {
        $meta_key = '_' . $field;
        $meta_value = isset($_POST[$field]) ? call_user_func($sanitize_callback, $_POST[$field]) : '';
        update_post_meta($post_id, $meta_key, $meta_value);
    }
}
add_action('save_post', 'sgs_save_downloadable_content_meta_box');

/**
 * Track download count
 */
function sgs_track_download() {
    if (!isset($_POST['download_id']) || !wp_verify_nonce($_POST['nonce'], 'sgs_nonce')) {
        wp_die('Security check failed');
    }

    $download_id = intval($_POST['download_id']);
    $current_count = get_post_meta($download_id, '_download_count', true);
    $new_count = $current_count ? $current_count + 1 : 1;
    
    update_post_meta($download_id, '_download_count', $new_count);
    
    wp_send_json_success(array('count' => $new_count));
}
add_action('wp_ajax_sgs_track_download', 'sgs_track_download');
add_action('wp_ajax_nopriv_sgs_track_download', 'sgs_track_download');

/**
 * Helper function to get file icon based on file type
 */
function sgs_get_file_type_icon($file_type) {
    $icons = array(
        'PDF Guide' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'Checklist' => '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'Template' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="m3 9 18 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'Whitepaper' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'Spreadsheet' => '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 9h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 15h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'Presentation' => '<svg viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="4" width="18" height="12" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="7" y1="20" x2="17" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="12" y1="16" x2="12" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    );
    
    return isset($icons[$file_type]) ? $icons[$file_type] : $icons['PDF Guide'];
}
