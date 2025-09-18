<?php
/**
 * Testimonials Hero Section
 * Based on blog header structure with testimonials-specific content
 */
?>

<section class="testimonials-header">
    <div class="testimonials-header__container">
        <div class="testimonials-header__content">
            <!-- Left Column: Title Only -->
            <div class="testimonials-header__left-column">
                <h1 class="testimonials-header__title">
                    <strong style="color: #ffffff;"><em>Testimonials</em></strong>
                </h1>
            </div>
            
            <!-- Right Column: Description and Graphics -->
            <div class="testimonials-header__right-column">
                <div class="testimonials-header__description">
                    <p>What do our clients have to say</p>
                </div>
                
                <!-- Graphics positioned across full right column -->
                <div class="testimonials-header__circle testimonials-header__circle--main">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div class="testimonials-header__union">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6535-3966-4638-a265-393438636538__union.svg" alt="" style="width: 100%; height: 100%; object-fit: contain;" />
                </div>
            </div>
            
            <!-- Divider (Vertical on desktop, horizontal on mobile) -->
            <div class="testimonials-header__divider"></div>
            
            <!-- Bottom Border -->
            <div class="bottom-border" style="position: absolute; bottom: 0; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
        </div>
    </div>
</section>
