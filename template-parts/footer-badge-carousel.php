<?php
/**
 * Footer Badge Carousel Component
 * 
 * Displays a rotating carousel of company badges/certifications
 */

// Get badges from theme options
$badges = get_option('sgs_footer_badges', []);

// Debug: Let's see what we're getting
if (current_user_can('manage_options')) {
    echo '<!-- DEBUG: Badge count from DB: ' . count($badges) . ' -->';
    if (!empty($badges)) {
        echo '<!-- DEBUG: First badge: ' . esc_html(json_encode($badges[0])) . ' -->';
        echo '<!-- DEBUG: All badges: ' . esc_html(json_encode($badges)) . ' -->';
    }
}

// Default badges if none are set
if (empty($badges)) {
    $badges = [
        [
            'image' => get_template_directory_uri() . '/assets/images/get-app.png',
            'alt' => 'GetApp Recognition',
            'link' => '#',
            'enabled' => true
        ],
        [
            'image' => get_template_directory_uri() . '/assets/images/software-advice.png',
            'alt' => 'Software Advice Badge',
            'link' => '#',
            'enabled' => true
        ]
    ];
}

// Filter only enabled badges
$enabled_badges = array_filter($badges, function($badge) {
    return isset($badge['enabled']) && ($badge['enabled'] === true || $badge['enabled'] === '1' || $badge['enabled'] === 1);
});

// Debug: Let's see enabled badges
if (current_user_can('manage_options')) {
    echo '<!-- DEBUG: Enabled badge count: ' . count($enabled_badges) . ' -->';
}

if (!empty($enabled_badges)) : ?>
<div class="footer-badge-carousel">
    <div class="badge-carousel-container">
        <div class="badge-carousel-track" data-badges="<?php echo count($enabled_badges); ?>">
            <?php foreach ($enabled_badges as $index => $badge) : ?>
                <div class="badge-item" data-index="<?php echo $index; ?>">
                    <?php if (!empty($badge['link']) && $badge['link'] !== '#') : ?>
                        <a href="<?php echo esc_url($badge['link']); ?>" target="_blank" rel="noopener noreferrer">
                    <?php endif; ?>
                    
                    <img src="<?php echo esc_url($badge['image']); ?>" 
                         alt="<?php echo esc_attr($badge['alt'] ?? ''); ?>" 
                         loading="lazy">
                    
                    <?php if (!empty($badge['link']) && $badge['link'] !== '#') : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        

    </div>
</div>
<?php endif; ?>
