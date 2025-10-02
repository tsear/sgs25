<?php
/**
 * Testimonial Video Section (two equal columns)
 * Left: title + icon SVG + quote
 * Right: YouTube video + CTA button
 */
?>

<section class="testimonial-video-section">
    <div class="testimonial-video-container">
        <div class="testimonial-video__grid">
            <!-- Left Column: Title + SVG + Quote -->
            <div class="testimonial-video__left">
                <div class="testimonial-video__title-frame">
                    <h2 class="testimonial-video__title">What Our Clients Say</h2>
                </div>
                <div class="testimonial-video__svg-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blue-rocket-div.svg" alt="" />
                </div>
                <div class="testimonial-video__description">
                    <p class="testimonial-description">
                        Real feedback from organizations transforming their grant management.
                    </p>
                </div>
                
                <!-- Browse All Button -->
                <div class="testimonial-video__browse-all">
                    <a href="<?php echo home_url('/testimonials'); ?>" class="browse-all-btn">Browse All</a>
                </div>
            </div>

            <!-- Right Column: Video + CTA -->
            <div class="testimonial-video__right">
                                <div class="testimonial-video__slider" data-testimonial-slider aria-label="Client testimonial video">
                    
                    <div class="testimonial-slide is-active">
                        <div class="testimonial-slide__video">
                            <iframe 
                                src="https://www.youtube.com/embed/6KxLH0yfloM" 
                                title="Clearwater Conservancy Review of Grant Management" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen
                                class="video-iframe">
                            </iframe>
                        </div>
                        <div class="testimonial-slide__meta">
                            <div class="testimonial-slide__quote">"MissionGranted addressed all of the things I was looking for in a Grant management system"</div>
                            <div class="testimonial-slide__attribution">
                                <span class="testimonial-slide__author">Elizabeth Crisfield</span>
                                <span class="testimonial-slide__title">Executive Director</span>
                                <span class="testimonial-slide__org">ClearWater Conservancy</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</section>
