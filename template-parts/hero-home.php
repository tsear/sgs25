<?php
/**
 * Hero Section for Home Page
 */

$hero_title = get_theme_mod('hero_title', 'Unlock Your Organization\'s Potential with Expert Grant Writing Services');
$hero_subtitle = get_theme_mod('hero_subtitle', 'Smart Grant Solutions helps nonprofits, educational institutions, and government agencies secure funding through professional grant writing, research, and management services.');
$hero_cta_text = get_theme_mod('hero_cta_text', 'Get Started Today');
$hero_cta_url = get_theme_mod('hero_cta_url', '#contact');
$hero_background = get_theme_mod('hero_background_image', get_template_directory_uri() . '/assets/images/hero-bg.jpg');
?>

<section class="hero-section section-hero" id="hero" style="background-image: url('<?php echo esc_url($hero_background); ?>');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12">
                <div class="hero-content" data-animate="slide-up">
                    <h1 class="hero-title text-white mb-lg">
                        <?php echo wp_kses_post($hero_title); ?>
                    </h1>
                    
                    <p class="hero-subtitle text-white mb-2xl">
                        <?php echo wp_kses_post($hero_subtitle); ?>
                    </p>
                    
                    <div class="hero-actions">
                        <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn-cta btn-lg">
                            <?php echo esc_html($hero_cta_text); ?>
                        </a>
                        
                        <a href="#services" class="btn btn-outline-white btn-lg ml-md">
                            <?php esc_html_e('Our Services', 'smartgrantsolutions'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <div class="hero-image" data-animate="fade-in" data-animate-delay="300">
                    <?php
                    $hero_image = get_theme_mod('hero_image');
                    if ($hero_image) {
                        echo '<img src="' . esc_url($hero_image) . '" alt="' . esc_attr($hero_title) . '">';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Hero Stats -->
        <div class="hero-stats row mt-4xl" data-animate="slide-up" data-animate-delay="600">
            <div class="col-md-3 col-6">
                <div class="stat-item text-center">
                    <div class="stat-number counter text-secondary" data-count-to="500">0</div>
                    <div class="stat-label text-white"><?php esc_html_e('Grants Written', 'smartgrantsolutions'); ?></div>
                </div>
            </div>
            
            <div class="col-md-3 col-6">
                <div class="stat-item text-center">
                    <div class="stat-number counter text-secondary" data-count-to="25">0</div>
                    <div class="stat-label text-white"><?php esc_html_e('Million Secured', 'smartgrantsolutions'); ?></div>
                </div>
            </div>
            
            <div class="col-md-3 col-6">
                <div class="stat-item text-center">
                    <div class="stat-number counter text-secondary" data-count-to="98">0</div>
                    <div class="stat-label text-white"><?php esc_html_e('Success Rate %', 'smartgrantsolutions'); ?></div>
                </div>
            </div>
            
            <div class="col-md-3 col-6">
                <div class="stat-item text-center">
                    <div class="stat-number counter text-secondary" data-count-to="10">0</div>
                    <div class="stat-label text-white"><?php esc_html_e('Years Experience', 'smartgrantsolutions'); ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="scroll-indicator">
        <a href="#services" class="scroll-down">
            <span><?php esc_html_e('Scroll Down', 'smartgrantsolutions'); ?></span>
            <div class="scroll-arrow"></div>
        </a>
    </div>
</section>

<style>
/* Hero Section Styles */
.hero-section {
    position: relative;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(216, 18, 89, 0.3));
    z-index: 1;
}

.hero-content,
.hero-image,
.hero-stats {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.25rem;
    line-height: 1.6;
    opacity: 0.9;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-stats {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding-top: 2rem;
}

.stat-item {
    padding: 1rem;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.875rem;
    text-transform: uppercase;
    font-weight: 500;
}

.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}

.scroll-down {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
    text-decoration: none;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.scroll-down:hover {
    opacity: 1;
    color: #fcaf3d;
}

.scroll-down span {
    font-size: 0.75rem;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.scroll-arrow {
    width: 20px;
    height: 20px;
    border-right: 2px solid currentColor;
    border-bottom: 2px solid currentColor;
    transform: rotate(45deg);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: rotate(45deg) translateY(0);
    }
    40% {
        transform: rotate(45deg) translateY(-10px);
    }
    60% {
        transform: rotate(45deg) translateY(-5px);
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .hero-section {
        background-attachment: scroll;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .hero-actions .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>
