<?php
/**
 * Template Name: Referral Program Page
 * Description: Referral program landing page
 */

get_header(); ?>

<main id="main" class="site-main referral-program-page">

    <?php get_template_part('template-parts/referral-program/referral-program-hero'); ?>

    <?php get_template_part('template-parts/referral-program/referral-signup-form'); ?>

    <?php get_template_part('template-parts/referral-program/referral-program-content'); ?>

</main>

<?php get_footer(); ?>