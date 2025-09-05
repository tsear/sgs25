<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Tilda-matching meta tags -->
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//tilda.cc">
    <link rel="dns-prefetch" href="//ws.tildacdn.com">
    <link rel="dns-prefetch" href="//static.tildacdn.com">
    
    <!-- Typeface matching original Tilda design -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site" id="page">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'smartgrantsolutions' ); ?></a>

    <!-- Fixed Header Navigation matching Tilda structure -->
    <header id="masthead" class="site-header fixed-header" style="background-color: #000000; position: fixed; top: 0; width: 100%; z-index: 1000; height: 80px;">
        <div class="header-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; height: 100%;">
            <!-- Logo matching Tilda positioning -->
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sgs-logo-header.png" alt="Smart Grant Solutions" style="height: 40px;" />
                </a>
            </div>

            <!-- Navigation Menu matching Tilda structure: HOME | BLOG | TESTIMONIALS | REQUEST A DEMO -->
            <nav id="site-navigation" class="main-navigation">
                <div class="nav-menu" style="display: flex; align-items: center; gap: 30px; color: #ffffff; font-family: Inter, sans-serif; font-size: 14px; font-weight: 400;">
                    <a href="<?php echo home_url('/'); ?>" class="nav-link <?php echo is_home() ? 'active' : ''; ?>" style="color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">HOME</a>
                    <span class="nav-separator" style="color: #666666;">|</span>
                    <a href="/blog" class="nav-link <?php echo is_page('blog') ? 'active' : ''; ?>" style="color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">BLOG</a>
                    <span class="nav-separator" style="color: #666666;">|</span>
                    <a href="/testimonials" class="nav-link <?php echo is_page('testimonials') ? 'active' : ''; ?>" style="color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">TESTIMONIALS</a>
                    <span class="nav-separator" style="color: #666666;">|</span>
                    <a href="/reach-out" class="nav-link cta-nav <?php echo is_page('reach-out') ? 'active' : ''; ?>" style="color: #FFB03F; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">REQUEST A DEMO</a>
                </div>
                
                <!-- Mobile menu toggle -->
                <button class="mobile-menu-toggle" aria-controls="mobile-navigation" aria-expanded="false" style="display: none; background: none; border: none; color: #ffffff; font-size: 18px;">
                    <span class="hamburger-line" style="display: block; width: 25px; height: 3px; background: #ffffff; margin: 5px 0; transition: 0.3s;"></span>
                    <span class="hamburger-line" style="display: block; width: 25px; height: 3px; background: #ffffff; margin: 5px 0; transition: 0.3s;"></span>
                    <span class="hamburger-line" style="display: block; width: 25px; height: 3px; background: #ffffff; margin: 5px 0; transition: 0.3s;"></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Header spacer to account for fixed header -->
    <div class="header-spacer" style="height: 80px;"></div>

    <!-- Mobile Navigation -->
    <nav class="mobile-navigation" id="mobile-navigation" style="display: none; position: fixed; top: 80px; width: 100%; background: #000000; z-index: 999;">
        <div class="mobile-nav-content" style="padding: 20px;">
            <div class="mobile-nav-menu">
                <a href="<?php echo home_url('/'); ?>" class="mobile-nav-link" style="display: block; color: #ffffff; text-decoration: none; padding: 15px 0; border-bottom: 1px solid #333; text-transform: uppercase;">HOME</a>
                <a href="/blog" class="mobile-nav-link" style="display: block; color: #ffffff; text-decoration: none; padding: 15px 0; border-bottom: 1px solid #333; text-transform: uppercase;">BLOG</a>
                <a href="/testimonials" class="mobile-nav-link" style="display: block; color: #ffffff; text-decoration: none; padding: 15px 0; border-bottom: 1px solid #333; text-transform: uppercase;">TESTIMONIALS</a>
                <a href="/reach-out" class="mobile-nav-link cta" style="display: block; color: #FFB03F; text-decoration: none; padding: 15px 0; text-transform: uppercase; font-weight: 600;">REQUEST A DEMO</a>
            </div>
        </div>
    </nav>
