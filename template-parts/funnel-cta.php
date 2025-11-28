<?php
/**
 * Funnel CTA Section - Knowledge Resources
 * 
 * Lightweight, clean partial directing users to downloadable content
 * including whitepapers, checklists, and MissionGranted resources
 *
 * @package SGS_Theme
 */

// Define downloadable resources
$resources = [
    [
        'title' => 'Ultimate Grant Management Whitepaper',
        'description' => 'Master the functionality of MissionGranted with our comprehensive guide to advanced grant management strategies.',
        'type' => 'PDF Guide',
        'icon' => 'document-text',
        'download_url' => home_url('/downloads'),
        'featured' => false
    ],
    [
        'title' => 'Financial Compliance Checklist', 
        'description' => 'Free essential financial checklist for managing grants and ensuring compliance across the award lifecycle.',
        'type' => 'Checklist',
        'icon' => 'clipboard-check',
        'download_url' => home_url('/downloads'),
        'featured' => false
    ],
    [
        'title' => 'Grant Opportunity Tracker',
        'description' => 'Manage all of your grant award information in one place so you are always audit ready.',
        'type' => 'Template',
        'icon' => 'table',
        'download_url' => home_url('/downloads'),
        'featured' => false
    ]
];
?>

<section class="funnel-cta-section" id="resources">
    <!-- Top divider line -->
    <div class="funnel-cta__top-line"></div>
    
    <div class="funnel-cta__container">
        
        <!-- Header -->
        <div class="funnel-cta__header">
            <h2 class="funnel-cta__title">
                Free <span class="brand-secondary">Grant Management</span> Resources
            </h2>
            <p class="funnel-cta__subtitle">
                Download our expert guides and tools to streamline your grant management process
            </p>
        </div>
        
        <!-- Resources Grid -->
        <div class="funnel-cta__grid">
            <?php foreach ($resources as $index => $resource) : ?>
                <div class="funnel-cta__card <?php echo $resource['featured'] ? 'funnel-cta__card--featured' : ''; ?>" data-resource="<?php echo $index; ?>">
                    
                    <!-- Resource Type Badge -->
                    <div class="funnel-cta__badge">
                        <?php echo esc_html($resource['type']); ?>
                    </div>
                    
                    <!-- Icon -->
                    <div class="funnel-cta__icon">
                        <?php if ($resource['icon'] === 'document-text') : ?>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php elseif ($resource['icon'] === 'clipboard-check') : ?>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php elseif ($resource['icon'] === 'table') : ?>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m3 9 18 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="m3 15 18 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content -->
                    <div class="funnel-cta__content">
                        <h3 class="funnel-cta__resource-title">
                            <?php echo esc_html($resource['title']); ?>
                        </h3>
                        <p class="funnel-cta__description">
                            <?php echo esc_html($resource['description']); ?>
                        </p>
                    </div>
                    
                    <!-- Download Button -->
                    <div class="funnel-cta__action">
                        <a href="<?php echo esc_url($resource['download_url']); ?>" 
                           class="funnel-cta__download-btn <?php echo $resource['featured'] ? 'funnel-cta__download-btn--primary' : 'funnel-cta__download-btn--secondary'; ?>"
                           data-resource="<?php echo esc_attr($resource['title']); ?>">
                            <span>Download Free</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="7,10 12,15 17,10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="12" y1="15" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Bottom CTA -->
        <div class="funnel-cta__bottom">
            <p class="funnel-cta__bottom-text">
                Want personalized guidance? <strong>Schedule a free consultation</strong> with our grant management experts.
            </p>
            <a href="<?php echo home_url('/contact'); ?>" class="funnel-cta__consultation-btn">
                Schedule Free Consultation
            </a>
        </div>
        
    </div>
    
    <!-- Background Elements -->
    <div class="funnel-cta__background">
        <!-- Subtle gradient overlay -->
        <div class="funnel-cta__gradient"></div>
        
        <!-- Optional: Add your brand graphics here if desired -->
        <div class="funnel-cta__graphics">
            <!-- You can add SVG graphics or decorative elements here -->
        </div>
    </div>
    
</section>
