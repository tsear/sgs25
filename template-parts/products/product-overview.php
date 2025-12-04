<?php
/**
 * Product Overview Section - Two main offerings
 */
?>

<section class="product-overview">
    <div class="container-twelve-col">
        
        <!-- Section Header -->
        <div class="product-overview__header">
            <h2 class="product-overview__title">Comprehensive Grant Management <span class="brand-secondary">Solutions</span></h2>
            <p class="product-overview__subtitle">From cloud-based financial grant management software to expert consulting, we help you manage your grants with confidence, strengthen compliance, and improve your overall funding performance.</p>
        </div>

        <!-- Two Product Grid -->
        <div class="product-overview__grid">
            
            <!-- MissionGranted Software -->
            <div class="product-card product-card--software fade-column" data-delay="0">
                <div class="product-card__icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3138-3430-4561-a363-396335613866__property_1default.svg" alt="MissionGranted Platform" />
                </div>
                <h3 class="product-card__title">MissionGranted</h3>
                <p class="product-card__subtitle">Financial Grant Management Software</p>
                <p class="product-card__description">Streamline the financial lifecycle of your grants with our comprehensive software solution. Develop application budgets, manage awards, automate allocations, and ensure compliance—all in one powerful platform built for audit-ready accuracy.</p>
                <ul class="product-card__features">
                    <li>Award management & budget tracking</li>
                    <li>Automated indirect cost allocation & personnel distribution</li>
                    <li>Automated Compliance Logic & alerts</li>
                    <li>Compliance monitoring, real-time analysis, & reporting</li>
                </ul>
                <a href="<?php echo home_url('/cloud-software'); ?>" class="product-card__cta">Learn More</a>
            </div>

            <!-- Consulting Services -->
            <div class="product-card product-card--consulting fade-column" data-delay="1">
                <div class="product-card__icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3335-3634-4964-b535-343262343165__group_1000011348.svg" alt="Consulting Services" />
                </div>
                <h3 class="product-card__title">Expert Consulting</h3>
                <p class="product-card__subtitle">Comprehensive Financial Mangement Support</p>
                <p class="product-card__description">Navigate the complex world of nonprofit grant finance, public-sector funding, and Uniform Guidance (2 CFR 200) compliance with our seasoned experts. Using industry best practices, we guide you through system design, compliance workflows, and long-term financial strategy.</p>
                <ul class="product-card__features">
                    <li>Internal grant management & compliance workflow design</li>
                    <li>Systems assessment, redesign & implementation</li>
                    <li>Fiscal policy & procedre development</li>
                    <li>Mangement & board financial training</li>
                </ul>
                <a href="<?php echo home_url('/consulting-services'); ?>" class="product-card__cta">Learn More</a>
            </div>

        </div>

        <!-- Cross-page CTAs -->
        <div class="product-overview__cross-ctas">
            <div class="cross-cta">
                <span class="cross-cta__text">Curious about which industries we serve?</span>
                <a href="<?php echo home_url('/industries'); ?>" class="cross-cta__link">Explore Industries</a>
            </div>
            <div class="cross-cta">
                <span class="cross-cta__text">Want to learn more about our approach?</span>
                <a href="<?php echo home_url('/about'); ?>" class="cross-cta__link">About Our Team</a>
            </div>
        </div>

    </div>
</section>
