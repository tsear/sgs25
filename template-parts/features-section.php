<?php
/**
 * Template part for displaying the features section
 * 
 * Showcases the key platform capabilities in a horizontal card layout
 *
 * @package SGS_Theme
 */

// Define features data
    $features = [
        [
            'title' => 'Budgeting &<br>Scenario Planning',
            'description' => 'Our automated planning tools provide a comprehensive view of how funding works together, empowering you to plan boldly and adapt quickly to changes.',
            'icon' => 'tild3563-3439-4161-a433-633038613063__circle-dollar-sign.svg',
            'alt' => 'Budget Planning Icon'
        ],
        [
            'title' => 'Indirect Cost Allocation &<br>Personnel Distribution',
            'description' => 'MissionGranted simplifies and automates the most complex, error-prone grant management tasks and creates accurate, auditable backup with ease.',
            'icon' => 'tild3434-3035-4336-b935-373236333133__currency.svg',
            'alt' => 'Cost Allocation Icon'
        ],
        [
            'title' => 'Budget vs Actual<br>Compliance Logic',
            'description' => 'Our smart compliance logic automates variance analysis, offering comparisons, allowability guidance, and alerts to maximize resources and ensure compliance.',
            'icon' => 'tild6466-6263-4431-a231-383566306130__chart-no-axes-combin.svg',
            'alt' => 'Compliance Tracking Icon'
        ],
        [
            'title' => 'Invoicing &<br>Reporting',
            'description' => 'MissionGranted simplifies invoicing and reporting, automating labor-intensive tasks and generating funder-specific documents in just a few clicks.',
            'icon' => 'tild6439-6231-4862-b236-353763323334__invoice.png',
            'alt' => 'Invoicing and Reporting Icon'
        ],
        [
            'title' => 'Multi-Year<br>Grant Management',
            'description' => 'MissionGranted makes tracking and managing multi-year grants easy, ensuring accurate budgeting for roll-forward funds, and helping you maximize every dollar spent.',
            'icon' => 'tild6433-3730-4162-b866-613163633733__book.png',
            'alt' => 'Multi-Year Management Icon'
        ]
    ];

$image_base_url = get_template_directory_uri() . '/assets/images/';
?>

<section class="features-section" id="features" style="--ellipse-bg-url: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png'); ?>');">
    <!-- Background ellipse -->
    <div class="ellipse-background"></div>
    
    <div class="container">
        <!-- Features Grid -->
        <div class="feature-cards-container">
            <?php foreach ($features as $feature) : ?>
                <div class="feature-card">
                    <div class="card-content">
                        <div class="card-icon">
                            <img src="<?php echo esc_url($image_base_url . $feature['icon']); ?>" 
                                 alt="<?php echo esc_attr($feature['alt']); ?>" 
                                 loading="lazy">
                        </div>
                        <h3 class="card-title">
                            <?php echo wp_kses($feature['title'], ['br' => []]); ?>
                        </h3>
                        <p class="card-description">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Features CTA -->
        <div class="features-section__cta">
            <div class="features-cta__content">
                <div class="features-cta__badge">🚀 Join 500+ Organizations</div>
                <h3 class="features-cta__title">
                    Turn Grant <span class="highlight">Complexity</span> into 
                    <span class="highlight">Competitive Advantage</span>
                </h3>
                <p class="features-cta__description">
                    From healthcare nonprofits securing $2M+ in federal funding to tech startups landing SBIR grants—our platform adapts to your industry's unique requirements. Stop chasing grants. Start winning them systematically.
                </p>
                <div class="features-cta__buttons">
                    <a href="<?php echo esc_url(home_url('/industries')); ?>" class="features-cta__button features-cta__button--primary">
                        <span>Explore Your Industry</span>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/demo')); ?>" class="features-cta__button features-cta__button--secondary">
                        <span>See It In Action</span>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </a>
                </div>
                <div class="features-cta__stats">
                    <div class="features-cta__stat">
                        <span class="stat-number">$47M+</span>
                        <span class="stat-label">Grants Secured</span>
                    </div>
                    <div class="features-cta__stat">
                        <span class="stat-number">78%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                    <div class="features-cta__stat">
                        <span class="stat-number">60%</span>
                        <span class="stat-label">Time Saved</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
