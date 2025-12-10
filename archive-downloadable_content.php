<?php
/**
 * Archive template for Downloadable Content
 * Displays the downloads archive page at /downloads/
 */

get_header(); ?>

<main id="main" class="site-main downloads-archive">
    
    <?php get_template_part('template-parts/downloads/downloads-hero'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-search-form'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-grid'); ?>

</main>

<!-- Include the download gate modal -->
<div id="download-gate-modal" class="download-modal" style="display: none;">
    <div class="download-modal-overlay"></div>
    <div class="download-modal-content">
        <button class="download-modal-close">&times;</button>
        <div class="download-modal-body">
            <h3>Get Your Free Download</h3>
            <p>Please provide your information to access our resources. You'll only need to do this once!</p>
            
            <div id="download-hubspot-form"></div>
            
            <form id="download-fallback-form" method="post" action="#" style="display: none;">
                <div class="form-group">
                    <label for="download-first-name">First Name *</label>
                    <input type="text" id="download-first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="download-last-name">Last Name *</label>
                    <input type="text" id="download-last-name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="download-email">Email Address *</label>
                    <input type="email" id="download-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="download-organization">Organization</label>
                    <input type="text" id="download-organization" name="organization">
                </div>
                <button type="submit" class="download-submit-btn">Get Downloads Access</button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>