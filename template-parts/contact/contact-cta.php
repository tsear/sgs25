<?php
/**
 * Contact CTA Section
 * Encourages form submission with secondary navigation to key pages
 */
?>

<section class="contact-cta-section">
    <div class="container">
        <div class="contact-cta-content">
            
            <!-- Primary CTA -->
            <div class="primary-cta">
                <h2>Still have questions?</h2>
                <p>We're here to help you find the perfect solution for your organization's grant management needs.</p>
                <button class="btn btn-primary scroll-to-form">Get Your Questions Answered</button>
            </div>

            <!-- Divider -->
            <div class="cta-divider">
                <span>Or explore what makes us different</span>
            </div>

            <!-- Secondary CTAs -->
            <div class="secondary-ctas">
                
                <div class="cta-card">
                    <div class="cta-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7L12 3L4 7M20 7L12 11M20 7V17L12 21M4 7L12 11M4 7V17L12 21M12 11V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Curious if we're the right fit?</h3>
                    <p>Learn about our mission, values, and the team behind MissionGranted's approach to grant management.</p>
                    <a href="<?php echo home_url('/about'); ?>" class="cta-link">Discover Our Story <span>→</span></a>
                </div>

                <div class="cta-card">
                    <div class="cta-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Curious about our capabilities?</h3>
                    <p>Explore the powerful features that make grant management simple, compliant, and stress-free.</p>
                    <a href="<?php echo home_url('/product'); ?>" class="cta-link">See What We Build <span>→</span></a>
                </div>

                <div class="cta-card">
                    <div class="cta-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23 21V19C23 18.1645 22.7155 17.3541 22.2094 16.7019C21.7033 16.0497 20.9995 15.5914 20.2 15.402" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 3.402C16.7995 3.59137 17.5033 4.04974 18.0094 4.70194C18.5155 5.35413 18.8 6.16454 18.8 7C18.8 7.83546 18.5155 8.64587 18.0094 9.29806C17.5033 9.95026 16.7995 10.4086 16 10.598" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Curious who we serve?</h3>
                    <p>See how organizations across different sectors trust us with their grant management needs.</p>
                    <a href="<?php echo home_url('/industries'); ?>" class="cta-link">Find Your Industry <span>→</span></a>
                </div>

            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to form when primary CTA is clicked
    const scrollButton = document.querySelector('.scroll-to-form');
    if (scrollButton) {
        scrollButton.addEventListener('click', function(e) {
            e.preventDefault();
            const form = document.querySelector('.contact-form-section') || document.querySelector('.contact-form');
            if (form) {
                form.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }
});
</script>
