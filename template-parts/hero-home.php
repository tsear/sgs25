<?php
/**
 * Hero Section - Complete 1:1 Remake with All Elements
 */
?>

<section class="hero-section" style="width: 100%; height: 390px; background-color: transparent; position: relative; overflow: visible; margin: 0; padding: 0; top: 0; z-index: 10;">
    <div class="hero-container" style="width: 100%; height: 100%; position: relative; margin: 0; padding: 0; top: 0;">
        
        
        <!-- MissionGranted Logo (100px from left) -->
        <div class="hero-logo" style="position: absolute; top: 120px; left: 100px; width: 550px; z-index: 10;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3138-3430-4561-a363-396335613866__property_1default.svg" alt="MissionGranted" style="width: 100%; height: auto; display: block;" />
        </div>
        
        <!-- "IS" text (aligned with logo) -->
        <div class="hero-is-text" style="position: absolute; top: 122px; left: 670px; width: 60px; z-index: 10; color: #ffffff; font-size: 62px; font-family: 'Poppins', Arial, sans-serif; line-height: 1; font-weight: 800;">
            IS
        </div>
        
        <!-- Typewriter Text (under logo) -->
        <div class="hero-typewriter" style="position: absolute; top: 210px; left: 100px; width: 1200px; z-index: 10; color: #d81259; font-size: 65px; font-family: 'Poppins', Arial, sans-serif; line-height: 1; font-weight: 700; text-transform: uppercase; white-space: nowrap;" id="hero-typed-text">
            <span class="typewriter-text">|</span>
        </div>
        
        
    </div>
</section>



<!-- CSS Animations -->
<style>
@keyframes pulse {
    0%, 100% {
        opacity: 0.3;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.6;
        transform: translate(-50%, -50%) scale(1.2);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.hero-grid {
    animation: float 6s ease-in-out infinite;
}
</style>

<!-- Mobile Responsive Styles -->
<style>
@media screen and (max-width: 479px) {
    .hero-section {
        height: 330px !important;
    }
    
    .hero-logo {
        top: 38px !important;
        left: 35px !important;
        width: 250px !important;
    }
    
    .hero-is-text {
        top: 78px !important;
        left: 147px !important;
        width: 26px !important;
        font-size: 28px !important;
    }
    
    .hero-typewriter {
        top: 163px !important;
        left: 33px !important;
        width: 255px !important;
        font-size: 28px !important;
        text-align: center !important;
    }
    
    .hero-sgs-logo {
        top: 267px !important;
        left: 85px !important;
        right: auto !important;
        width: 150px !important;
    }
}
</style>
