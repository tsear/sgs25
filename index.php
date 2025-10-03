<?php
/**
 * The main template file - Smart Grant Solutions Homepage
 * EXACT 1:1 Recreation of Tilda Export smartgrantsolutions.com
 *
 * @package SmartGrantSolutions
 */

get_header();
?>

<main id="main" class="site-main" style="margin-top: 0; padding: 0;">

    <!-- Background wrapper for hero and value prop continuity -->
    <div class="hero-valueprop-background" style="position: relative; width: 100%; background-color: #000000;">
        <!-- Grid Background spanning both sections -->
        <div class="extended-hero-grid" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; opacity: 0.75; pointer-events: none;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6337-6233-4932-a136-646235333461__mask_group.svg" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <!-- Moving Pink Spotlight (JavaScript controlled) -->
            <div class="pink-spotlight" id="pink-spotlight" style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(216, 18, 89, 0.6) 0%, rgba(216, 18, 89, 0.3) 30%, transparent 70%); border-radius: 50%; z-index: 2; pointer-events: none; top: 0; left: 0; transform: translate(200px, 50px);"></div>
        </div>
        
        <?php get_template_part('template-parts/hero-home'); ?>
        
        <?php get_template_part('template-parts/value-proposition'); ?>
    </div>

    <?php get_template_part('template-parts/financial-compliance'); ?>

    <?php get_template_part('template-parts/video-features'); ?>

    <?php get_template_part('template-parts/mission-separator'); ?>

    <?php get_template_part('template-parts/features-section'); ?>

    <?php get_template_part('template-parts/testimonial-video'); ?>

</main>

<?php get_footer(); ?>
