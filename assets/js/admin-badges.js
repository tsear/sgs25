/**
 * Footer Badge Management - Admin JavaScript
 * Handles adding/removing badges and WordPress media library integration
 */

jQuery(document).ready(function($) {
    let badgeIndex = $('.badge-row').length;
    console.log('Badge admin loaded. Current badge count:', badgeIndex);
    
    // Add new badge row
    $('#add-badge').on('click', function() {
        const newRow = `
            <div class="badge-row" data-index="${badgeIndex}">
                <div class="badge-preview">
                    <div class="no-image">No image selected</div>
                </div>
                
                <div class="badge-fields">
                    <input type="hidden" name="badge_image[${badgeIndex}]" value="" class="badge-image-url">
                    
                    <label>Alt Text:</label>
                    <input type="text" name="badge_alt[${badgeIndex}]" value="" placeholder="Badge description">
                    
                    <label>Link URL (optional):</label>
                    <input type="url" name="badge_link[${badgeIndex}]" value="" placeholder="https://">
                    
                    <label>
                        <input type="checkbox" name="badge_enabled[${badgeIndex}]" value="1" checked>
                        Enabled
                    </label>
                </div>
                
                <div class="badge-actions">
                    <button type="button" class="button select-image">Select Image</button>
                    <button type="button" class="button remove-badge">Remove</button>
                </div>
            </div>
        `;
        
        $('#footer-badges-container').append(newRow);
        badgeIndex++;
        console.log('Added new badge. Badge count now:', badgeIndex);
    });
    
    // Remove badge row
    $(document).on('click', '.remove-badge', function() {
        $(this).closest('.badge-row').remove();
    });
    
    // WordPress Media Library integration
    $(document).on('click', '.select-image', function(e) {
        e.preventDefault();
        
        const button = $(this);
        const row = button.closest('.badge-row');
        const previewContainer = row.find('.badge-preview');
        const imageInput = row.find('.badge-image-url');
        
        // WordPress media library
        const mediaFrame = wp.media({
            title: 'Select Badge Image',
            button: {
                text: 'Use This Image'
            },
            multiple: false,
            library: {
                type: 'image'
            }
        });
        
        // When image is selected
        mediaFrame.on('select', function() {
            const attachment = mediaFrame.state().get('selection').first().toJSON();
            
            // Update preview
            previewContainer.html(`
                <img src="${attachment.url}" alt="${attachment.alt}" style="max-width: 60px; max-height: 40px; object-fit: contain;">
            `);
            
            // Update hidden input
            imageInput.val(attachment.url);
            
            // Auto-fill alt text if empty
            const altInput = row.find('input[name*="badge_alt"]');
            if (!altInput.val() && attachment.alt) {
                altInput.val(attachment.alt);
            }
        });
        
        // Open media library
        mediaFrame.open();
    });
    
    // Debug form submission
    $('form').on('submit', function() {
        console.log('Form being submitted');
        $('.badge-row').each(function(index) {
            const imageUrl = $(this).find('.badge-image-url').val();
            const alt = $(this).find('input[name*="badge_alt"]').val();
            const enabled = $(this).find('input[name*="badge_enabled"]').is(':checked');
            console.log(`Badge ${index}: Image="${imageUrl}", Alt="${alt}", Enabled=${enabled}`);
        });
    });

    // Sortable badges (optional enhancement)
    if ($.fn.sortable) {
        $('#footer-badges-container').sortable({
            items: '.badge-row',
            handle: '.badge-preview',
            cursor: 'move',
            placeholder: 'badge-placeholder',
            update: function() {
                // Update indices after reordering
                $('#footer-badges-container .badge-row').each(function(index) {
                    const row = $(this);
                    row.attr('data-index', index);
                    
                    // Update all input names with new index
                    row.find('input[name*="badge_image"]').attr('name', `badge_image[${index}]`);
                    row.find('input[name*="badge_alt"]').attr('name', `badge_alt[${index}]`);
                    row.find('input[name*="badge_link"]').attr('name', `badge_link[${index}]`);
                    row.find('input[name*="badge_enabled"]').attr('name', `badge_enabled[${index}]`);
                });
            }
        });
    }
});
