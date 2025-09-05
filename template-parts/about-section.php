<?php
/**
 * About Section
 */
?>

<section class="about-section section bg-gray-50" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-xl mb-lg-0">
                <div class="about-image" data-animate="slide-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-image.jpg" alt="<?php esc_attr_e('About Smart Grant Solutions', 'smartgrantsolutions'); ?>">
                    
                    <!-- Experience Badge -->
                    <div class="experience-badge">
                        <div class="badge-content">
                            <span class="badge-number">10+</span>
                            <span class="badge-text"><?php esc_html_e('Years of Excellence', 'smartgrantsolutions'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <div class="about-content" data-animate="slide-right">
                    <h2 class="section-title mb-lg">
                        <?php esc_html_e('Empowering Organizations Through Strategic Grant Solutions', 'smartgrantsolutions'); ?>
                    </h2>
                    
                    <p class="text-lg mb-lg">
                        <?php esc_html_e('At Smart Grant Solutions, we believe every organization deserves access to the funding they need to make a meaningful impact. Our team of experienced grant professionals has helped secure over $25 million in funding for nonprofits, educational institutions, and government agencies.', 'smartgrantsolutions'); ?>
                    </p>
                    
                    <div class="about-features mb-xl">
                        <?php
                        $features = array(
                            'Proven track record with 98% success rate',
                            'Experienced team of certified grant writers',
                            'Comprehensive post-award support',
                            'Tailored strategies for each organization'
                        );
                        
                        foreach ($features as $feature) : ?>
                            <div class="feature-item d-flex align-items-start mb-md">
                                <span class="feature-icon text-primary mr-md">✓</span>
                                <span><?php echo esc_html($feature); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="about-stats row mb-xl">
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-number text-primary counter" data-count-to="500">0</div>
                                <div class="stat-label"><?php esc_html_e('Successful Grants', 'smartgrantsolutions'); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-number text-primary">$25M+</div>
                                <div class="stat-label"><?php esc_html_e('Funding Secured', 'smartgrantsolutions'); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="about-actions">
                        <a href="/about" class="btn btn-primary mr-md">
                            <?php esc_html_e('Learn More About Us', 'smartgrantsolutions'); ?>
                        </a>
                        
                        <a href="#contact" class="btn btn-outline-primary">
                            <?php esc_html_e('Get Started', 'smartgrantsolutions'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* About Section Styles */
.about-image {
    position: relative;
}

.about-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.experience-badge {
    position: absolute;
    bottom: -20px;
    right: -20px;
    background: linear-gradient(135deg, #d81259, #fcaf3d);
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 10px 30px rgba(216, 18, 89, 0.3);
}

.badge-content {
    text-align: center;
}

.badge-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.badge-text {
    font-size: 0.7rem;
    text-transform: uppercase;
    font-weight: 500;
}

.feature-item {
    transition: transform 0.3s ease;
}

.feature-item:hover {
    transform: translateX(5px);
}

.feature-icon {
    font-weight: 700;
    font-size: 1.2rem;
}

.about-stats .stat-item {
    text-align: left;
}

.about-stats .stat-number {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.about-stats .stat-label {
    font-size: 0.875rem;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 500;
}

@media (max-width: 768px) {
    .experience-badge {
        width: 100px;
        height: 100px;
        bottom: -15px;
        right: -15px;
    }
    
    .badge-number {
        font-size: 1.25rem;
    }
    
    .badge-text {
        font-size: 0.6rem;
    }
    
    .about-actions .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>
