<?php
/**
 * Template part for blog archive header
 * Displays the hero section with title and newsletter signup
 */
?>

<!-- Load Poppins font for blog only -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<section class="blog-header">
    <div class="blog-header__container">
        <div class="blog-header__content">
            <!-- Left Column: Title and Newsletter -->
            <div class="blog-header__left-column">
                <h1 class="blog-header__title">
                    <?php if (is_category()) : ?>
                        <strong style="color: #d81259;"><em>Category:</em></strong><br>
                        <strong style="color: #ffffff;"><em><?php single_cat_title(); ?></em></strong>
                    <?php elseif (is_tag()) : ?>
                        <strong style="color: #d81259;"><em>Tag:</em></strong><br>
                        <strong style="color: #ffffff;"><em><?php single_tag_title(); ?></em></strong>
                    <?php elseif (is_author()) : ?>
                        <strong style="color: #d81259;"><em>Author:</em></strong><br>
                        <strong style="color: #ffffff;"><em><?php the_author(); ?></em></strong>
                    <?php elseif (is_search()) : ?>
                        <strong style="color: #d81259;"><em>Search Results</em></strong><br>
                        <strong style="color: #ffffff;"><em>Blog</em></strong>
                    <?php else : ?>
                        <strong style="color: #d81259;"><em>MissionGranted</em></strong><br>
                        <strong style="color: #ffffff;"><em>Blog</em></strong>
                    <?php endif; ?>
                </h1>
                
                <?php get_template_part('template-parts/blog/newsletter-form'); ?>
            </div>
            
            <!-- Right Column: Descriptive Text -->
            <div class="blog-header__right-column">
                <div class="blog-header__description">
                    <p>Navigating the <strong>nonprofit</strong> world means juggling big missions with tight resources, and <strong>smart grant management</strong> can be the difference between vision and <strong>impact</strong>.</p>
                    
                    <p>Here, we <strong>unpack best-practice tools</strong>, stories, and strategies <strong>to help</strong> organizations <strong>win</strong> and steward funding with confidence.</p>
                </div>
                
                <!-- Graphics positioned across full right column -->
                <div class="blog-header__circle blog-header__circle--main">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div class="blog-header__union">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6535-3966-4638-a265-393438636538__union.svg" alt="" style="width: 100%; height: 100%; object-fit: contain;" />
                </div>
            </div>
            
            <!-- Divider (Vertical on desktop, horizontal on mobile) -->
            <div class="blog-header__divider"></div>
            
            <!-- Bottom Border -->
            <div class="bottom-border" style="position: absolute; bottom: 0; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
        </div>
    </div>
</section>
