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
            <p class="product-overview__subtitle">From cutting-edge software to expert consulting, we provide everything you need to maximize your funding success.</p>
        </div>

        <!-- Two Product Grid -->
        <div class="product-overview__grid">
            
            <!-- MissionGranted Software -->
            <div class="product-card product-card--software fade-column" data-delay="0">
                <div class="product-card__icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3138-3430-4561-a363-396335613866__property_1default.svg" alt="MissionGranted Platform" />
                </div>
                <h3 class="product-card__title">MissionGranted</h3>
                <p class="product-card__subtitle">Grant Management Platform</p>
                <p class="product-card__description">Streamline your entire grant lifecycle with our comprehensive software solution. Track opportunities, manage applications, and ensure compliance—all in one powerful platform.</p>
                <ul class="product-card__features">
                    <li>Grant opportunity tracking & alerts</li>
                    <li>Application management & collaboration</li>
                    <li>Compliance monitoring & reporting</li>
                    <li>Award management & budget tracking</li>
                </ul>
                <a href="<?php echo home_url('/cloud-software'); ?>" class="product-card__cta">Learn More</a>
            </div>

            <!-- Consulting Services -->
            <div class="product-card product-card--consulting fade-column" data-delay="1">
                <div class="product-card__icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3335-3634-4964-b535-343262343165__group_1000011348.svg" alt="Consulting Services" />
                </div>
                <h3 class="product-card__title">Expert Consulting</h3>
                <p class="product-card__subtitle">Full Lifecycle Support</p>
                <p class="product-card__description">Navigate the complex world of grant funding with our seasoned experts. We guide you through every phase from application to post-award management.</p>
                <ul class="product-card__features">
                    <li>Grant application strategy & writing</li>
                    <li>Award negotiation & setup</li>
                    <li>Post-award compliance management</li>
                    <li>Financial reporting & audits</li>
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
