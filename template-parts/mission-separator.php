<?php
/**
 * Template part for displaying the mission separator section
 *
 * @package sgs25
 */
?>

<!-- Mission Separator Section -->
<section class="mission-separator" style="height: 210px; background-color: #000000; position: relative;">
    <!-- Union SVG Background - From left edge to 25% of viewport -->
    <div class="mission-separator__grid" style="position: absolute; top: 0; left: 0; width: 25vw; height: 100%; z-index: 1; overflow: hidden;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6535-3966-4638-a265-393438636538__union.svg" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
    </div>

    <!-- Ellipse Background - Bottom left corner of left column -->
    <div class="mission-separator__ellipse" style="position: absolute; bottom: 0; left: 0; width: 25vw; height: 100%; z-index: 1; overflow: hidden; pointer-events: none;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png" alt="" style="position: absolute; bottom: -100px; left: 0px; width: 400px; height: 400px; object-fit: contain;" />
    </div>

    <div class="mission-separator__container" style="width: 100%; height: 100%; position: relative; max-width: 1200px; margin: 0 auto;">
        
        <!-- Top Border -->
        <div class="top-border" style="position: absolute; top: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
        
        <!-- Bottom Border -->
        <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
        
        <!-- Vertical Divider -->
        <div class="vertical-divider" style="position: absolute; top: 0; left: 25%; width: 1px; height: 100%; background-color: #ffffff; z-index: 3;"></div>
        
        <!-- Main Title -->
        <div class="mission-title" style="position: absolute; top: 50%; left: 20px; transform: translateY(-50%); width: calc(25% - 40px); z-index: 3; color: #ffffff; font-size: 32px; font-family: 'Poppins', Arial, sans-serif; line-height: 1.25; font-weight: 900;">
            Our Mission is<br>to Fuel Yours
        </div>
        
        <!-- Right Content: Bullets + Button in a row -->
        <div class="mission-attributes" style="position: absolute; top: 50%; left: calc(25% + 50px); transform: translateY(-50%); display: flex; align-items: center; gap: 40px; z-index: 3;">
            <!-- Bullet Points -->
            <div class="mission-bullets" style="color: #ffffff; font-family: 'Poppins', Arial, sans-serif; font-size: 18px; font-weight: 600; line-height: 1.35;">
                <p style="margin: 0 0 4px 0;">Eliminate Spreadsheets.</p>
                <p style="margin: 0 0 4px 0;">Ensure Compliance.</p>
                <p style="margin: 0;">Drive Strategy.</p>
            </div>
            
            <!-- CTA Button -->
            <div class="request-demo-button">
                <a href="/reach-out" class="request-demo-btn">REQUEST A DEMO</a>
                
                <!-- Arrow Square -->
                <div class="arrow-square">
                    <a href="/reach-out">
                        <!-- Arrow Icon -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3965-6330-4137-a638-623161636534__vector.svg" alt="Arrow" />
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>
