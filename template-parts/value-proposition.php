<?php
/**
 * Value Proposition Section - Tilda Recreation
 */
?>

<!-- Value Proposition Section -->
<section id="value-proposition" style="height: 486px; background-color: #000000; position: relative;">
    <div class="value-prop-container" style="width: 100%; height: 100%; position: relative; max-width: 1200px; margin: 0 auto;">
        
        <!-- Top Border -->
        <div class="top-border" style="position: absolute; top: 0; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
        
        <!-- Grid Background with Fish Eye Effect - ONLY behind left content -->
        <div class="value-prop-grid" style="position: absolute; top: 0; left: 0; width: 480px; height: 486px; z-index: 1; opacity: 1;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6535-3966-4638-a265-393438636538__union.svg" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
        </div>


        
        <!-- Main Heading -->
        <div class="main-heading" style="position: absolute; top: 63px; left: 0; width: 389px; z-index: 3; color: #ffffff; font-size: 30px; font-family: 'Poppins', Arial, sans-serif; line-height: 1.25; font-weight: 600;">
            We Make Financial <span style="color: #FCB03E;">Grant Management</span> and Compliance <span style="color: #FFB03F;">Easy</span>, <br>So You Can Focus on What Matters Most – <span style="color: #FFB03F;">Your Mission.</span>
        </div>
        
        <!-- CTA Button -->
        <div class="request-demo-button" style="position: absolute; top: 394px; left: 0px; z-index: 3;">
            <a href="<?php echo home_url('/contact'); ?>" class="request-demo-btn">REQUEST A DEMO</a>
            
            <!-- Arrow Square -->
            <div class="arrow-square">
                <a href="<?php echo home_url('/contact'); ?>">
                    <!-- Arrow Icon -->
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3965-6330-4137-a638-623161636534__vector.svg" alt="Arrow" />
                </a>
            </div>
        </div>
        
        <!-- Vertical Divider -->
        <div class="vertical-divider" style="position: absolute; top: 1px; left: 480px; width: 1px; height: 486px; background-color: #ffffff; z-index: 3;"></div>
        
        <!-- Video Section -->
        <div class="video-section" style="position: absolute; top: 56px; left: 565px; width: 635px; height: 375px; z-index: 3; overflow: hidden; border-radius: 8px;">
            <iframe 
                src="https://www.youtube.com/embed/EKd71-iF-10" 
                title="Smart Grant Solutions Demo Video" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen
                style="width: 100%; height: 100%; border: none; display: block;">
            </iframe>
        </div>
        
        <!-- Animated Element -->
        <div class="animated-element" style="position: absolute; top: 161px; left: 897px; width: 500px; z-index: 3; opacity: 0.75;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png" alt="" style="width: 100%; height: auto;" />
        </div>
        
        <!-- Bottom Border -->
        <div class="bottom-border" style="position: absolute; top: 485px; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
        
    </div>
</section>
