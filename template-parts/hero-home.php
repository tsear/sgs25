<?php
/**
 * Hero Section - Complete 1:1 Remake with All Elements
 */
?>

<section class="hero-section" style="width: 100%; height: 390px; background-color: #000000; position: relative; overflow: hidden; margin: 0; padding: 0; top: 0;">
    <div class="hero-container" style="width: 100%; height: 100%; position: relative; margin: 0; padding: 0; top: 0;">
        
        <!-- Grid Background spanning full container -->
        <div class="hero-grid" style="position: absolute; top: 0; left: 0; width: 100%; height: 390px; z-index: 1; opacity: 0.75;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6337-6233-4932-a136-646235333461__mask_group.svg" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <!-- Moving Pink Spotlight (JavaScript controlled) -->
            <div class="pink-spotlight" id="pink-spotlight" style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(216, 18, 89, 0.6) 0%, rgba(216, 18, 89, 0.3) 30%, transparent 70%); border-radius: 50%; z-index: 2; pointer-events: none; top: 0; left: 0; transform: translate(200px, 50px);"></div>
        </div>
        
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
        
        <!-- Bottom Right Section: "Proudly developed by" + SGS Logo -->
        <div class="bottom-right-section" style="position: absolute; bottom: 20px; right: 20px; z-index: 10; display: flex; align-items: center; gap: 15px;">
            <!-- Proudly Developed By Text -->
            <div class="proudly-developed" style="color: #ffffff; font-size: 14px; font-family: 'Poppins', Arial, sans-serif; font-weight: 400; white-space: nowrap;">
                Proudly developed by
            </div>
            <!-- SGS Logo -->
            <div class="hero-sgs-logo" style="width: 150px;">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3832-6632-4035-b932-353234353234__sgs_logo.svg" alt="Smart Grant Solutions" style="width: 100%; height: auto; display: block;" />
            </div>
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
