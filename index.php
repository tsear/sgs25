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

    <?php get_template_part('template-parts/hero-home'); ?>
    
    <?php get_template_part('template-parts/value-proposition'); ?>

    <?php get_template_part('template-parts/trusted-organizations'); ?>

    <?php get_template_part('template-parts/financial-compliance'); ?>

    <?php get_template_part('template-parts/video-features'); ?>

    <?php get_template_part('template-parts/testimonial-video'); ?>

    <?php get_template_part('template-parts/mission-separator'); ?>

</main>

<?php get_footer(); ?>
