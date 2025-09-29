<?php
/**
 * Financial Compliance Section
 * 
 * "Propelling Your Financial Compliance" section with description and CTA
 * Recreates Tilda section rec1125251236
 */
?>

<section class="financial-compliance-section">
    
    <div class="financial-compliance-container">
        
        <!-- Top Border -->
        <div class="top-border"></div>
        
        <!-- Left Content -->
        <div class="compliance-content">
            <h2 class="compliance-title">
                Propelling <br>Your Financial Compliance
            </h2>
        </div>
        
        <!-- Right Content -->
        <div class="compliance-right-content">
            <!-- Description at top -->
            <div class="compliance-text">
                <p class="compliance-description">
                    We are transforming financial grant management by using smart automation to reduce manual work, minimize errors, and speed up decisions. Our intelligent solution helps organizations manage grants efficiently, and gain real-time visibility across the funding lifecycle.
                </p>
            </div>
            
            <!-- CTA Button Section at bottom -->
            <div class="request-demo-button">
                <a href="<?php echo home_url('/contact'); ?>" class="request-demo-btn">REQUEST A DEMO</a>
                
                <!-- Arrow Square -->
                <div class="arrow-square">
                    <a href="<?php echo home_url('/contact'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3965-6330-4137-a638-623161636534__vector.svg" alt="Arrow" />
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Vertical Divider -->
        <div class="vertical-divider" style="position: absolute; top: 0; left: 50%; width: 1px; height: 100%; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
        
        <!-- Background Grid Image -->
        <!-- Page Indicator -->
        <div class="page-indicator">1/4</div>
        
    <!-- Bottom Border handled by CSS pseudo-element in main.css -->
        
    </div>
    
</section>
