<?php
/**
 * Services Overview Section
 */
?>

<section class="services-section section" id="services">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-4xl" data-animate="fade-in">
                    <h2 class="section-title"><?php esc_html_e('Our Grant Services', 'smartgrantsolutions'); ?></h2>
                    <p class="section-subtitle text-muted">
                        <?php esc_html_e('Comprehensive grant solutions designed to maximize your funding success', 'smartgrantsolutions'); ?>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <?php
            $services = array(
                array(
                    'icon' => '📝',
                    'title' => 'Grant Writing',
                    'description' => 'Professional grant proposals crafted to meet funder requirements and showcase your organization\'s impact.'
                ),
                array(
                    'icon' => '🔍',
                    'title' => 'Grant Research',
                    'description' => 'Comprehensive research to identify funding opportunities that align with your mission and goals.'
                ),
                array(
                    'icon' => '📊',
                    'title' => 'Grant Management',
                    'description' => 'End-to-end grant administration from application to reporting and compliance management.'
                ),
                array(
                    'icon' => '✅',
                    'title' => 'Compliance Monitoring',
                    'description' => 'Ensure your organization meets all grant requirements and reporting deadlines.'
                ),
                array(
                    'icon' => '🎯',
                    'title' => 'Strategic Planning',
                    'description' => 'Develop comprehensive funding strategies to diversify revenue streams and ensure sustainability.'
                ),
                array(
                    'icon' => '📚',
                    'title' => 'Training & Workshops',
                    'description' => 'Capacity building programs to strengthen your team\'s grant writing and management skills.'
                ),
            );
            
            foreach ($services as $index => $service) : ?>
                <div class="col-lg-4 col-md-6 col-12 mb-xl">
                    <div class="service-card" data-animate="slide-up" data-animate-delay="<?php echo $index * 100; ?>">
                        <div class="service-icon">
                            <span><?php echo $service['icon']; ?></span>
                        </div>
                        
                        <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                        
                        <p class="service-description">
                            <?php echo esc_html($service['description']); ?>
                        </p>
                        
                        <a href="#contact" class="btn btn-outline-primary">
                            <?php esc_html_e('Learn More', 'smartgrantsolutions'); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="row">
            <div class="col-12 text-center mt-3xl">
                <a href="/services" class="btn btn-primary btn-lg">
                    <?php esc_html_e('View All Services', 'smartgrantsolutions'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
