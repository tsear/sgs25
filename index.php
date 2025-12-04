<?php
/**
 * The main template file - Smart Grant Solutions Homepage
 * 
 *
 * @package SmartGrantSolutions
 */

get_header();
?>

<main id="main" class="site-main" style="margin-top: 0; padding: 0;">

    <?php get_template_part('template-parts/landing-hero'); ?>

    <?php get_template_part('template-parts/features-section'); ?>

    <?php get_template_part('template-parts/testimonial-video'); ?>

    <?php get_template_part('template-parts/video-features-react'); ?>

    <?php get_template_part('template-parts/consulting'); ?>

    <?php get_template_part('template-parts/funnel-cta'); ?>

    <?php get_template_part('template-parts/financial-compliance'); ?>

    <?php get_template_part('template-parts/directory-cta'); ?>

    <?php get_template_part('template-parts/mission-separator'); ?>

    <?php // get_template_part('template-parts/video-features'); ?>

    <?php get_template_part('template-parts/faq'); ?>

</main>

<?php get_footer(); ?>
