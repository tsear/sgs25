<?php
/**
 * Landing Hero Section
 * Modern hero combining brand statement + value proposition
 */
?>

<section class="landing-hero">
    <!-- Background Elements -->
    <div class="landing-hero__background">
        <div class="landing-hero__grid"></div>
        <div class="landing-hero__spotlight"></div>
    </div>
    
    <!-- Main Content -->
    <div class="landing-hero__container">
        <div class="landing-hero__content">
            
            <!-- Left Column: Brand Statement -->
            <div class="landing-hero__brand">
                <div class="landing-hero__logo-line">
                    <div class="landing-hero__logo">
                        <img 
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3335-3634-4964-b535-343262343165__group_1000011348.svg" 
                            alt="MissionGranted"
                            width="400"
                            height="80"
                        />
                    </div>
                    <span class="landing-hero__is">IS</span>
                </div>
                
                <h1 class="landing-hero__tagline landing-hero__tagline--typing" id="hero-typed-text">
                    FINANCIAL<br>EMPOWERMENT
                </h1>
                
                <div class="landing-hero__badge">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span>Trusted by 500+ Organizations</span>
                </div>
            </div>
            
            <!-- Right Column: Value Proposition -->
            <div class="landing-hero__value-prop">
                <h2 class="landing-hero__headline">
                    We Make <span class="brand-highlight">Grant Management</span> and Financial Compliance <span class="brand-highlight">Simple</span>
                </h2>
                
                <p class="landing-hero__subheadline">
                    Smart Grant Solutions provides cloud-based software and expert consulting to help nonprofits, governments, and grantmakers maximize their impact.
                </p>
                
                <ul class="landing-hero__features">
                    <li class="landing-hero__feature">Automated compliance tracking and audit preparation</li>
                    <li class="landing-hero__feature">Real-time financial reporting and analytics</li>
                    <li class="landing-hero__feature">Expert consulting from grant professionals</li>
                    <li class="landing-hero__feature">Integrated tools that replace multiple spreadsheets</li>
                </ul>
                
                <div class="landing-hero__cta-group">
                    <a href="<?php echo esc_url(home_url('/product/')); ?>" class="landing-hero__cta landing-hero__cta--primary">
                        Explore Our Platform
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="landing-hero__cta landing-hero__cta--secondary">
                        Schedule Consultation
                    </a>
                </div>
                
                <div class="landing-hero__trust">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5z"/>
                    </svg>
                    <span>Secure, compliant, and <strong>audit-ready</strong> from day one</span>
                </div>
            </div>
            
        </div>
    </div>
</section>
