<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- DNS prefetch for external resources -->
    <meta name="format-detection" content="telephone=no">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <!-- Typeface matching original Tilda design -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- HubSpot Configuration -->
    <script type="text/javascript">
        window.sgsHubSpotConfig = {
            portalId: '<?php echo esc_js(get_option('sgs_hubspot_portal_id', '44675524')); ?>',
            forms: {
                newsletter: '<?php echo esc_js(get_option('sgs_hubspot_newsletter_form_id', '32a6e78d-b7b9-4e1d-82fb-31693b40260a')); ?>',
                contact: '<?php echo esc_js(get_option('sgs_hubspot_contact_form_id', '')); ?>',
                grant: '<?php echo esc_js(get_option('sgs_hubspot_grant_form_id', '')); ?>'
            }
        };
    </script>
    
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/<?php echo esc_js(get_option('sgs_hubspot_portal_id', '44675524')); ?>.js"></script>
    <!-- End of HubSpot Embed Code -->
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site" id="page">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'smartgrantsolutions' ); ?></a>

    <!-- Fixed Header Navigation - Clean WordPress Structure -->
    <header id="masthead" class="site-header">
        <div class="header-container">
            <!-- Logo Cell -->
            <div class="site-branding">
                <div class="logo-cell">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3832-6632-4035-b932-353234353234__sgs_logo.svg" alt="Smart Grant Solutions" />
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation Menu -->
            <nav id="site-navigation" class="main-navigation">
                <div class="nav-menu">
                    <!-- About Button - Cell 2 -->
                    <a href="<?php echo home_url('/about'); ?>" class="nav-link-about <?php echo is_page('about') ? 'active' : ''; ?>">ABOUT</a>
                    
                    <!-- Product Button - Cell 3 -->
                    <a href="<?php echo home_url('/product'); ?>" class="nav-link-product <?php echo is_page('product') ? 'active' : ''; ?>">PRODUCT</a>
                    
                    <!-- Industries Button - Cell 5 -->
                    <a href="<?php echo home_url('/industries'); ?>" class="nav-link-industries <?php echo is_page('industries') ? 'active' : ''; ?>">INDUSTRIES</a>
                    
                    <!-- Success Stories Button - Cell 5 -->
                    <a href="<?php echo home_url('/success-stories'); ?>" class="nav-link-success-stories <?php echo is_page('success-stories') ? 'active' : ''; ?>">TESTIMONIALS</a>
                    
                    <!-- Grants Button - Cell 6 -->
                    <a href="<?php echo home_url('/grants'); ?>" class="nav-link-grants <?php echo is_page('grants') ? 'active' : ''; ?>">GRANTS</a>
                    
                    <!-- Blog Button - Cell 7 -->
                    <a href="<?php echo home_url('/blog'); ?>" class="nav-link-blog <?php echo is_page('blog') ? 'active' : ''; ?>">BLOG</a>
                    
                    <!-- Contact Button - Cell 8 (yellow highlight) -->
                    <a href="<?php echo home_url('/contact'); ?>" class="nav-link-contact <?php echo is_page('contact') ? 'active' : ''; ?>">CONTACT</a>
                </div>
            </nav>
            
            <!-- Mobile Hamburger Menu - SEPARATE FROM MAIN NAV -->
            <div class="mobile-menu-container">
                <button class="mobile-hamburger" id="mobile-hamburger" aria-label="Toggle mobile menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" id="mobile-nav-overlay">
        <div class="mobile-nav-content">
            <div class="mobile-nav-header">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3832-6632-4035-b932-353234353234__sgs_logo.svg" alt="Smart Grant Solutions" class="mobile-logo" />
                <button class="mobile-nav-close" id="mobile-nav-close">&times;</button>
            </div>
            <nav class="mobile-nav-menu">
                <a href="<?php echo home_url('/about'); ?>" class="mobile-nav-link <?php echo is_page('about') ? 'active' : ''; ?>">ABOUT</a>
                <a href="<?php echo home_url('/product'); ?>" class="mobile-nav-link <?php echo is_page('product') ? 'active' : ''; ?>">PRODUCT</a>
                <a href="<?php echo home_url('/industries'); ?>" class="mobile-nav-link <?php echo is_page('industries') ? 'active' : ''; ?>">INDUSTRIES</a>
                <a href="<?php echo home_url('/success-stories'); ?>" class="mobile-nav-link <?php echo is_page('success-stories') ? 'active' : ''; ?>">TESTIMONIALS</a>
                <a href="<?php echo home_url('/grants'); ?>" class="mobile-nav-link <?php echo is_page('grants') ? 'active' : ''; ?>">GRANTS</a>
                <a href="<?php echo home_url('/blog'); ?>" class="mobile-nav-link <?php echo is_page('blog') ? 'active' : ''; ?>">BLOG</a>
                <a href="<?php echo home_url('/contact'); ?>" class="mobile-nav-link <?php echo is_page('contact') ? 'active' : ''; ?>">CONTACT</a>
            </nav>
        </div>
    </div>

